<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class SingleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name = $this->command->getOutput()->ask("Wie heißen Sie?");
       if($name === null)
       {
        $this->command->getOutput()->error("Fehler: Keine Name eingegeben.");
       }
        $email = $this->command->getOutput()->ask("Ihre Email adresse eingegeben.");
       if($email === null)
       {
        $this->command->getOutput()->error("Fehler: Email adresse eingegeben.");
        return;
       }
       if (User::where('email', $email)->exists()) {
            
            $this->command->getOutput()->error("Die Email $email existiert bereits!");
            return;
        }
        $password = $this->command->getOutput()->ask("Ihre Password eingegeben.");

            User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password), 
        ]);
        $this->command->getOutput()->info(
    "Erfolgreich eingetragen: User $name, mit Email $email.");
    }
}
