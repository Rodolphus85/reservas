@extends('layouts.app')

@section('title', 'Listado de Reservas')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Reservas realizadas</h1>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
                <th scope="col"># Reserva</th>
                <th scope="col">Ubicación</th>
                <th scope="col"># Mesa</th>
                <th scope="col">Reservada por</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
            <tr>
                <th scope="row">{{ $reservation->reservation_date}}</th>
                <td>{{ $reservation->start_time }}</td>
                <td>{{ $reservation->id }}</td>
                <td>{{ $reservation->code }}</td>
                <td>{{ $reservation->number }}</td>
                <td>{{ $reservation->user_name }}</td>
            </tr>                
            @endforeach
        </tbody>
    </table>
@endsection
