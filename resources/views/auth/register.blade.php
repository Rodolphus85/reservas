@extends('layouts.app')

@section('title', 'Registración')

@section('content')
    <div class="cards row justify-content-center">
        <div class="card card-center col-md-6">
            <div class="card-body">
                <h1 class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Registración</h1>

                <form method="POST" action="{{ route('register') }}" class="mx-1 mx-md-4">
                    @csrf
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <label class="form-label" for="name">Nombre</label>
                            <input type="text" id="name" name="name" class="form-control"/>
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control"/>
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control"/>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                        <button type="submit" data-mdb-button-init data-mdb-ripple-init
                            class="btn btn-primary btn-lg">Registrarse</button>
                    </div>
                </form>
            </div>
        </div>
    </div>    
@endsection