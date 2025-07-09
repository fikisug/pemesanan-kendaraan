<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogger;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized.');
        }
        $reservations = Reservation::with('vehicle', 'approver1', 'approver2')->latest()->get();
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        $drivers = User::role('driver')->get(); // optional jika driver adalah user
        $approvers1 = User::role('approver_1')->get();
        $approvers2 = User::role('approver_2')->get();

        return view('reservations.create', compact('vehicles', 'drivers', 'approvers1', 'approvers2'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'nullable|exists:users,id',
            'approver_1_id' => 'required|exists:users,id',
            'approver_2_id' => 'required|exists:users,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'purpose' => 'required|string',
        ]);

        $reservation = Reservation::create([
            'user_id' => auth()->id(),
            'vehicle_id' => $validated['vehicle_id'],
            'driver_id' => $validated['driver_id'],
            'approver_1_id' => $validated['approver_1_id'],
            'approver_2_id' => $validated['approver_2_id'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'purpose' => $validated['purpose'],
        ]);
        ActivityLogger::log('create', $reservation, 'Membuat pemesanan kendaraan');
        return redirect()->route('reservations.index')->with('success', 'Pemesanan berhasil ditambahkan');
    }
}
