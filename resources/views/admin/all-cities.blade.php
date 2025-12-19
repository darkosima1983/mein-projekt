@extends('admin.admin-layout')

@section('title', 'Alle Städte')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Alle Städte</h2>
    <a href="{{ route('add-city') }}" class="btn btn-success">
        <i class="fa-solid fa-plus"></i> Neue Stadt
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card {{ session('theme') === 'dark' ? 'bg-dark text-white' : '' }}">
    <div class="table-responsive">
        <table class="table align-middle mb-0 {{ session('theme') === 'dark' ? 'table-dark table-striped' : 'table-striped' }}">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Stadt</th>
                    <th>Temperatur</th>
                    <th>Aktionen</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($weathers as $weather)
                    <tr>
                        <td>{{ $weather->id }}</td>
                        <td>{{ $weather->city->name }}</td>
                        <td>{{ $weather->temperature }}°C</td>
                    
                        <td>
                            <a href="{{ route('edit-city', $weather->id) }}" class="btn btn-sm btn-primary">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('delete-city', $weather->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Keine Städte</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
