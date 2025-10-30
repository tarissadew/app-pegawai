<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'id',
        'nama_jabatan',
        'gaji_pokok',
    ];
}
