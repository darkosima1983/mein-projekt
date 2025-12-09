<?php

namespace Database\Seeders;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CitiesModel;
class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $faker = Factory::create();

        for ($i=0; $i<100; $i++){
            CitiesModel::create([
                "name"=>$faker->city
            ]);
        }
    }
}
