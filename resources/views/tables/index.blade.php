@extends('layouts.app')

@section('title', 'Mesas')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Mesas</h1>
        <a class="btn btn-primary" href="{{ route('tables.create') }}">Crear Mesa</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ubicación</th>
                <th scope="col">Número</th>
                <th scope="col">Cantida de personas</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tables as $table)
            <tr>
                <th scope="row">{{ $table->id }}</th>
                <td>{{ $table->location->code }}</td>
                <td>{{ $table->number }}</td>
                <td>{{ $table->guest_count }}</td>
                <td class="d-flex gap-2">
                    <a class="btn btn-primary" href="{{ route('tables.edit', ['id' => $table->id]) }}">Editar</a>
                    <form action={{ route('tables.destroy', $table->id) }} method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>                
            @endforeach
        </tbody>
    </table>

@endsection
