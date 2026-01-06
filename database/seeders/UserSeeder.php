<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Exécuter les seeds d'utilisateurs.
     */
    public function run(): void
    {
        // Administrateurs
        User::create([
            'name' => 'Hasna Med',
            'email' => 'HasnaMed@reclamations.com',
            'password' => Hash::make('pass123'),
            'role' => 'admin',
            'email_verified_at' => now()
        ]);

        User::create([
            'name' => 'Amir Hassan',
            'email' => 'AmirHassan@reclamations.com',
            'password' => Hash::make('pass123'),
            'role' => 'admin',
            'email_verified_at' => now()
        ]);

        // Utilisateurs normaux
        User::create([
            'name' => 'Amir Karim',
            'email' => 'AmirKarim@gmail.com',
            'password' => Hash::make('pass1234'),
            'role' => 'user',
            'email_verified_at' => now()
        ]);

        User::create([
            'name' => 'Roda Amir',
            'email' => 'RodaAmir@gmail.com',
            'password' => Hash::make('pass1234'),
            'role' => 'user',
            'email_verified_at' => now()
        ]);

        $this->command->info('4 utilisateurs créés avec succès !');
    }
}