<?php

namespace App\Http\Controllers;


use App\Services\ReservationService;
use App\Validators\ReservationValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function index(): View
    {
        $reservations = DB::table('reservations AS r')
            ->join('reservation_table AS rt', 'r.id', '=', 'rt.reservation_id')
            ->join('tables AS t', 'rt.table_id', '=', 't.id')
            ->join('locations as l', 't.location_id', '=', 'l.id')
            ->select('r.reservation_date', 'r.start_time', 'r.id', 'l.code', 't.number')
            ->orderBy('r.reservation_date')
            ->orderBy('r.start_time')
            ->get()
        ;

        return view('reservations.index', compact('reservations'));
    }

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
