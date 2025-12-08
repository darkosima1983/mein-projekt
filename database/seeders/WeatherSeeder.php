<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Weather;
use App\Models\CitiesModel;
use Faker\Factory as Faker;

class WeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $descriptions = [
            "Sunny",
            "Cloudy",
            "Rainy",
            "Windy",
            "Stormy",
            "Snowy",
            "Foggy",
            "Partly cloudy",
            "Thunderstorms",
            "Clear sky"
        ];
        $cities = CitiesModel::all();
        foreach($cities as $city){

            $userWeather = Weather:: where (['city_id'=>$city->id])->first();
            if($userWeather !== null){
                $this->command->getOutput()->error("Die Stadt nicht exsistiert");
                continue;
            }
              Weather::create([
                'city_id' => $city->id,
                'temperature' => rand(15,30),
                'description' => $descriptions[array_rand($descriptions)]
                ]);

        }

          

    }       
}