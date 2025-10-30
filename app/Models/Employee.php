<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'email',
        'nomor_telepon',
        'tanggal_lahir',
        'alamat',
        'tanggal_masuk',
        'status',
        'department_id',
        'position_id',
    ];
    // App/Models/Employee.php
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'karyawan_id', 'id');
    }
}

