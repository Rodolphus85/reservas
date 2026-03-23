<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class AvailabilityService
{
    public function findTables(Carbon $startDate, Carbon $startTime, 
        Carbon $endTime, int $guestCount
    ) {
        $key = 'occupied_tables_'. $startDate->format('Y-m-d');

        $reservations = Cache::remember($key, 300, function () use ($startDate) {

            return Reservation::with('tables')
                ->where('reservation_date', $startDate->format('Y-m-d'))
                ->get();
        });

        $overlappingReservations = $reservations->filter(function ($reservation)
            use ($startTime, $endTime) {
        
            return $reservation->start_time < $endTime->format('H:i:s')
                && $reservation->end_time > $startTime->format('H:i:s');
        });

        $occupiedTableIds = $overlappingReservations
            ->flatMap(function ($reservation) {
                return $reservation->tables->pluck('id');
            })
            ->unique()
        ;
        
        $availableTables = Table::select('tables.*')
            ->join('locations', 'locations.id', '=', 'tables.location_id')
            ->whereNotIn('tables.id', $occupiedTableIds)
            ->orderBy('locations.code')
            ->get()
        ;

        $tablesByLocation = $availableTables->groupBy('location_id');

        foreach ($tablesByLocation as $locationTables) {

            $tables = $locationTables->values();

            $count = $tables->count();

            for ($i = 0; $i < $count; $i++) {

                if ($tables[$i]->guest_count >= $guestCount) {
                    return [$tables[$i]];
                }

                for ($j = $i + 1; $j < $count; $j++) {

                    $capacity = $tables[$i]->guest_count + $tables[$j]->guest_count;

                    if ($capacity >= $guestCount) {
                        return [$tables[$i], $tables[$j]];
                    }

                    for ($k = $j + 1; $k < $count; $k++) {

                        $capacity = $tables[$i]->guest_count +
                                    $tables[$j]->guest_count +
                                    $tables[$k]->guest_count;

                        if ($capacity >= $guestCount) {
                            return [$tables[$i], $tables[$j], $tables[$k]];
                        }
                    }
                }
            }
        }
    }
}

