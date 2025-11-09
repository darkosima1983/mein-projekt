<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stadt bearbeiten — WetterApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

@php
    $theme = session('theme', 'light');
@endphp

<body class="{{ $theme === 'dark' ? 'bg-dark text-white' : 'bg-light text-dark' }}">

<nav class="navbar navbar-expand-lg {{ $theme === 'dark' ? 'navbar-dark bg-dark' : 'navbar-light bg-white shadow-sm' }}">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('all-cities') }}">WetterApp</a>
        <div>
            <a href="{{ route('theme.switch', 'dark') }}" class="btn btn-outline-light btn-sm me-2">🌙</a>
            <a href="{{ route('theme.switch', 'light') }}" class="btn btn-outline-secondary btn-sm">☀️</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card {{ $theme === 'dark' ? 'bg-secondary text-white' : '' }}">
                <div class="card-body">
                    <h3 class="card-title mb-3">Stadt bearbeiten</h3>

                    {{-- Poruka o uspehu --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Greške --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Forma --}}
                    <form action="{{ route('update-city', $singleWeather->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="city" class="form-label">Stadt</label>
                            <input type="text" id="city" name="city" value="{{ old('city', $singleWeather->city) }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="temperature" class="form-label">Temperatur (°C)</label>
                            <input type="text" id="temperature" name="temperature" value="{{ old('temperature', $singleWeather->temperature) }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Wetterbeschreibung</label>
                            <input type="text" id="description" name="description" value="{{ old('description', $singleWeather->description) }}" class="form-control">
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('all-cities') }}" class="btn btn-outline-secondary">Zurück</a>
                            <button type="submit" class="btn btn-primary">Speichern</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
