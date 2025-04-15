<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'user_id'   => 1,
                'level_id'  => 1,
                'username'  => 'adminm',
                'nama'      => 'Administrator',
                'password'  => Hash::make('12345'), // class untuk mengenkripsi/hash password
            ],
            [
                'user_id'   => 2,
                'level_id'  => 2,
                'username'  => 'managerm',
                'nama'      => 'Manager',
                'password'  => Hash::make('12345'),
            ],
            [
                'user_id'   => 3,
                'level_id'  => 3,
                'username'  => 'staff1',
                'nama'      => 'Staff/Kasir',
                'password'  => Hash::make('12345'),
            ],
            [
                'user_id'   => 4,
                'level_id'  => 4,
                'username'  => 'admin',
                'nama'      => 'administrator',
                'password'  => Hash::make('12345'),
            ],
        ];

        DB::table('m_user')->insert($data);
    }
}