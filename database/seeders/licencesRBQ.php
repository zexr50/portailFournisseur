<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('licences_rbq')->insert([
            [
                'categorie' => 'entrepreneur général',
                'sous_categorie' => '1.1.1 - Entrepreneur en batiment résidentiels neufs visés à un plan de quarantie, classe 1',
                'created_at' => '2024-22-9',
            ],
            [
                'categorie' => 'entrepreneur général',
                'sous_categorie' => '1.1.2 - Entrepreneur en batiment résidentiels neufs visés à un plan de quarantie, classe 2',
                'created_at' => '2024-22-9',
            ],
            [
                'categorie' => 'entrepreneur général',
                'sous_categorie' => '1.2 - Entrepreneur en petit batiment',
                'created_at' => '2024-22-9',
            ],
            [
                'categorie' => 'entrepreneur général',
                'sous_categorie' => '1.3 - Entrepreneur en batiment de tout genre',
                'created_at' => '2024-22-9',
            ],
            [
                'categorie' => 'entrepreneur général',
                'sous_categorie' => '1.4 - Entrepreneur en routes et canalisations',
                'created_at' => '2024-22-9',
            ],
            [
                'categorie' => 'entrepreneur général',
                'sous_categorie' => '1.5 - Entrepreneur en structures d\'ouvrages de génie civil',
                'created_at' => '2024-22-9',
            ],
            [
                'categorie' => 'entrepreneur général',
                'sous_categorie' => '1.6 - Entrepreneur en ouvrage de génie civil immergés',
                'created_at' => '2024-22-9',
            ],
            [
                'categorie' => 'entrepreneur général',
                'sous_categorie' => '1.7 - Entrepreneur en télécommunication, transport, transformation et distribution d\'énergie électrique',
                'created_at' => '2024-22-9',
            ],
            [
                'categorie' => 'entrepreneur général',
                'sous_categorie' => '1.8 - Entrepreneur en installation d\'.quipements pétroliers',
                'created_at' => '2024-22-9',
            ],
            [
                'categorie' => 'entrepreneur général',
                'sous_categorie' => '1.9 - Entrepreneur en mécanique de batiment',
                'created_at' => '2024-22-9',
            ],
            [
                'categorie' => 'entrepreneur général',
                'sous_categorie' => '1.10 - Entrepreneur en remontées mécaniques',
                'created_at' => '2024-22-9',
            ],
            [
                'categorie' => 'entrepreneur spécialisé',
                'sous_categorie' => '2.1 - Entrepreneur en puits forés',
                'created_at' => '2024-22-9',
            ],
            [
                'categorie' => 'entrepreneur spécialisé',
                'sous_categorie' => '2.2 - Entrepreneur en ouvrage de captage d\'eaux souterraines',
                'created_at' => '2024-22-9',
            ],
            
        ]);
    }
}
