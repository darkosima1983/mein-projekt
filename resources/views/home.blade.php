<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wettervorhersage — MeinProjekt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

@php
    $theme = session('theme', 'light'); // Standard: light
@endphp

<body class="{{ $theme === 'dark' ? 'bg-dark text-white' : 'bg-light text-dark' }}">
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="/">WetterApp</a>
            <div>
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">Anmelden</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-sm me-2">Registrieren</a>
                    @endif
                @else
                    <span class="text-white me-2">👋 Hallo, {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm me-2">Abmelden</button>
                    </form>
                @endguest

                {{-- Dark/Light Switch --}}
                <a href="{{ route('theme.switch', 'dark') }}" class="btn btn-outline-light btn-sm me-2">🌙 Dunkel</a>
                <a href="{{ route('theme.switch', 'light') }}" class="btn btn-outline-secondary btn-sm">☀️ Hell</a>

                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('all-cities') }}" class="btn btn-sm btn-danger ms-2">
                        Admin
                        </a>
                    @endif
                @endauth

            </div>
        </div>
    </nav>

    <div class="container mt-5 text-center">
        <h1 class="mb-4">Aktuelle Wettervorhersage</h1>
        <p class="text-muted">Hier siehst du die aktuellen Temperaturen in fünf bayerischen Städten.</p>

        
            <div class="card-body" style="display: flex; flex-wrap: wrap; gap: 20px;">
                @foreach ($weathers as $weather)
                <div class="card" style="width: 200px;">
                    <h5>{{ $weather->city }}</h5>
                    <p>{{ $weather->temperature }}°C</p>
                    <p>{{ $weather->description }}</p>
                </div>
                @endforeach
            </div>
        
        


        @guest
            <div class="mt-5">
                <a href="{{ route('login') }}" class="btn btn-primary me-2">Anmelden</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-secondary">Registrieren</a>
                @endif
            </div>
        @else
            <div class="mt-5">
                <a href="/dashboard" class="btn btn-success">Zum Dashboard</a>
            </div>
        @endguest
    </div>

    <footer class="text-center mt-5 mb-3">
        <p class="text-muted">© {{ date('Y') }} WetterApp — Erstellt mit Laravel</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
