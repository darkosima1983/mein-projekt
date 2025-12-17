@extends('layout')

@section('title', 'Startseite')

@section('content')

    <h1 class="mb-4 text-center">
        <i class="fa-solid fa-cloud-sun"></i> Aktuelle Wettervorhersage
    </h1>

    <p class="text-muted text-center">
        Hier siehst du die aktuellen Temperaturen.
    </p>

    {{-- SEARCH FORM --}}
    <div class="row justify-content-center mb-4">
        <div class="col-md-6 col-lg-4">
            <form method="GET" action="#" class="d-flex gap-2">
                <input
                    type="text"
                    name="city"
                    class="form-control"
                    placeholder="Stadt eingeben..."
                >
                <button class="btn btn-primary">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </div>

    {{-- WEATHER CARDS --}}
    <div class="d-flex flex-wrap justify-content-center gap-3">
        @foreach ($weathers as $weather)
            <div class="card p-3 text-center shadow-sm" style="width: 200px;">
                <h5 class="mb-1">
                    <i class="fa-solid fa-location-dot"></i>
                    {{ $weather->city->name }}
                </h5>

                <strong class="fs-4">
                    {{ $weather->temperature }}°C
                </strong>

                <p class="text-muted mb-0">
                    {{ $weather->description ?? '—' }}
                </p>
            </div>
        @endforeach
    </div>

@endsection
