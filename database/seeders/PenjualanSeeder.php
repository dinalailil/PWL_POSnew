<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PenjualanSeeder extends Seeder
{
    /**
     * Jalankan database seeder.
     */
    public function run(): void
    {
        $data = [
            ['user_id' => 2, 'pembeli' => 'Veren', 'penjualan_kode' => 'PJ001', 'penjualan_tanggal' => Carbon::now()],
            ['user_id' => 3, 'pembeli' => 'Alya', 'penjualan_kode' => 'PJ002', 'penjualan_tanggal' => Carbon::now()->subDay()],
            ['user_id' => 4, 'pembeli' => 'Caca', 'penjualan_kode' => 'PJ003', 'penjualan_tanggal' => Carbon::now()->subDays(2)],
            ['user_id' => 2, 'pembeli' => 'Farel', 'penjualan_kode' => 'PJ004', 'penjualan_tanggal' => Carbon::now()->subDays(3)],
            ['user_id' => 5, 'pembeli' => 'Aida', 'penjualan_kode' => 'PJ005', 'penjualan_tanggal' => Carbon::now()->subDays(4)],
            ['user_id' => 3, 'pembeli' => 'Lutful', 'penjualan_kode' => 'PJ006', 'penjualan_tanggal' => Carbon::now()->subDays(5)],
            ['user_id' => 4, 'pembeli' => 'Iqbal', 'penjualan_kode' => 'PJ007', 'penjualan_tanggal' => Carbon::now()->subDays(6)],
            ['user_id' => 5, 'pembeli' => 'Zaida', 'penjualan_kode' => 'PJ008', 'penjualan_tanggal' => Carbon::now()->subDays(7)],
            ['user_id' => 2, 'pembeli' => 'Aqweena', 'penjualan_kode' => 'PJ009', 'penjualan_tanggal' => Carbon::now()->subDays(8)],
            ['user_id' => 3, 'pembeli' => 'Siska', 'penjualan_kode' => 'PJ010', 'penjualan_tanggal' => Carbon::now()->subDays(9)],
        ];

        DB::table('t_penjualan')->insert($data);
    }
}
