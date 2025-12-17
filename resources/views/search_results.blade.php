@extends('layout')

@section('title', 'Suchergebnisse')

@section('content')
<h1 class="mb-4 text-center">Suchergebnisse für: "{{ $cityName }}"</h1>

{{-- Zurück-Button --}}
<div class="text-center mb-4">
    <a href="{{ route('home') }}" class="btn btn-secondary">Zurück</a>
</div>


{{-- Suchergebnisse --}}
<div class="d-flex flex-wrap justify-content-center gap-3 mb-5">
    @foreach ($cities as $city)
        <div class="card p-3 text-center" style="width: 200px;">
            <h5>{{ $city->name }}</h5>
        </div>
    @endforeach
</div>


@endsection

