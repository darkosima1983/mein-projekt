@extends('layout')

@section('title', 'Astronomy')

@section('content')
<div class="container text-center">
    <h1>{{ $city->name }}</h1>

    <div class="card mt-4 p-4 shadow-sm">
        <p>
            🌅 <strong>Sunrise:</strong> {{ $sunrise }}
        </p>
        <p>
            🌇 <strong>Sunset:</strong> {{ $sunset }}
        </p>
    </div>

    <a href="{{ route('home') }}" class="btn btn-secondary mt-3">
        Zurück
    </a>
</div>
@endsection
