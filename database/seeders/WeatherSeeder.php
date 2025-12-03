<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Weather;
use Faker\Factory as Faker;

class WeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

   

       $city = $this->command->getOutput()->ask("Name der Stadt");
       if($city === null)
       {
        $this->command->getOutput()->error("Fehler: Kein Stadtname eingegeben.");
        return;
       }
       if (Weather::where('city', $city)->exists()) {
            
            $this->command->getOutput()->error("Die Stadt $city existiert bereits!");
            return;
        }
       $temperature = $this->command->getOutput()->ask("Wie viel Grad?");
       if($temperature === null)
       {
        $this->command->getOutput()->error("Fehler: Keine Temperatur eingegeben.");
       }
       $description = $this->command->getOutput()->ask("Beschreibung");
       if($description === null)
       {
        $this->command->getOutput()->error("Fehler: Keine Beschreibung eingegeben.");
       }
            Weather::create([
            'city' => $city,
            'temperature' => $temperature,
            'description' => $description,
            ]);
        $this->command->getOutput()->info(
    "Erfolgreich eingetragen: Stadt *{$city}*, Temperatur *{$temperature}°C*, Beschreibung *{$description}*."
);
    

    }       
}