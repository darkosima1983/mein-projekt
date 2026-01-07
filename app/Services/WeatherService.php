<?php

namespace App\Services;

use App\Models\CitiesModel;
use App\Models\ForecastsModel;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class WeatherService
{
 
    public function ensureForecast(string $cityName): CitiesModel
    {
        // 1️⃣ Poziv API-ja pre nego što kreiramo grad
        $response = Http::get(env('WEATHER_API_FORCEAST_URL'), [
            'key'  => env('WEATHER_API_KEY'),
            'q'    => $cityName,
            'days' => 5,
            'aqi'  => 'no',
            'lang' => 'de',
        ]);

        $data = $response->json();

        // 2️⃣ Provera da li API vraća grešku
        if (!empty($data['error'])) {
            $message = is_array($data['error']) && isset($data['error']['message'])
                ? $data['error']['message']
                : $data['error'];
            throw new \Exception("API Error: " . $message);
        }

        // 3️⃣ Kreiranje grada samo ako API vrati validnu prognozu
        $city = CitiesModel::firstOrCreate([
            'name' => ucfirst(strtolower($cityName))
        ]);

        // 4️⃣ Provera da li već postoji prognoza za danas
        $today = Carbon::today()->toDateString();

        $hasTodayForecast = ForecastsModel::where('city_id', $city->id)
            ->whereDate('forecast_date', $today)
            ->exists();

        if ($hasTodayForecast) {
            // Prognoza za danas već postoji, ne zovemo API ponovo
            return $city;
        }

        // 5️⃣ Upis prognoze u bazu (5 dana)
        foreach ($data['forecast']['forecastday'] as $day) {
            ForecastsModel::updateOrCreate(
                [
                    'city_id' => $city->id,
                    'forecast_date' => $day['date'],
                ],
                [
                    'temperature' => $day['day']['avgtemp_c'],
                    'weather_type' => $day['day']['condition']['text'],
                    'probability' => $day['day']['daily_chance_of_rain'],
                ]
            );
        }

        return $city;
    }
}
