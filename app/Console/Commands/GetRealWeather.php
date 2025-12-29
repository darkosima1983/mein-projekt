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
    protected $signature = 'weather:get-real';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command gets real weather data from an external API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get(env('WEATHER_API_URL'), [
            'key' => env('WEATHER_API_KEY'),  // obavezno
            'q' => 'Bamberg',                 // ime grada
            'aqi' => 'no',                     // opcionalno, kvalitet vazduha
        ]);

        $data = $response->json();

        $this->info("Weather in {$data['location']['name']}, {$data['location']['country']}:");
        $this->info("Temperature: " . $data['current']['temp_c'] . "°C");
        $this->info("Feels like: " . $data['current']['feelslike_c'] . "°C");
        $this->info("Condition: " . $data['current']['condition']['text']);
        $this->info("Wind: " . $data['current']['wind_kph'] . " kph");
        $this->info("Humidity: " . $data['current']['humidity'] . "%");
        $this->info("Cloud cover: " . $data['current']['cloud'] . "%");


    }
}