<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'App de Reservas')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>

<body class="d-flex flex-column min-vh-100 bg-success">
    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex align-items-center position-relative">
                @auth
                <ul class="nav col-12 col-lg-auto mb-2 justify-content-center mb-md-0 text-start">
                    <li><a href="{{ route('reservations.create') }}" 
                            class="nav-link px-2 text-secondary"
                        >Home</a>
                    </li>
                    @can('admin')
                    <li><a href="{{ route('tables.create') }}" 
                            class="nav-link px-2 text-white"
                        >Mesas</a>
                    </li>
                    <li><a href="{{ route('tables.index') }}" 
                            class="nav-link px-2 text-white"
                        >Listado Mesas</a>
                    </li>
                    <li><a href="{{ route('reservations.index') }}"  class="nav-link px-2 text-white"
                        >Listado Reservas</a>
                    </li>
                    @endcan
                </ul>
                @endauth
                <div class="position-absolute start-50 translate-middle-x text-center">
                    <h1>Reservas</h1>
                </div>

                <div class="ms-auto">
                @auth
                    <div class="d-flex justify-content-center align-items-center">
                        <span class="me-2 text-warning">
                            {{ auth()->user()->name }}
                        </span>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-light me-2">Cerrar Sesión</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('auth.login') }}" class="btn btn-outline-light me-2">Iniciar Sesión</a>
                    <a href="{{ route('auth.register') }}" class="btn btn-warning">Registrarse</a>
                @endauth                    
                </div>
            </div>
        </div>
    </header>

    <main class="content">
        <div class="container">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer class="footer mt-auto border-top">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            @auth
                <li class="nav-item"><a href="{{ route('reservations.create') }}" 
                    class="nav-link px-2 text-body-secondary">Home</a>
                </li>
                @can('admin')
                <li class="nav-item"><a href="{{ route('tables.create') }}" 
                    class="nav-link px-2 text-body-secondary">Mesas</a>
                </li>
                <li class="nav-item"><a href="{{ route('tables.index') }}" 
                    class="nav-link px-2 text-body-secondary">Listado Mesas</a>
                </li>
                <li class="nav-item"><a href="#" 
                    class="nav-link px-2 text-body-secondary">Listado Reservas</a>
                </li>
                @endcan
            @endauth
        </ul>
        <p class="text-center text-body-secondary">© {{ date('Y') }} Reservas</p>
    </footer>
</body>

</html>
