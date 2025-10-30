@extends('master')
@section('title','Edit Pegawai')

@section('content')
  <div class="space-y-6">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-semibold">Edit Pegawai</h1>
      <a href="{{ route('employees.index') }}" class="text-sm text-blue-600 hover:underline">← Kembali</a>
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
      <form action="{{ route('employees.update', $employee->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
          <label class="mb-1 block text-sm font-medium">Nama Lengkap</label>
          <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $employee->nama_lengkap) }}"
                 class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-red-600">
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
          <div>
            <label class="mb-1 block text-sm font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email', $employee->email) }}"
                   class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-red-600">
          </div>
          <div>
            <label class="mb-1 block text-sm font-medium">No. Telepon</label>
            <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon', $employee->nomor_telepon) }}"
                   class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-red-600">
          </div>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
          <div>
            <label class="mb-1 block text-sm font-medium">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $employee->tanggal_lahir) }}"
                   class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-red-600">
          </div>
          <div>
            <label class="mb-1 block text-sm font-medium">Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk', $employee->tanggal_masuk) }}"
                   class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-red-600">
          </div>
        </div>

        <div>
          <label class="mb-1 block text-sm font-medium">Alamat</label>
          <input type="text" name="alamat" value="{{ old('alamat', $employee->alamat) }}"
                 class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-red-600">
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
          <div>
            <label class="mb-1 block text-sm font-medium">Status</label>
            <select name="status" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-red-600">
              <option value="aktif" {{ old('status', $employee->status)=='aktif'?'selected':'' }}>Aktif</option>
              <option value="nonaktif" {{ old('status', $employee->status)=='nonaktif'?'selected':'' }}>Nonaktif</option>
            </select>
          </div>

          <div>
            <label class="mb-1 block text-sm font-medium">Departemen</label>
            <select name="department_id" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-red-600">
              @foreach($departments as $department)
                <option value="{{ $department->id }}"
                  {{ old('department_id', $employee->department_id)==$department->id?'selected':'' }}>
                  {{ $department->nama_departemen }}
                </option>
              @endforeach
            </select>
          </div>

          <div>
            <label class="mb-1 block text-sm font-medium">Posisi</label>
            <select name="position_id" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-red-600">
              @foreach($positions as $position)
                <option value="{{ $position->id }}"
                  {{ old('position_id', $employee->position_id)==$position->id?'selected':'' }}>
                  {{ $position->nama_jabatan }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="mt-2 flex items-center justify-end gap-3">
          <a href="{{ route('employees.index') }}" class="rounded-lg px-4 py-2 text-sm text-gray-600 hover:text-gray-800">Batal</a>
          <button type="submit" class="rounded-lg bg-red-700 px-4 py-2 text-sm font-semibold text-white hover:bg-red-800">Update</button>
        </div>
      </form>
    </div>
  </div>
@endsection
