<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Validators\ReservationValidator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function create(): View
    {
        return view('reservations.create');
    }

    public function store(Request $request, ReservationValidator $validator)
    {
        $validatedData = $request->validate([
            'reservation_date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
            'guest_count' => ['required', 'integer', 'min:1'],
        ]);

        $validator->validate($validatedData);

        $startTime = Carbon::parse($validatedData['start_time']);
        $endTime = $startTime->copy()->addHours(2);

        Reservation::create([
            'reservation_date' => $validatedData['reservation_date'],
            'start_time' => $validatedData['start_time'],
            'guest_count' => $validatedData['guest_count'],
            'user_id' => 1, // TO DO asignar usuario correspondiente
            'end_time' => $endTime->format('H:i:s')
        ]);

        return redirect()->route('reservations.create')
            ->with('success', 'Reserva realizada.')
        ;
    }
}
