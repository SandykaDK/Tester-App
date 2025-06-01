<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeveloperSeeder extends Seeder
{
    public function run(): void
    {
        $developers = [
            [
                'dev_key' => (string) Str::uuid(),
                'dev_name' => 'Michael Liyanto',
                'dev_email' => 'michael_liyanto@sofcograha.co.id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dev_key' => (string) Str::uuid(),
                'dev_name' => 'Pieter Madyo',
                'dev_email' => 'pieter_madyo@sofcograha.co.id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dev_key' => (string) Str::uuid(),
                'dev_name' => 'Felix Reinaldo',
                'dev_email' => 'felix_reinaldo@sofcograha.co.id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dev_key' => (string) Str::uuid(),
                'dev_name' => 'Yasin Rizqi',
                'dev_email' => 'yasin_rizqi@sofcograha.co.id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dev_key' => (string) Str::uuid(),
                'dev_name' => 'Leonita Wati',
                'dev_email' => 'leonita_wati@sofcograha.co.id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dev_key' => (string) Str::uuid(),
                'dev_name' => 'Yenni Wati',
                'dev_email' => 'yenni_wati@sofcograha.co.id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('developers')->insert($developers);

        $developerApplications = [
            // Michael Liyanto
            ['developer_id' => 1, 'application_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['developer_id' => 1, 'application_id' => 6, 'created_at' => now(), 'updated_at' => now()],

            // Pieter Madyo
            ['developer_id' => 2, 'application_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['developer_id' => 2, 'application_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['developer_id' => 2, 'application_id' => 5, 'created_at' => now(), 'updated_at' => now()],

            // Felix Reinaldo
            ['developer_id' => 3, 'application_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['developer_id' => 3, 'application_id' => 3, 'created_at' => now(), 'updated_at' => now()],

            // Yasin Rizqi
            ['developer_id' => 4, 'application_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['developer_id' => 4, 'application_id' => 3, 'created_at' => now(), 'updated_at' => now()],

            // Leonita Wati
            ['developer_id' => 5, 'application_id' => 3, 'created_at' => now(), 'updated_at' => now()],

            // Yenni Wati
            ['developer_id' => 6, 'application_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('developer_application')->insert($developerApplications);
    }
}
