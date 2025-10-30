@extends('master')
@section('title', 'Daftar Gaji Pegawai')

@section('content')
<div class="space-y-6">
  <div class="flex items-center justify-between">
    <h1 class="text-2xl font-semibold">Daftar Gaji Pegawai</h1>
    <a href="{{ route('salaries.create') }}"
       class="inline-flex items-center rounded-lg bg-red-700 px-3 py-2 text-sm font-medium text-white hover:bg-red-800">
      + Tambah Data
    </a>
  </div>

  <div class="overflow-x-auto rounded-xl shadow">
    <table class="w-full border-collapse overflow-hidden rounded-xl text-sm">
      <thead>
        <tr class="bg-red-700 text-left text-white">
          <th class="px-4 py-3 font-medium">ID</th>
          <th class="px-4 py-3 font-medium">Nama Karyawan</th>
          <th class="px-4 py-3 font-medium">Bulan</th>
          <th class="px-4 py-3 font-medium">Gaji Pokok</th>
          <th class="px-4 py-3 font-medium">Tunjangan</th>
          <th class="px-4 py-3 font-medium">Potongan</th>
          <th class="px-4 py-3 font-medium">Total Gaji</th>
          <th class="px-4 py-3 font-medium">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100 bg-white">
        @forelse($salaries as $salary)
          <tr>
            <td class="px-4 py-3">{{ $salary->id }}</td>
            <td class="px-4 py-3">{{ optional($salary->employee)->nama_lengkap ?? '—' }}</td>
            <td class="px-4 py-3">{{ $salary->bulan }}</td>
            <td class="px-4 py-3">Rp {{ number_format($salary->gaji_pokok, 2, ',', '.') }}</td>
            <td class="px-4 py-3">Rp {{ number_format($salary->tunjangan, 2, ',', '.') }}</td>
            <td class="px-4 py-3">Rp {{ number_format($salary->potongan, 2, ',', '.') }}</td>
            <td class="px-4 py-3 font-semibold">Rp {{ number_format($salary->total_gaji, 2, ',', '.') }}</td>
            <td class="px-4 py-3">
              <div class="flex items-center gap-3">
                <a class="text-blue-600 hover:underline" href="{{ route('salaries.show', $salary->id) }}">Detail</a>
                <a class="text-amber-600 hover:underline" href="{{ route('salaries.edit', $salary->id) }}">Edit</a>
                <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-700 hover:underline">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="8" class="px-4 py-10 text-center text-gray-500">Belum ada data gaji</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if(method_exists($salaries,'links'))
    <div class="flex justify-end">
      {{ $salaries->links() }}
    </div>
  @endif
</div>
@endsection
