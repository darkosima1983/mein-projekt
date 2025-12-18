@extends('layout')

@section('title', 'Suchergebnisse')

@section('content')
<h1 class="mb-4 text-center">Suchergebnisse für: "{{ $cityName }}"</h1>

{{-- Zurück-Button --}}
<div class="text-center mb-4">
    <a href="{{ route('home') }}" class="btn btn-secondary">Zurück</a>
</div>


{{-- Suchergebnisse --}}
@foreach ($cities as $city)
    <h4 class="mt-4">{{ $city->name }}</h4>

    @if ($city->todaysForecast)
        <div class="card p-3" style="width:300px;">
            <p>
                <i class="fa-solid fa-temperature-half"></i>
                Heute —
                <strong>{{ $city->todaysForecast->temperature }}°C</strong>
            </p>

            <small>
                <i class="{{ \App\Http\ForecastHelper::weatherIcon($city->todaysForecast->weather_type) }}"></i>
                {{ ucfirst($city->todaysForecast->weather_type) }}
                @if($city->todaysForecast->probability !== null)
                    · {{ $city->todaysForecast->probability }}%
                @endif
            </small>
        </div>
    @else
        <p class="text-muted">Keine Wetterdaten für heute.</p>
    @endif
@endforeach

@endsection

