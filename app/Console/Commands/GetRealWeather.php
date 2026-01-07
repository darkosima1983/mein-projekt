<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
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
        
        /*  $response = Http::get(env('WEATHER_API_URL'), [
            'key'  => env('WEATHER_API_KEY'),
            'q'    => $this->argument('city'),
            'aqi'  => 'no',
            'lang' => 'de',
        ]);*/

        $response = Http::get(env('WEATHER_API_FORCEAST_URL'), [
            'key'  => env('WEATHER_API_KEY'),
            'q'    => $this->argument('city'),
            'days' => 5,
            'aqi'  => 'no',
            'lang' => 'de',z
        ]);

        $data = $response->json();

        if (isset($data['error'])) {
            $this->error($data['error']['message']);
            return;
        }
        /*
        $this->info("Weather in {$data['location']['name']}, {$data['location']['country']}:"); 
        $this->info("Temperature: " . $data['current']['temp_c'] . "°C"); 
        $this->info("Feels like: " . $data['current']['feelslike_c'] . "°C"); 
        $this->info("Condition: " . $data['current']['condition']['text']); 
        $this->info("Wind: " . $data['current']['wind_kph'] . " kph"); 
        $this->info("Humidity: " . $data['current']['humidity'] . "%"); 
        $this->info("Cloud cover: " . $data['current']['cloud'] . "%");
        */

        $this->info("{$data['location']['name']}, {$data['location']['country']}");
        $this->info("5-Tage Wettervorhersage");
        $this->line(str_repeat('-', 40));

        foreach ($data['forecast']['forecastday'] as $day) {
            $this->info("Datum: {$day['date']}");
            $this->line("Ø Temp: {$day['day']['avgtemp_c']} °C");
            $this->line("Wetter: {$day['day']['condition']['text']}");
            $this->line("Wind: {$day['day']['maxwind_kph']} kph");
            $this->line("Luftfeuchtigkeit: {$day['day']['avghumidity']} %");
            $this->line(str_repeat('-', 40));
        }
    }
}