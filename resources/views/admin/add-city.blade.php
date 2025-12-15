<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Neue Wetterdaten hinzufügen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">Neue Wetterdaten hinzufügen</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('add-city') }}" method="POST">
        @csrf

        {{-- SELECT ZA GRADOVE --}}
        <div class="mb-3">
            <label class="form-label">Stadt auswählen</label>
            <select name="city_id" class="form-select" required>
                <option value="">-- Stadt wählen --</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Temperatura --}}
        <div class="mb-3">
            <label class="form-label">Temperatur (°C)</label>
            <input type="text" name="temperature" class="form-control" required>
        </div>

        {{-- Opis vremena --}}
        <div class="mb-3">
            <label class="form-label">Beschreibung</label>
            <input type="text" name="description" class="form-control">
        </div>

        <button class="btn btn-success">Speichern</button>
        <a href="{{ route('all-cities') }}" class="btn btn-secondary ms-2">Zurück</a>
    </form>
</div>

</body>
</html>
