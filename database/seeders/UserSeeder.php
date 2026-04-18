<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Dzaki',
            'nis' => '2310037',
            'password' => Hash::make('password123'),
        ]);

        // Tambah siswa lain di sini
        User::create([
            'name' => 'Budi',
            'nis' => '2310038',
            'password' => Hash::make('password123'),
        ]);
    }
}