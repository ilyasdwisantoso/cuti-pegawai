<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@cuti.com',
                'password' => Hash::make('admin123'),
                'tanggal_lahir' => '1990-01-01',
                'jenis_kelamin' => 'L',
                'role' => 'admin',
            ],
            [
                'name' => 'Bubu',
                'email' => 'bubu@cuti.com',
                'password' => Hash::make('bubu123'),
                'tanggal_lahir' => '1990-01-01',
                'jenis_kelamin' => 'L',
                'role' => 'pegawai',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }
    }
}
