<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Ilyas Admin',
            'email' => 'ilyas@admin.com',
            'password' => Hash::make('password123'),
            'tanggal_lahir' => '1990-01-01',
            'jenis_kelamin' => 'L',
            'role' => 'admin',
        ]);
    }
}
