<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';

    protected $fillable = [
        'kode_anggota',
        'nama',
        'kelas',
        'jenis_kelamin',
        'no_hp',
        'alamat',
    ];
}
