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
                'name' => 'John',
                'email' => 'John@Johnmail.john',
                'NEQ' => null,
                'password' => Hash::make('JohnIsAwsome'),
                'created_at' => now(),
                'updated_at' => now(),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Bob',
                'email' => null,
                'NEQ' => '1234567891',
                'password' => Hash::make('BobIsBald'),
                'created_at' => now(),
                'updated_at' => now(),
                'remember_token' => Str::random(10),
            ],

        ]);
    }
}