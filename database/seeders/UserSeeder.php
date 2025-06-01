<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
public function run(): void
    {
        DB::table('users')->insert([
            [
                'user_id' => Str::uuid(),
                'name' => 'Sandyka Dwi Kurniawan',
                'email' => 'Sandyka@sofcograha.co.id',
                'username' => 'Sandyka',
                'password' => bcrypt('123'),
                'role' => 'Quality Assurance',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => Str::uuid(),
                'name' => 'Aminudin Nima',
                'email' => 'Aminudin@sofcograha.co.id',
                'username' => 'Aminudin',
                'password' => bcrypt('123'),
                'role' => 'Project Manager',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => Str::uuid(),
                'name' => 'Pieter Madyo',
                'email' => 'Pieter@sofcograha.co.id',
                'username' => 'Pieter',
                'password' => bcrypt('123'),
                'role' => 'Developer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => Str::uuid(),
                'name' => 'Admin',
                'email' => 'Admin@sofcograha.co.id',
                'username' => 'Admin',
                'password' => bcrypt('123'),
                'role' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
