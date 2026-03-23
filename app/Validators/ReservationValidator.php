<?php

namespace App\Validators;

use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

class ReservationValidator
{
    private array $schedule = [
        1 => ['10:00', '24:00'], // lunes
        2 => ['10:00', '24:00'], // martes
        3 => ['10:00', '24:00'], // miércoles
        4 => ['10:00', '24:00'], // jueves
        5 => ['10:00', '24:00'], // viernes
        6 => ['22:00', '02:00'], // sábado
        0 => ['12:00', '16:00'], // domingo
    ];
    
    public function validate(array $data)
    {
        // 15 minutos antes
        $this->validateAfterTime($data);

        // duracion 2 horas
        $this->validateDuration($data);

        // horarios permitidos
        $this->validateDays($data);

    }

    private function validateAfterTime($data)
    {
        $reservationDateTime = Carbon::parse(
            $data['reservation_date'].' '.$data['start_time']
        );

        if ($reservationDateTime->lt(now()->addMinutes(15))) {
            throw ValidationException::withMessages([
                'start_time' => 'La reserva debe hacerse hasta 15 minutos antes.'
            ]);
        }
    }

    private function validateDays($data)
    {
        $date = Carbon::parse($data['reservation_date']);
        $reservation = Carbon::parse(
            $data['reservation_date'].' '.$data['start_time']
        );

        [$openTime, $closeTime] = $this->getHours($date);
        
        $reservation = Carbon::parse(
            $data['reservation_date'].' '.$data['start_time']
        );

        if ($reservation->lt($openTime) || $reservation->gt($closeTime)) {
            throw ValidationException::withMessages([
                'start_time' => 'La hora seleccionada está fuera del horario permitido.'
            ]);
        }
    }

    private function validateDuration(array $data)
    {
        $date = Carbon::parse($data['reservation_date']);
        $start = Carbon::parse($data['reservation_date'].' '.$data['start_time']);

        $end = $start->copy()->addHours(2);

        [$openTime, $closeTime] = $this->getHours($date);

        if ($end->gt($closeTime)) {
            throw ValidationException::withMessages([
                'start_time' => 'La reserva supera el horario de cierre.'
            ]);
        }
    }

    private function getHours(Carbon $date): array
    {
        [$open, $close] = $this->schedule[$date->dayOfWeek];

        $openTime = Carbon::parse($date->toDateString().' '.$open);
        $closeTime = Carbon::parse($date->toDateString().' '.$close);

        if ($closeTime->lessThan($openTime)) {
            $closeTime->addDay();
        }

        return [$openTime, $closeTime];
    }  
}