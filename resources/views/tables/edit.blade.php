@extends('layouts.app')

@section('title', 'Edición de Mesa')

@section('content')
    <div class="cards">
        <div class="card card-center">
            <div class="card-body">
                <h1>Edición de Mesa</h1>

                <form action={{ route('tables.update', $table->id) }} method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="location">Ubicacion</label>
                        <select name="location" id="location" class="form-control">
                            @foreach ($locationOptions as $label => $value)
                                <option value="{{ $value }}" 
                                  {{ old('location', $table->location_id) == $value
                                    ? 'selected' : '' 
                                  }}
                                >{{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="number">Número de mesa</label>
                        <input type="number" class="form-control" id="number" name="number" 
                          placeholder="Número"
                          value="{{ old('number', $table->number ?? '') }}"
                        >
                    </div>
                    <div class="form-group">
                        <label for="guest_count">Cantidad de personas</label>
                        <input type="number" class="form-control" id="guest_count" name="guest_count"
                          placeholder="Cantidad"
                          value="{{ old('guest_count', $table->guest_count ?? '') }}"
                        >
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a class="btn btn-warning" href="{{ route('tables.index') }}">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
