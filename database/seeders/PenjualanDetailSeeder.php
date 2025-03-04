<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Jalankan database seeder.
     */
    public function run(): void
    {
        $data = [
            // Transaksi 1
            ['penjualan_id' => 1, 'barang_id' => 1, 'harga' => 2450000, 'jumlah' => 1], // Sepatu
            ['penjualan_id' => 1, 'barang_id' => 3, 'harga' => 120000, 'jumlah' => 2], // Pakaian
            ['penjualan_id' => 1, 'barang_id' => 5, 'harga' => 30000, 'jumlah' => 1], // Aksesoris

            // Transaksi 2
            ['penjualan_id' => 2, 'barang_id' => 2, 'harga' => 3300000, 'jumlah' => 1], // Sepatu
            ['penjualan_id' => 2, 'barang_id' => 4, 'harga' => 200000, 'jumlah' => 1], // Skincare
            ['penjualan_id' => 2, 'barang_id' => 6, 'harga' => 4500, 'jumlah' => 3], // Make Up

            // Transaksi 3
            ['penjualan_id' => 3, 'barang_id' => 7, 'harga' => 7500, 'jumlah' => 4], // Susu UHT
            ['penjualan_id' => 3, 'barang_id' => 9, 'harga' => 4500, 'jumlah' => 2], // Pulpen
            ['penjualan_id' => 3, 'barang_id' => 10, 'harga' => 3500, 'jumlah' => 2], // Pensil

            // Transaksi 4
            ['penjualan_id' => 4, 'barang_id' => 1, 'harga' => 2500000, 'jumlah' => 1], // Sepatu
            ['penjualan_id' => 4, 'barang_id' => 8, 'harga' => 8500, 'jumlah' => 2], // Jus Jeruk
            ['penjualan_id' => 4, 'barang_id' => 10, 'harga' => 3500, 'jumlah' => 2], // Pensil

            // Transaksi 5
            ['penjualan_id' => 5, 'barang_id' => 2, 'harga' => 3450000, 'jumlah' => 1], // Sepatu
            ['penjualan_id' => 5, 'barang_id' => 6, 'harga' => 5000, 'jumlah' => 2], // Make Up
            ['penjualan_id' => 5, 'barang_id' => 9, 'harga' => 4500, 'jumlah' => 3], // Pulpen

            // Transaksi 6
            ['penjualan_id' => 6, 'barang_id' => 3, 'harga' => 115000, 'jumlah' => 1], // Pakaian
            ['penjualan_id' => 6, 'barang_id' => 5, 'harga' => 25000, 'jumlah' => 2], // Aksesoris
            ['penjualan_id' => 6, 'barang_id' => 8, 'harga' => 9000, 'jumlah' => 1], // Jus Jeruk

            // Transaksi 7
            ['penjualan_id' => 7, 'barang_id' => 4, 'harga' => 230000, 'jumlah' => 1], // Skincare
            ['penjualan_id' => 7, 'barang_id' => 7, 'harga' => 8000, 'jumlah' => 3], // Susu UHT
            ['penjualan_id' => 7, 'barang_id' => 9, 'harga' => 4500, 'jumlah' => 1], // Pulpen

            // Transaksi 8
            ['penjualan_id' => 8, 'barang_id' => 1, 'harga' => 2400000, 'jumlah' => 1], // Sepatu
            ['penjualan_id' => 8, 'barang_id' => 2, 'harga' => 3550000, 'jumlah' => 1], // Sepatu
            ['penjualan_id' => 8, 'barang_id' => 10, 'harga' => 4000, 'jumlah' => 2], // Pensil

            // Transaksi 9
            ['penjualan_id' => 9, 'barang_id' => 3, 'harga' => 105000, 'jumlah' => 2], // Pakaian
            ['penjualan_id' => 9, 'barang_id' => 5, 'harga' => 27000, 'jumlah' => 1], // Aksesoris
            ['penjualan_id' => 9, 'barang_id' => 8, 'harga' => 9500, 'jumlah' => 2], // Jus Jeruk

            // Transaksi 10
            ['penjualan_id' => 10, 'barang_id' => 4, 'harga' => 220000, 'jumlah' => 1], // Skincare
            ['penjualan_id' => 10, 'barang_id' => 6, 'harga' => 4800, 'jumlah' => 2], // Make Up
            ['penjualan_id' => 10, 'barang_id' => 7, 'harga' => 8500, 'jumlah' => 1], // Susu UHT
        ];

        DB::table('t_penjualan_detail')->insert($data);
    }
}
