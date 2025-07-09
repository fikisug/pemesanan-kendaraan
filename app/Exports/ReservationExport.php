<?php

namespace App\Exports;

use App\Models\Reservation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReservationExport implements FromView
{
    protected $start;
    protected $end;

    public function __construct($start = null, $end = null)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function view(): View
    {
        $reservations = Reservation::with('vehicle', 'user')
            ->when($this->start && $this->end, function ($query) {
                $query->whereBetween('start_time', [$this->start, $this->end]);
            })
            ->orderBy('start_time')
            ->get();

        return view('exports.reservations', [
            'reservations' => $reservations
        ]);
    }
}
