<?php

namespace App\Http\Controllers;

use App\Models\Salaries;
use App\Models\Employee;
use Illuminate\Http\Request;

class SalariesController extends Controller
{
    public function index()
    {
        // tampilkan bersama data karyawan
        $salaries = Salaries::with('employee')
            ->latest()
            ->paginate(10);

        return view('salaries.index', compact('salaries'));
    }

    public function create()
    {
        // untuk select karyawan di form
        $employees = Employee::orderBy('nama_lengkap')->get(['id','nama_lengkap']);
        return view('salaries.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'karyawan_id' => ['required', 'integer', 'exists:employees,id'],
            // bulan & tahun pembayaran, contoh: 2025-10
            'bulan'       => ['required', 'date_format:Y-m', 'max:10'],
            'gaji_pokok'  => ['required', 'numeric', 'min:0'],
            'tunjangan'   => ['required', 'numeric', 'min:0'],
            'potongan'    => ['required', 'numeric', 'min:0'],
            // opsional; jika tidak diisi akan dihitung otomatis
            'total_gaji'  => ['nullable', 'numeric', 'min:0'],
        ]);

        // hitung total_gaji bila tidak dikirim dari form
        $validated['total_gaji'] = $validated['total_gaji']
            ?? ($validated['gaji_pokok'] + $validated['tunjangan'] - $validated['potongan']);

        Salaries::create($validated);

        return redirect()->route('salaries.index')
            ->with('success', 'Data gaji berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $salary = Salaries::with('employee')->findOrFail($id);
        return view('salaries.show', compact('salary'));
    }

    public function edit(string $id)
    {
        $salary    = Salaries::findOrFail($id);
        $employees = Employee::orderBy('nama_lengkap')->get(['id','nama_lengkap']);
        return view('salaries.edit', compact('salary', 'employees'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'karyawan_id' => ['required', 'integer', 'exists:employees,id'],
            'bulan'       => ['required', 'date_format:Y-m', 'max:10'],
            'gaji_pokok'  => ['required', 'numeric', 'min:0'],
            'tunjangan'   => ['required', 'numeric', 'min:0'],
            'potongan'    => ['required', 'numeric', 'min:0'],
            'total_gaji'  => ['nullable', 'numeric', 'min:0'],
        ]);

        $validated['total_gaji'] = $validated['total_gaji']
            ?? ($validated['gaji_pokok'] + $validated['tunjangan'] - $validated['potongan']);

        $salary = Salaries::findOrFail($id);
        $salary->update($validated);

        return redirect()->route('salaries.index')
            ->with('success', 'Data gaji berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $salary = Salaries::findOrFail($id);
        $salary->delete();

        return redirect()->route('salaries.index')
            ->with('success', 'Data gaji berhasil dihapus.');
    }
}
