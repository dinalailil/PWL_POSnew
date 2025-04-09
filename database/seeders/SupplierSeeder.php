<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            ['supplier_kode' => 'SPT01', 'supplier_nama' => 'Supplier Sepatu'],
            ['supplier_kode' => 'PKN01', 'supplier_nama' => 'Supplier Pakaian'],
            ['supplier_kode' => 'ACC01', 'supplier_nama' => 'Supplier Aksesoris'],
            ['supplier_kode' => 'SKN01', 'supplier_nama' => 'Supplier Skincare'],
            ['supplier_kode' => 'MU01',  'supplier_nama' => 'Supplier Make Up'],
        ];

        DB::table('m_supplier')->insert($suppliers);
    }
}
