<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Allevamento Pro') }} - Admin</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand font-weight-bold text-success" href="{{ route('admin.dashboard') }}">
                <i class="fa-solid fa-paw"></i> STARBOUND KENNEL
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active fw-bold' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="fa-solid fa-chart-pie me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.adults.*') ? 'active fw-bold' : '' }}" href="{{ route('admin.adults.index') }}">
                            <i class="fa-solid fa-dog me-1"></i> Adulti
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.litters.*') ? 'active fw-bold' : '' }}" href="{{ route('admin.litters.index') }}">
                            <i class="fa-solid fa-folder-open me-1"></i> Cucciolate
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.puppies.*') ? 'active fw-bold' : '' }}" href="{{ route('admin.puppies.index') }}">
                            <i class="fa-solid fa-dog me-1"></i> Cuccioli Anagrafica
                        </a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-3">
                    @auth
                        <span class="text-light small">
                            <i class="fa-solid fa-user me-1 text-muted"></i> {{ Auth::user()?->name }}
                        </span>
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fa-solid fa-right-from-bracket"></i> Esci
                            </button>
                        </form>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}" class="btn btn-sm btn-success">
                            Accedi
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-sm btn-success">
                            Registrati
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

</body>
</html>