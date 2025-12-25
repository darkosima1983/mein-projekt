@extends('layout')

@section('title', 'Startseite')

@section('content')
<h1 class="mb-4 text-center">
    <i class="fa-solid fa-cloud-sun"></i> Aktuelle Wettervorhersage
</h1>

<p class="text-muted text-center">
    Hier siehst du die aktuellen Temperaturen.
</p>
@if(Illuminate\Support\Facades\Session::has('error'))
    <div class="alert alert-success">
        <i class="fa-solid fa-check"></i> {{ Illuminate\Support\Facades\Session::get('error') }}
    </div>
@endif
{{-- Suchformular --}}
<form action="{{ route('search') }}" method="GET" class="mb-4 d-flex justify-content-center">
    <input type="text" name="city" class="form-control w-50 me-2" placeholder="Stadt eingeben...">
    <button type="submit" class="btn btn-primary">Suchen</button>
</form>
{{-- Favoriten  --}}
   @if(session('error'))
       <div class="alert alert-danger">
        {{ session('error') }}
        </div>
    @endif
{{-- FAVORITI --}}
@if(Auth::check())
    <h2 class="mt-5 text-center">
        <i class="fa-solid fa-heart text-danger"></i> Deine Favoriten
    </h2>

    <div class="row justify-content-center mt-4">
        @forelse ($favoriteCities as $city)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card p-3 shadow-sm h-100">

                    <h5 class="text-center mb-2">{{ $city->name }}</h5>

                    @if ($city->todaysForecast)
                        <p class="mb-2 text-center">
                            <i class="fa-solid fa-temperature-half"></i>
                            Heute —
                            <strong>{{ $city->todaysForecast->temperature }}°C</strong>
                        </p>

                        <small class="text-center d-block">
                            <i class="{{ \App\Http\ForecastHelper::weatherIcon($city->todaysForecast->weather_type) }}"></i>
                            {{ ucfirst($city->todaysForecast->weather_type) }}
                        </small>
                    @else
                        <p class="text-muted text-center mb-0">
                            Keine Wetterdaten
                        </p>
                    @endif

                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted text-center">
                    Noch keine Favoriten gespeichert.
                </p>
            </div>
        @endforelse
        {{ $now->format('d.m.Y') }}
        {{ $now->format('H:i:s') }}

    </div>
@endif


@endsection
