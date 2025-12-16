@extends('admin.admin-layout')

@section('title', 'Stadt bearbeiten')

@section('content')
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

    <div class="mb-3">
        <label class="form-label">Temperatur (°C)</label>
        <input type="number" name="temperature"
               class="form-control"
               value="{{ $singleWeather->temperature }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Beschreibung</label>
        <input type="text" name="description"
               class="form-control"
               value="{{ $singleWeather->description }}">
    </div>

    <button class="btn btn-primary">
        <i class="fa-solid fa-save"></i> Aktualisieren
    </button>

    <a href="{{ route('all-cities') }}" class="btn btn-secondary ms-2">
        Abbrechen
    </a>
</form>
@endsection
