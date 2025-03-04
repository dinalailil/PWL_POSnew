<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kategori_id' => 1, 'barang_kode' => 'SPT001', 'barang_nama' => 'Sepatu Sneakers', 'harga_beli' => 300000, 'harga_jual' => 400000],
            ['kategori_id' => 1, 'barang_kode' => 'SPT002', 'barang_nama' => 'Sepatu Formal', 'harga_beli' => 500000, 'harga_jual' => 650000],
            ['kategori_id' => 2, 'barang_kode' => 'PK003', 'barang_nama' => 'Kaos Polos', 'harga_beli' => 80000, 'harga_jual' => 120000],
            ['kategori_id' => 2, 'barang_kode' => 'PK004', 'barang_nama' => 'Celana Chino', 'harga_beli' => 150000, 'harga_jual' => 200000],
            ['kategori_id' => 3, 'barang_kode' => 'ACC005', 'barang_nama' => 'Jam Tangan', 'harga_beli' => 250000, 'harga_jual' => 350000],
            ['kategori_id' => 3, 'barang_kode' => 'ACC006', 'barang_nama' => 'Topi Baseball', 'harga_beli' => 50000, 'harga_jual' => 75000],
            ['kategori_id' => 4, 'barang_kode' => 'SKN007', 'barang_nama' => 'Facial Wash', 'harga_beli' => 60000, 'harga_jual' => 80000],
            ['kategori_id' => 4, 'barang_kode' => 'SKN008', 'barang_nama' => 'Moisturizer', 'harga_beli' => 90000, 'harga_jual' => 120000],
            ['kategori_id' => 5, 'barang_kode' => 'MU009', 'barang_nama' => 'Lipstik Matte', 'harga_beli' => 70000, 'harga_jual' => 100000],
            ['kategori_id' => 5, 'barang_kode' => 'MU010', 'barang_nama' => 'Foundation', 'harga_beli' => 120000, 'harga_jual' => 160000],
        ];
        DB::table('m_barang')->insert($data);        
    }
}
