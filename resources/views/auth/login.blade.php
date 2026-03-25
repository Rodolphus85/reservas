@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
    <div class="cards row justify-content-center">
        <div class="card card-center col-md-6">
            <div class="card-body">
                <h1>Iniciar sesión</h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-outline mb-4">
                        <label class="form-label" for="email">Dirección de Email</label>
                        <input type="email" id="email" name="email" class="form-control"/>
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control"/>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block mb-4">
                        Ingresar
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
