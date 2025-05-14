<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pegawai extends Authenticatable
{
    use HasFactory;

    protected $table = 'pegawais';

    protected $fillable = [
        'name',
        'email',
        'password',
        'tanggal_lahir',
        'jenis_kelamin',
    ];

    protected $hidden = ['password'];
}
