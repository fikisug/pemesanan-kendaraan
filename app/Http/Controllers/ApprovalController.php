<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogger;
use App\Models\ApprovalLog;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (!$user->hasRole('approver_1') && !$user->hasRole('approver_2')) {
            abort(403, 'Unauthorized.');
        }
        $level = $user->hasRole('approver_1') ? 'approver_1_id' : 'approver_2_id';
        $status = $user->hasRole('approver_1') ? 'pending' : 'approved_lvl1';

        $reservations = Reservation::where($level, $user->id)
            ->where('status', $status)
            ->get();

        return view('approvals.index', compact('reservations'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $user = auth()->user();

        // Pastikan hanya approver_1 atau approver_2 yang bisa update
        if (!($user->hasRole('approver_1') || $user->hasRole('approver_2'))) {
            abort(403);
        }

        // Cek level approval
        $level = $user->hasRole('approver_1') ? 'level_1' : 'level_2';
        $status = $request->input('action') === 'approve' ? 'approved' : 'rejected';

        // Tambah log
        $reservation->approvals()->create([
            'approver_id' => $user->id,
            'level' => $level,
            'status' => $status,
            'note' => null,
        ]);

        // Update status reservation
        if ($level === 'level_1' && $status === 'approved') {
            $reservation->status = 'approved_lvl1';
        } elseif ($level === 'level_2' && $status === 'approved') {
            $reservation->status = 'approved_lvl2';
        } else {
            $reservation->status = 'rejected';
        }

        $reservation->save();

        ActivityLogger::log(
            $status,
            $reservation,
            'Reservasi kendaraan #' . $reservation->id .
                ' telah di-' . ($status === 'approved' ? 'setujui' : 'tolak') .
                ' oleh ' . $level
        );
        
        return redirect()->route('approvals.index')->with('success', 'Pemesanan berhasil di-' . ($status === 'approved' ? 'setujui' : 'tolak'));
    }
}
