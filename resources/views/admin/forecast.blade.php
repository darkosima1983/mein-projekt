
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('forecast.store') }}" method="POST" class="mb-5">
    @csrf

    <div class="row g-3 align-items-end">
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
            <option value="">-- Weather type wählen --</option>
            <select name="weather_type" class="form-select" required>
                 @foreach (\App\Models\ForecastsModel::WEATHERS as $type)
                    <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-success w-100">Hinzufügen</button>
        </div>
    </div>
</form>

@foreach ($cities as $city)
    <h2> {{ $city->name }}</h2>

    <div class="forecast-container d-flex gap-2 mb-4">
        @forelse ($city->forecasts as $forecast)
            <div class="card p-2" style="width: 300px;">
                <p>{{ $forecast->forecast_date }} - {{ $forecast->temperature }}°C - {{$forecast->weather_type}}</p>
                
            </div>
        @empty
            <p>Keine Vorhersagen für diese Stadt.</p>
        @endforelse
    </div>
@endforeach
