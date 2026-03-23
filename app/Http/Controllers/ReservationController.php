<?php

namespace App\Http\Controllers;


use App\Services\ReservationService;
use App\Validators\ReservationValidator;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function create(): View
    {
        return view('reservations.create');
    }

    public function store(
        Request $request, 
        ReservationValidator $validator, 
        ReservationService $reservationService
    ) {
        $validatedData = $request->validate([
            'reservation_date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
            'guest_count' => ['required', 'integer', 'min:1'],
        ]);

        $validator->validate($validatedData);

        $reservationService->createReservation($validatedData);

        return redirect()
            ->route('reservations.create')
            ->with('success', 'Reserva realizada.')
        ;
    }
}
