<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stadt bearbeiten</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">Wetterdaten bearbeiten</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('update-city', $singleWeather->id) }}" method="POST">
        @csrf

        {{-- SELECT ZA GRADOVE --}}
        <div class="mb-3">
            <label class="form-label">Stadt auswählen</label>
            <select name="city_id" class="form-select" required>
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}"
                        {{ $singleWeather->city_id == $city->id ? 'selected' : '' }}>
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Temp --}}
        <div class="mb-3">
            <label class="form-label">Temperatur (°C)</label>
            <input type="text" name="temperature" class="form-control"
                   value="{{ $singleWeather->temperature }}" required>
        </div>

        {{-- Opis --}}
        <div class="mb-3">
            <label class="form-label">Beschreibung</label>
            <input type="text" name="description" class="form-control"
                   value="{{ $singleWeather->description }}">
        </div>

        <button class="btn btn-primary">Aktualisieren</button>
        <a href="{{ route('all-cities') }}" class="btn btn-secondary ms-2">Zurück</a>
    </form>
</div>

</body>
</html>
