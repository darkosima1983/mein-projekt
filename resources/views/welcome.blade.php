<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MeinProjekt — Willkommen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
@php
    $theme = session('theme', 'light'); // default je light
@endphp
<body class="{{ $theme === 'dark' ? 'bg-dark text-white' : 'bg-light text-dark' }}">
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="/">MeinProjekt</a>
            <div>
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">Anmelden</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-sm">Registrieren</a>
                    @endif
                @else
                    <span class="text-white me-2">Hallo, {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">Abmelden</button>
                    </form>
                @endguest
                <a href="{{ route('theme.switch', 'dark') }}" class="btn btn-outline-light btn-sm">🌙 Dark</a>
                <a href="{{ route('theme.switch', 'light') }}" class="btn btn-outline-secondary btn-sm">☀️ Light</a>

            </div>
        </div>
    </nav>

    <div class="container text-center mt-5">
        <h1 class="mb-3">Willkommen bei MeinProjekt</h1>
        <p class="text-muted">Dies ist die Startseite deines neuen Laravel-Forums.</p>

        @guest
            <div class="mt-4">
                <a href="{{ route('login') }}" class="btn btn-primary me-2">Anmelden</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-secondary">Registrieren</a>
                @endif
            </div>
        @else
            <div class="mt-4">
                <a href="/home" class="btn btn-success">Zum Dashboard</a>
            </div>
        @endguest
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
