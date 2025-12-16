@extends('admin.admin-layout')

@section('title', 'Neue Wetterdaten hinzufügen')

@section('content')
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

    <div class="mb-3">
        <label class="form-label">Stadt auswählen</label>
        <select name="city_id" class="form-select" required>
            <option value="">-- Stadt wählen --</option>
            @foreach ($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Temperatur (°C)</label>
        <input type="number" name="temperature" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Beschreibung</label>
        <input type="text" name="description" class="form-control">
    </div>

    <button class="btn btn-success">
        <i class="fa-solid fa-plus"></i> Speichern
    </button>

    <a href="{{ route('all-cities') }}" class="btn btn-secondary ms-2">
        Abbrechen
    </a>
</form>
@endsection
