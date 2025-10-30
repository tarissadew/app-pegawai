<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::latest()->paginate(5);
        return view('attendances.index', compact('attendances'));
    }
    public function create()
    {
        $employees = \App\Models\Employee::all();
        return view('attendances.create', compact('employees'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',
            'waktu_masuk' => 'nullable|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
        ]);
        Attendance::create($request->all());
        return redirect()->route('attendances.index');
    }
    public function show(string $id)
    {
        $attendance = Attendance::find($id);
        return view('attendances.show', compact('attendance'));
    }
    public function edit(string $id)
    {
        $attendance = Attendance::findOrFail($id);
        $employees = \App\Models\Employee::all(); // Make sure to fetch all employees
        return view('attendances.edit', compact('attendance', 'employees'));
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',
            'waktu_masuk' => 'nullable|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
        ]);
        $attendance = Attendance::findOrFail($id);
        $attendance->update($request->only([
            'karyawan_id',
            'tanggal',
            'waktu_masuk',
            'waktu_keluar',
            'status_absensi',
        ]));
        return redirect()->route('attendances.index');
    }
    public function destroy(string $id)
    {
        $attendance = Attendance::find($id);
        $attendance->delete();
        return redirect()->route('attendances.index');
    }
}
