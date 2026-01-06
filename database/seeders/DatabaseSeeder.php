<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorieSeeder::class,
            UserSeeder::class,
            ReclamationSeeder::class,
        ]);

        $this->command->info(' Base de données incrementée avec succès !');
        $this->command->info('Comptes de test :');
        $this->command->info(' Admin: HasnaMed@reclamations.com / pass123');
        $this->command->info(' User: AmirKarim@gmail.com / pass1234');
    }
}