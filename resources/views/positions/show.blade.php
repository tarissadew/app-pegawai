@extends('master')
@section('title','Detail Posisi')

@section('content')
<div class="space-y-6">
  <div class="flex items-center justify-between">
    <h1 class="text-2xl font-semibold">Detail Posisi</h1>
    <div class="flex items-center gap-3">
      <a href="{{ route('positions.edit', $position->id) }}" class="text-amber-600 hover:underline">Edit</a>
      <a href="{{ route('positions.index') }}" class="text-blue-600 hover:underline">Kembali</a>
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
          <td class="px-4 py-3">Nama Jabatan</td>
          <td class="px-4 py-3">{{ $position->nama_jabatan }}</td>
        </tr>
        <tr>
          <td class="px-4 py-3">Gaji Pokok</td>
          <td class="px-4 py-3">{{ $position->gaji_pokok }}</td>
        </tr>
      </tbody>
    </table>
  </div>

  <form action="{{ route('positions.destroy', $position->id) }}" method="POST"
        onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="flex justify-end">
    @csrf
    @method('DELETE')
    <button type="submit" class="rounded-lg bg-red-700 px-4 py-2 text-sm font-semibold text-white hover:bg-red-800">
      Hapus
    </button>
  </form>
</div>
@endsection
