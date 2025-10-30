@extends('master')
@section('title', 'Posisi Pegawai')

@section('content')
<div class="space-y-6">
  <div class="flex items-center justify-between">
    <h1 class="text-2xl font-semibold">Posisi Pegawai</h1>
    <a href="{{ route('positions.create') }}"
       class="inline-flex items-center rounded-lg bg-red-700 px-3 py-2 text-sm font-medium text-white hover:bg-red-800">
      + Tambah Data
    </a>
  </div>

  <div class="overflow-x-auto rounded-xl shadow">
    <table class="w-full border-collapse overflow-hidden rounded-xl text-sm">
      <thead>
        <tr class="bg-red-700 text-left text-white">
          <th class="px-4 py-3 font-medium">Nama Jabatan</th>
          <th class="px-4 py-3 font-medium">Gaji Pokok</th>
          <th class="px-4 py-3 font-medium">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100 bg-white">
        @forelse($positions as $position)
          <tr>
            <td class="px-4 py-3">{{ $position->nama_jabatan }}</td>
            <td class="px-4 py-3">{{ $position->gaji_pokok }}</td>
            <td class="px-4 py-3">
              <div class="flex items-center gap-3">
                <a class="text-blue-600 hover:underline" href="{{ route('positions.show', $position->id) }}">Detail</a>
                <a class="text-amber-600 hover:underline" href="{{ route('positions.edit', $position->id) }}">Edit</a>
                <form action="{{ route('positions.destroy', $position->id) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus?')" class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-700 hover:underline">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="3" class="px-4 py-10 text-center text-gray-500">Belum ada data posisi</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if(method_exists($positions,'links'))
    <div class="flex justify-end">
      {{ $positions->links() }}
    </div>
  @endif
</div>
@endsection
