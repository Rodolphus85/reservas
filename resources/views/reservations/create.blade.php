@extends('layouts.app')

@section('title', 'Nueva Reserva')

@section('content')

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="cards row justify-content-center">
        <div class="card card-center col-md-6">
            <div class="card-body">
                <h1>Nueva Reserva</h1>

                <form action="{{ route('reservations.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="reservation_date" class="form-label">Fecha</label>
                        <input type="date" id="reservation_date" name="reservation_date" 
                            class="form-control" 
                            value="{{ old('reservation_date') }}"
                        >
                    </div>
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Hora</label>
                        <input type="time" id="start_time" name="start_time" 
                            class="form-control"
                            value="{{ old('start_time') }}"
                        >
                    </div>
                    <div class="mb-3">
                        <label for="guest_count" class="form-label">Cantidad de personas</label>
                        <input type="number" id="guest_count" name="guest_count" 
                            class="form-control"
                            value="{{ old('guest_count') }}"
                        >
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Reservar
                    </button>
                </form>
            </div>
        </div>
    </div>
    
@endsection