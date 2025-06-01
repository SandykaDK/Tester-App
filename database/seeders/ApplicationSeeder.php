<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('applications')->insert([
            [
                'app_key' => Str::uuid(),
                'app_name' => 'HRIS 1',
                'app_description' => 'Human Resource Information System 1',
                'app_status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'app_key' => Str::uuid(),
                'app_name' => 'HRIS 2',
                'app_description' => 'Human Resource Information System 2',
                'app_status' => 'On Progress',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'app_key' => Str::uuid(),
                'app_name' => 'HRIS 3',
                'app_description' => 'Human Resource Information System 3',
                'app_status' => 'On Progress',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'app_key' => Str::uuid(),
                'app_name' => 'E-Recruitment',
                'app_description' => 'E-Recruitment System for Konimex',
                'app_status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'app_key' => Str::uuid(),
                'app_name' => 'ESS',
                'app_description' => 'Employee Self Service System',
                'app_status' => 'On Progress',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'app_key' => Str::uuid(),
                'app_name' => 'KPI',
                'app_description' => 'Key Performance Indicator System',
                'app_status' => 'On Progress',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
