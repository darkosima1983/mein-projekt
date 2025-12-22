@extends('layout')

@section('title', 'Suchergebnisse')

@section('content')
<h1 class="mb-4 text-center">Suchergebnisse für: "{{ $cityName }}"</h1>

{{-- Zurück-Button --}}
<div class="text-center mb-4">
    <a href="{{ route('home') }}" class="btn btn-secondary">Zurück</a>
</div>


{{-- Suchergebnisse --}}
   @if(session('error'))
       <div class="alert alert-danger">
        {{ session('error') }}
        </div>
    @endif
@foreach ($cities as $city)
    <h4 class="mt-4">{{ $city->name }}</h4>

    @if ($city->todaysForecast)
        <a href="{{ route('user-cities.favorite', ['city' => $city->id]) }}"
           class="text-decoration-none text-reset">

            <div class="card p-3 position-relative shadow-sm" style="width:300px;">
                
                {{-- ❤️ Favorite --}}
                <span class="position-absolute top-0 end-0 p-2">
                    @if (in_array($city->id, $userFavorites))
                        <i class="fa-regular fa-heart text-danger"></i>
                    @else
                        <i class="fa-regular fa-heart"></i>
                    @endif
                </span>

                <p class="mb-2">
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
        </a>

    @else
        <p class="text-muted">Keine Wetterdaten für heute.</p>
    @endif
@endforeach




@endsection

