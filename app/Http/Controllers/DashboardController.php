<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Pastikan hanya admin yang bisa mengakses dashboard
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized');
        }

        $usages = Reservation::selectRaw('MONTH(start_time) as month, COUNT(*) as total')
            ->where('start_time', '>=', now()->subMonths(5)->startOfMonth())
            ->groupByRaw('MONTH(start_time)')
            ->orderByRaw('MONTH(start_time)')
            ->get();

        // Generate label dan data
        $labels = [];
        $data = [];
        $months = now()->subMonths(5)->monthsUntil(now(), 1);

        foreach ($months as $month) {
            $labels[] = $month->translatedFormat('F'); // contoh: Juli, Agustus
            $found = $usages->firstWhere('month', $month->month);
            $data[] = $found ? $found->total : 0;
        }

        return view('dashboard', compact('labels', 'data'));
    }
}
