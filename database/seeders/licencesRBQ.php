<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LicencesRBQ extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('licences_rbq')->insert([
            [
                'categorie' => 'entrepreneur général',
                'sous_categorie' => '1.1.1 - Entrepreneur en batiment résidentiels neufs visés à un plan de quarantie, classe 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categorie' => 'entrepreneur général',
                'sous_categorie' => '1.1.2 - Entrepreneur en batiment résidentiels neufs visés à un plan de quarantie, classe 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categorie' => 'entrepreneur général',
                'sous_categorie' => '1.2 - Entrepreneur en petit batiment',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categorie' => 'entrepreneur général',
                'sous_categorie' => '1.3 - Entrepreneur en batiment de tout genre',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categorie' => 'entrepreneur général',
                'sous_categorie' => '1.4 - Entrepreneur en routes et canalisations',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categorie' => 'entrepreneur général',
                'sous_categorie' => '1.5 - Entrepreneur en structures d\'ouvrages de génie civil',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categorie' => 'entrepreneur général',
                'sous_categorie' => '1.6 - Entrepreneur en ouvrage de génie civil immergés',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categorie' => 'entrepreneur général',
                'sous_categorie' => '1.7 - Entrepreneur en télécommunication, transport, transformation et distribution d\'énergie électrique',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categorie' => 'entrepreneur général',
                'sous_categorie' => '1.8 - Entrepreneur en installation d\'.quipements pétroliers',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categorie' => 'entrepreneur général',
                'sous_categorie' => '1.9 - Entrepreneur en mécanique de batiment',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categorie' => 'entrepreneur général',
                'sous_categorie' => '1.10 - Entrepreneur en remontées mécaniques',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categorie' => 'entrepreneur spécialisé',
                'sous_categorie' => '2.1 - Entrepreneur en puits forés',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categorie' => 'entrepreneur spécialisé',
                'sous_categorie' => '2.2 - Entrepreneur en ouvrage de captage d\'eaux souterraines',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ]);
    }
}
