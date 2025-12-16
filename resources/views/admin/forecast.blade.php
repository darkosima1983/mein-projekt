@extends('layout')

@section('title', 'Forecasts')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        <i class="fa-solid fa-check"></i> {{ session('success') }}
    </div>
@endif

<h2 class="mb-4">
    <i class="fa-solid fa-calendar-days"></i> Wetter Forecasts
</h2>

<form action="{{ route('forecast.store') }}" method="POST" class="mb-5">
    @csrf

    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label">Stadt</label>
            <select name="city_id" class="form-select" required>
                <option value="">-- Stadt wählen --</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label">Datum</label>
            <input type="date" name="forecast_date" class="form-control" required>
        </div>

        <div class="col-md-3">
            <label class="form-label">Temperatur (°C)</label>
            <input type="number" name="temperature" class="form-control" required>
        </div>

        <div class="col-md-3">
            <label class="form-label">Weather type</label>
            <select name="weather_type" class="form-select" required>
                @foreach (\App\Models\ForecastsModel::WEATHERS as $type)
                    <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-success w-100">
                <i class="fa-solid fa-plus"></i> Hinzufügen
            </button>
        </div>
    </div>
</form>

@foreach ($cities as $city)
    <h4 class="mt-4">{{ $city->name }}</h4>

    <div class="d-flex gap-3 flex-wrap">
        @forelse ($city->forecasts as $forecast)
            <div class="card p-3" style="width:300px;">
                <p>
                    <i class="fa-solid fa-temperature-half"></i>
                    {{ $forecast->forecast_date }} —
                    <strong>{{ $forecast->temperature }}°C</strong>
                </p>
                <small>
    <i class="{{ \App\Http\ForecastHelper::weatherIcon($forecast->weather_type) }}"></i>
    {{ ucfirst($forecast->weather_type) }}
    · {{ $forecast->probability }}%
</small>

            </div>
        @empty
            <p class="text-muted">Keine Vorhersagen.</p>
        @endforelse
    </div>
@endforeach

@endsection
