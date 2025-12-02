<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amount= $this->command->getOutput()->ask("Koliko korisnika zelite?", 500);
        $password = $this->command->getOutput()->ask("Koju lozinku da koristim?", '123456');
        $faker = Faker::create('de_DE');

        $this->command->getOutput()->progressStart($amount);

        for ($i=0; $i<$amount; $i++)
        {
            User::create([
            'name' => $faker->name,
            'email' => $faker->unique()->email,
            'password' => Hash::make($password), 
        ]);

        $this->command->getOutput()->progressAdvance(1);
        }
        
        $this->command->getOutput()->progressFinish();
    }
}
