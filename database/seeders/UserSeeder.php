<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id_fournisseurs' => 0,
                'name' => 'John',
                'email' => 'John@Johnmail.john',
                'NEQ' => null,
                'password' => Hash::make('JohnIsAwsome'),
                'role' => 'fournisseur',
                'created_at' => now(),
                'updated_at' => now(),
                'remember_token' => Str::random(10),
            ]
            

        ]);
    }
}

//Need to chose how each role will be written
//admin
//responsable
//commis 
//fournisseur