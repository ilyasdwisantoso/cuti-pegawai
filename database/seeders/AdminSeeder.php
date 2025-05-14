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
            'name' => 'Admin', 
            'email' => 'admin@cuti.com', 
            'password' => Hash::make('admin123'), 
            'tanggal_lahir' => '1990-01-01',
            'jenis_kelamin' => 'L',
            'role' => 'admin',
        ]);
    }
}
