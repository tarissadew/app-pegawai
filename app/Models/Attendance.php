<?php

// App/Models/Attendance.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';

    // pastikan karyawan_id boleh di-mass assign
    protected $fillable = [
        'karyawan_id', 'tanggal', 'waktu_masuk', 'waktu_keluar', 'status_absensi'
    ];
    // atau: protected $guarded = [];

    public function employee()
    {
        // foreign key: karyawan_id -> employees.id
        return $this->belongsTo(Employee::class, 'karyawan_id', 'id');
    }
}

