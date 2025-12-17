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

<h2 class="mb-4 text-center">{{ $now->format('d.m.Y') }}</h2>
<h3 class="mb-4 text-center">{{ $now->format('H:i:s') }}</h3>

@endsection
