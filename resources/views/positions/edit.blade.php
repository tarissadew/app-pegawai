@extends('master')
@section('title','Edit Posisi')

@section('content')
<div class="space-y-6">
  <div class="flex items-center justify-between">
    <h1 class="text-2xl font-semibold">Edit Posisi</h1>
    <a href="{{ route('positions.index') }}" class="text-sm text-blue-600 hover:underline">← Kembali</a>
  </div>

  @if ($errors->any())
    <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
      <ul class="list-disc space-y-1 pl-5">
        @foreach ($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="rounded-2xl bg-white p-6 shadow ring-1 ring-gray-100">
    <form action="{{ route('positions.update', $position->id) }}" method="POST" class="space-y-4">
      @csrf
      @method('PUT')

      <div>
        <label class="mb-1 block text-sm font-medium">Nama Jabatan</label>
        <input type="text" name="nama_jabatan" value="{{ old('nama_jabatan', $position->nama_jabatan) }}"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-red-600">
      </div>

      <div>
        <label class="mb-1 block text-sm font-medium">Gaji Pokok</label>
        <input type="text" name="gaji_pokok" value="{{ old('gaji_pokok', $position->gaji_pokok) }}"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-red-600">
      </div>

      <div class="mt-2 flex items-center justify-end gap-3">
        <a href="{{ route('positions.index') }}" class="rounded-lg px-4 py-2 text-sm text-gray-600 hover:text-gray-800">Batal</a>
        <button type="submit" class="rounded-lg bg-red-700 px-4 py-2 text-sm font-semibold text-white hover:bg-red-800">
          Update
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
