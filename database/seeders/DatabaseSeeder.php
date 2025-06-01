<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(ApplicationSeeder::class);
        $this->call(ModulSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(DeveloperSeeder::class);
        $this->call(UserSeeder::class);
        // $this->call(TestCasesNewSeeder::class);
        // $this->call(MenuSeeder::class);
    }
}
