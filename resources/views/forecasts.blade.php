@foreach($weathers as $weather)
    <div>
        <h3>{{ $weather->forecast_date }}</h3>
        <p>Temperature: {{ $weather->temperature }}°C</p>
    
    </div>
@endforeach