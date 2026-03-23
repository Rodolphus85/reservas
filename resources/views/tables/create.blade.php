@extends('layouts.app')

@section('title', 'Creación de Mesa')

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

    <div class="cards">
        <div class="card card-center">
            <div class="card-body">
                <h1>Nueva Mesa</h1>

                <form action={{ route('tables.store') }} method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="location">Ubicacion</label>
                        <select name="location" id="location" class="form-control">
                            @foreach ($locationOptions as $label => $value)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="number">Número de mesa</label>
                        <input type="number" class="form-control" id="number" name="number" placeholder="Número">
                    </div>
                    <div class="form-group">
                        <label for="guest_count">Cantidad de personas</label>
                        <input type="number" class="form-control" id="guest_count" name="guest_count"
                            placeholder="Cantidad">
                    </div>
                    <button type="submit" class="btn btn-primary">Crear</button>
                    <a class="btn btn-warning" href="{{ route('tables.index') }}">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
