<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alle Städte — WetterApp</title>
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
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Alle Städte</h2>
        <a href="{{ route('add-city') }}" class="btn btn-success">Neue Stadt hinzufügen</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card {{ $theme === 'dark' ? 'bg-secondary text-white' : '' }}">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead class="{{ $theme === 'dark' ? 'table-dark' : '' }}">
                        <tr>
                            <th>#</th>
                            <th>Stadt</th>
                            <th>Temperatur</th>
                            <th>Beschreibung</th>
                            <th>Erstellt</th>
                            <th>Aktionen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($weathers as $weather)
                            <tr>
                                <td>{{ $weather->id }}</td>
                                <td>{{ $weather->city->name }}</td>
                                <td>{{ $weather->temperature }}</td>
                                <td>{{ $weather->description }}</td>
                                <td>{{ $weather->created_at ? $weather->created_at->format('d.m.Y H:i') : '-' }}</td>
                                <td>
                                    <a href="{{ route('edit-city', $weather->id) }}" class="btn btn-sm btn-primary">Bearbeiten</a>

                                    <!-- Delete form -->
                                    <form action="{{ route('delete-city', $weather->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Möchten Sie diese Stadt wirklich löschen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Löschen</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">Keine Städte vorhanden.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
