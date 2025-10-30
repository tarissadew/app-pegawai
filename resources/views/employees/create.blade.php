@extends('master')
@section('title','Tambah Pegawai')

@section('content')
{{-- Popup-style: center the card on the page --}}
<div class="flex min-h-[70vh] items-center justify-center">
  <div class="w-full max-w-xl rounded-2xl bg-white p-6 shadow-xl ring-1 ring-gray-100">
    <h1 class="mb-4 text-xl font-semibold text-gray-900">Tambah Pegawai</h1>

    @if ($errors->any())
      <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
        <ul class="list-disc space-y-1 pl-5">
          @foreach ($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('employees.store') }}" method="POST" class="space-y-4">
      @csrf

      <div>
        <label class="mb-1 block text-sm font-medium">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 outline-none focus:ring-2 focus:ring-red-600">
      </div>

      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div>
          <label class="mb-1 block text-sm font-medium">Email</label>
          <input type="email" name="email" value="{{ old('email') }}"
                 class="w-full rounded-lg border border-gray-300 px-3 py-2 outline-none focus:ring-2 focus:ring-red-600">
        </div>
        <div>
          <label class="mb-1 block text-sm font-medium">No. Telepon</label>
          <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon') }}"
                 class="w-full rounded-lg border border-gray-300 px-3 py-2 outline-none focus:ring-2 focus:ring-red-600">
        </div>
      </div>

      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div>
          <label class="mb-1 block text-sm font-medium">Tanggal Lahir</label>
          <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                 class="w-full rounded-lg border border-gray-300 px-3 py-2 outline-none focus:ring-2 focus:ring-red-600">
        </div>
        <div>
          <label class="mb-1 block text-sm font-medium">Tanggal Masuk</label>
          <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}"
                 class="w-full rounded-lg border border-gray-300 px-3 py-2 outline-none focus:ring-2 focus:ring-red-600">
        </div>
      </div>

      <div>
        <label class="mb-1 block text-sm font-medium">Alamat</label>
        <textarea name="alamat" rows="3"
                  class="w-full rounded-lg border border-gray-300 px-3 py-2 outline-none focus:ring-2 focus:ring-red-600">{{ old('alamat') }}</textarea>
      </div>

      <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
        <div>
          <label class="mb-1 block text-sm font-medium">Status</label>
          <select name="status"
                  class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-red-600">
            <option value="aktif" {{ old('status')=='aktif'?'selected':'' }}>Aktif</option>
            <option value="nonaktif" {{ old('status')=='nonaktif'?'selected':'' }}>Nonaktif</option>
          </select>
        </div>
        <div>
          <label class="mb-1 block text-sm font-medium">Departemen</label>
          <select name="department_id"
                  class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-red-600">
            @foreach($departments as $department)
              <option value="{{ $department->id }}" {{ old('department_id')==$department->id?'selected':'' }}>
                {{ $department->nama_departemen }}
              </option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="mb-1 block text-sm font-medium">Posisi</label>
          <select name="position_id"
                  class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-red-600">
            @foreach($positions as $position)
              <option value="{{ $position->id }}" {{ old('position_id')==$position->id?'selected':'' }}>
                {{ $position->nama_jabatan }}
              </option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="mt-2 flex items-center justify-end gap-3">
        <a href="{{ route('employees.index') }}"
           class="rounded-lg px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-800">Batal</a>
        <button type="submit"
                class="rounded-lg bg-red-700 px-4 py-2 text-sm font-semibold text-white hover:bg-red-800">
          Simpan
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
