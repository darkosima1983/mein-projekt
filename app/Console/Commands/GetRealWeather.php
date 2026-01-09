<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\CitiesModel;
use App\Models\ForecastsModel;
class GetRealWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:get-real {city}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get 5-day weather forecast for a city';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $city = $this->argument('city');
        // porovera da li grad postoji
        //izvadi iz Cities grade ako ne postoji kreiraj novi
        
        $dbCity = CitiesModel::where('name', $city)->first();
        
        if ($dbCity === null) {
            $dbCity = CitiesModel::create(['name' => $city]);
        }


        
        $response = Http::get(env('WEATHER_API_FORCEAST_URL'), [
            'key'  => env('WEATHER_API_KEY'),
            'q'    => $city,
            'days' => 5,
            'aqi'  => 'no',
            'lang' => 'de',
        ]);

        $data = $response->json();

        if (isset($data['error'])) {
            $this->error($data['error']['message']);
            return;
        }
        //provera da li vec postoji prognoza za danas
        if ($dbCity->todaysForecast !== null) {
            $this->info("Today's forecast for {$city} already exists in the database.");
            return;
        }
       $data['forecast']['forecastday'][0]['day'];

        $forecastDate = $data['forecast']['forecastday'][0]['date'];
        $temperature = $data['forecast']['forecastday'][0]['day']['avgtemp_c'];
        $weatherType = $data['forecast']['forecastday'][0]['day']['condition']['text'];
        $probability = $data['forecast']['forecastday'][0]['day']['daily_chance_of_rain'];
        
        $forecast = ["city_id"=>$dbCity->id,
                    "forecast_date"=> $forecastDate,
                    "temperature"=>$temperature,
                    "weather_type"=>$weatherType,
                    "probability"=>$probability
                ];
        ForecastsModel::create($forecast);
        $this->info("Forecast for {$city} on {$forecastDate} saved successfully.");
    }
}