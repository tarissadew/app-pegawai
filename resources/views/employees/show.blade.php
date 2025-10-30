@extends('master')
@section('title','Detail Pegawai')

@section('content')
  <div class="space-y-6">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-semibold">Detail Pegawai</h1>
      <div class="flex items-center gap-3">
        <a href="{{ route('employees.edit', $employee->id) }}" class="text-amber-600 hover:underline">Edit</a>
        <a href="{{ route('employees.index') }}" class="text-blue-600 hover:underline">Kembali</a>
      </div>
    </div>

    <div class="overflow-hidden rounded-2xl bg-white shadow ring-1 ring-gray-100">
      <table class="w-full border-collapse text-sm">
        <thead>
          <tr class="bg-red-700 text-left text-white">
            <th class="px-4 py-3 font-medium">Field</th>
            <th class="px-4 py-3 font-medium">Nilai</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          <tr>
            <td class="px-4 py-3">Nama Lengkap</td>
            <td class="px-4 py-3">{{ $employee->nama_lengkap }}</td>
          </tr>
          <tr>
            <td class="px-4 py-3">Email</td>
            <td class="px-4 py-3">{{ $employee->email }}</td>
          </tr>
          <tr>
            <td class="px-4 py-3">No. Telepon</td>
            <td class="px-4 py-3">{{ $employee->nomor_telepon }}</td>
          </tr>
          <tr>
            <td class="px-4 py-3">Tanggal Lahir</td>
            <td class="px-4 py-3">{{ $employee->tanggal_lahir }}</td>
          </tr>
          <tr>
            <td class="px-4 py-3">Alamat</td>
            <td class="px-4 py-3">{{ $employee->alamat }}</td>
          </tr>
          <tr>
            <td class="px-4 py-3">Tanggal Masuk</td>
            <td class="px-4 py-3">{{ $employee->tanggal_masuk }}</td>
          </tr>
          <tr>
            <td class="px-4 py-3">Status</td>
            <td class="px-4 py-3">
              @php
                $status = strtolower($employee->status ?? '');
                $cls = match($status) {
                  'aktif' => 'bg-green-100 text-green-700 ring-green-200',
                  'nonaktif','non-aktif' => 'bg-gray-100 text-gray-700 ring-gray-200',
                  default => 'bg-blue-100 text-blue-700 ring-blue-200',
                };
              @endphp
              <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ring-1 {{ $cls }}">
                {{ ucfirst($employee->status ?? '-') }}
              </span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
          onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="flex justify-end">
      @csrf
      @method('DELETE')
      <button type="submit" class="rounded-lg bg-red-700 px-4 py-2 text-sm font-semibold text-white hover:bg-red-800">
        Hapus
      </button>
    </form>
  </div>
@endsection
