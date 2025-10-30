@extends('master')
@section('title', 'Daftar Departemen')

@section('content')
<div class="space-y-6">
  <div class="flex items-center justify-between">
    <h1 class="text-2xl font-semibold">Daftar Departemen</h1>
    <a href="{{ route('departments.create') }}"
       class="inline-flex items-center rounded-lg bg-red-700 px-3 py-2 text-sm font-medium text-white hover:bg-red-800">
      + Tambah Data
    </a>
  </div>

  <div class="overflow-x-auto rounded-xl shadow">
    <table class="w-full border-collapse overflow-hidden rounded-xl text-sm">
      <thead>
        <tr class="bg-red-700 text-left text-white">
          <th class="px-4 py-3 font-medium">Nama Departemen</th>
          <th class="px-4 py-3 font-medium">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100 bg-white">
        @forelse($departments as $department)
          <tr>
            <td class="px-4 py-3">{{ $department->nama_departemen }}</td>
            <td class="px-4 py-3">
              <div class="flex items-center gap-3">
                <a class="text-blue-600 hover:underline" href="{{ route('departments.show', $department->id) }}">Detail</a>
                <a class="text-amber-600 hover:underline" href="{{ route('departments.edit', $department->id) }}">Edit</a>
                <form action="{{ route('departments.destroy', $department->id) }}" method="POST"
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
            <td colspan="2" class="px-4 py-10 text-center text-gray-500">
              Belum ada data departemen
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if(method_exists($departments,'links'))
    <div class="flex justify-end">
      {{ $departments->links() }}
    </div>
  @endif
</div>
@endsection
