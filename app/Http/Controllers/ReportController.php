<?php

namespace App\Http\Controllers;

use App\Exports\ReservationExport;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized.');
        }

        $start = $request->query('start_date');
        $end = $request->query('end_date');

        $reservations = collect(); // kosongkan default, agar tidak render semua data

        if ($start && $end) {
            $reservations = Reservation::with('vehicle', 'user')
                ->whereBetween('start_time', [$start, $end])
                ->latest()
                ->get();
        }

        return view('reports.reservations', compact('reservations', 'start', 'end'));
    }


    public function export(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized.');
        }
        return Excel::download(
            new ReservationExport($request->start_date, $request->end_date),
            'laporan_pemesanan.xlsx'
        );
    }
}
