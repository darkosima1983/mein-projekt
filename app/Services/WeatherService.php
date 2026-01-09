<?php

namespace App\Services;

use App\Models\CitiesModel;
use App\Models\ForecastsModel;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class WeatherService
{
 
    public function getForecast ($city)
    {
        $response = Http::get(env('WEATHER_API_FORECAST_URL'), [
            'key'  => env('WEATHER_API_KEY'),
            'q'    => $city,
            'aqi'  => 'no',
            'lang' => 'de',
        ]);
     
     return $response->json();
    }
    public function getAstronomy ($city)
    {
        $response = Http::get(env('WEATHER_API_ASTRONOMY_URL'), [
            'key'  => env('WEATHER_API_KEY'),
            'q'    => $city,
            'aqi'  => 'no',
        ]);
        return $response->json();
    }
}