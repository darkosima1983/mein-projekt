<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CitiesModel;
use App\Models\ForecastsModel;
use Carbon\Carbon;
class ForecastsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = CitiesModel::all();

        $lastTemperature = null;
        foreach ($cities as $city){
            for ($i=0; $i<5; $i++){

                $weatherType = ForecastsModel::WEATHERS[rand(0,3)];
                $temp_type = null;
                if($lastTemperature !== null)
                {
                    $minTemp = $lastTemperature - 5;
                    $maxTemp = $lastTemperature + 5;
                    $temp_type = rand($minTemp, $maxTemp);
                }elseif($weatherType == "sonnig"){
                    $temp_type = rand(-20,50);
                } elseif($weatherType == "bewölkt"){
                    $temp_type = rand(-20,15);
                } elseif($weatherType == "regnerisch"){
                    $temp_type = rand(-10,50);
                } else {
                    $temp_type = rand(-10,1);
                }
                 $probability = match($weatherType) {
                    "regnerisch", "bewölkt", "schneit" => rand(1, 100),
                    default => null
                };
                ForecastsModel::create([
                    "city_id"=>$city->id,
                    "temperature" => $temp_type,
                    "forecast_date" => Carbon::now()->addDays(rand(1, 30)),
                    "weather_type" => $weatherType,
                    "probability" => $probability
                ]);

                $lastTemperature = $temp_type;
            }
        }
    }
}
