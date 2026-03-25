<?php

namespace App\Services;

use App\Models\Reservation;
use App\Services\AvailabilityService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ReservationService
{
    public function __construct(
        private AvailabilityService $availability
    ) {}

    public function createReservation(array $data)
    {
        $startDateTime = Carbon::parse(
            $data['reservation_date'].' '.$data['start_time']
        );

        $endTime = $startDateTime->copy()->addHours(2);
        $startTime = Carbon::parse($data['start_time']);
        $startDate = Carbon::parse($data['reservation_date']);
        $endTime = $startDateTime->copy()->addHours(2);

        $tables = $this->availability->findTables(
            $startDate,
            $startTime,
            $endTime,
            $data['guest_count']
        );

        if (!$tables) {
            throw ValidationException::withMessages([
                'guest_count' => 'No hay mesas disponibles.'
            ]);
        }

        return DB::transaction(function () use ($data, $endTime, $tables, $startDate) {

            $reservation = Reservation::create([
                'reservation_date' => $data['reservation_date'],
                'start_time' => $data['start_time'],
                'guest_count' => $data['guest_count'],
                'user_id' => Auth::user()->id,
                'end_time' => $endTime->format('H:i:s')
            ]);

            $tableIds = collect($tables)->pluck('id');

            $reservation->tables()->attach($tableIds);

            Cache::forget('occupied_tables_'.$startDate->format('Y-m-d'));

            return $reservation;
        });
    }
}