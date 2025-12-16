@extends('layout')

@section('title', 'Startseite')

@section('content')
    <h1 class="mb-4 text-center">
        <i class="fa-solid fa-cloud-sun"></i> Aktuelle Wettervorhersage
    </h1>

    <p class="text-muted text-center">
        Hier siehst du die aktuellen Temperaturen.
    </p>

    <div class="d-flex flex-wrap justify-content-center gap-3">
        @foreach ($weathers as $weather)
            <div class="card p-3 text-center" style="width: 200px;">
                <h5>{{ $weather->city->name }}</h5>
                <strong>{{ $weather->temperature }}°C</strong>
                <p class="text-muted">{{ $weather->description }}</p>
            </div>
        @endforeach
    </div>
@endsection
