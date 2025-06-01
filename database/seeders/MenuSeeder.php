<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('app_menus')->insert([
            [
                'menu_key' => Str::uuid(),
                'menu_name' => 'Master User dan Otorisasi Modul',
                'menu_description' => 'Master User dan Otorisasi Modul HRIS 2',
                'menu_status' => 'Active',
                'application_id' => 2,
                'modul_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_key' => Str::uuid(),
                'menu_name' => 'Daftar Alamat IP yang Diperbolehkan Akses',
                'menu_description' => 'Daftar Alamat IP yang Diperbolehkan Akses HRIS 2',
                'menu_status' => 'Active',
                'application_id' => 2,
                'modul_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
