<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'WetterApp')</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}  
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @yield('styles')
</head>

@php
    $theme = session('theme', 'light');
@endphp

<body class="{{ $theme === 'dark' ? 'bg-dark text-white' : 'bg-light text-dark' }}">

{{-- NAVBAR --}}
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">WetterApp</a>

        <div>
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">
                    <i class="fa-solid fa-right-to-bracket"></i> Anmelden
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-sm">
                        <i class="fa-solid fa-user-plus"></i> Registrieren
                    </a>
                @endif
            @else
                <span class="text-white me-2">
                    <i class="fa-solid fa-user"></i> {{ Auth::user()->name }}
                </span>

                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </button>
                </form>
            @endguest

            <a href="{{ route('theme.switch','dark') }}" class="btn btn-sm btn-outline-light ms-2">🌙</a>
            <a href="{{ route('theme.switch','light') }}" class="btn btn-sm btn-outline-secondary">☀️</a>

            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('all-cities') }}" class="btn btn-danger btn-sm ms-2">
                        <i class="fa-solid fa-gears"></i> Admin
                    </a>
                @endif
            @endauth
        </div>
    </div>
</nav>

{{-- CONTENT --}}
<div class="container mt-5">
    @yield('content')
</div>

{{-- FOOTER --}}
@include('footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')

</body>
</html>
