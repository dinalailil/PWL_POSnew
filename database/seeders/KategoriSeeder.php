<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kategori_kode' => 'SPT', 'kategori_nama' => 'Sepatu'],
            ['kategori_kode' => 'PK', 'kategori_nama' => 'Pakaian'],
            ['kategori_kode' => 'ACC', 'kategori_nama' => 'Aksesoris'],
            ['kategori_kode' => 'SKN', 'kategori_nama' => 'Skincare'],
            ['kategori_kode' => 'MU', 'kategori_nama' => 'Make Up'],
        ];
        DB::table('m_kategori')->insert($data);
    }
}