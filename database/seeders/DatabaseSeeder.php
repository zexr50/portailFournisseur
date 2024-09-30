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
        
        User::factory()->create([
            'name' => 'Test User2',
            'email' => 'test2@example.com',
        ]);
        
        $this->call(licencesRBQ::class);
<<<<<<< Updated upstream
        $this->call(RegionsAdministrativesSeeder::class);
=======
        $this->call(UserSeeder::class);
>>>>>>> Stashed changes
    }
}
