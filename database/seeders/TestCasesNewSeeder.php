<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TestCasesNewSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('test_cases_new')->insert([
            [
                'test_key' => Str::uuid(),
                'app_key' => 1,
                'modul_key' => 1,
                'menu_key' => 1,
                'test_scenario' => 'Login dengan user valid',
                'test_data' => 'username: admin, password: rahasia',
                'test_step' => 'Buka halaman login, isi form, klik login',
                'expected_result' => 'Masuk ke dashboard',
                'result' => 'Berhasil',
                'test_date' => '2024-06-01',
                'pic_dev' => 1,
                'status_from_qc' => 'OK',
                'evidence' => 'login_success.png',
                'note' => 'Tidak ada masalah',
                'status_from_dev' => 'Closed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'test_key' => Str::uuid(),
                'app_key' => 1,
                'modul_key' => 2,
                'menu_key' => 2,
                'test_scenario' => 'Tambah data produk',
                'test_data' => 'nama: Produk A, harga: 10000',
                'test_step' => 'Klik tambah, isi form, simpan',
                'expected_result' => 'Produk tersimpan',
                'result' => 'Gagal',
                'test_date' => '2024-06-02',
                'pic_dev' => 2,
                'status_from_qc' => 'Revisi',
                'evidence' => 'add_product_fail.png',
                'note' => 'Harga tidak boleh kosong',
                'status_from_dev' => 'Open',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'test_key' => Str::uuid(),
                'app_key' => 2,
                'modul_key' => 3,
                'menu_key' => 3,
                'test_scenario' => 'Export laporan',
                'test_data' => 'periode: Mei 2024',
                'test_step' => 'Pilih periode, klik export',
                'expected_result' => 'File excel terdownload',
                'result' => 'Berhasil',
                'test_date' => '2024-06-03',
                'pic_dev' => 1,
                'status_from_qc' => 'OK',
                'evidence' => 'export_report.png',
                'note' => 'Sesuai requirement',
                'status_from_dev' => 'Closed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
