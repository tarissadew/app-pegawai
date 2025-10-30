@extends('master')
@section('title', 'Edit Kehadiran')

@section('content')
  <div class="space-y-6">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-semibold">Edit Kehadiran</h1>
      <a href="{{ route('attendances.index') }}" class="text-sm text-blue-600 hover:underline">← Kembali</a>
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
      <form action="{{ route('attendances.update', $attendance->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
          <label class="mb-1 block text-sm font-medium">Karyawan</label>
          <select name="karyawan_id"
            class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-red-600">
            @foreach($employees as $employee)
              <option value="{{ $employee->id }}" {{ old('karyawan_id', $attendance->karyawan_id) == $employee->id ? 'selected' : '' }}>
                {{ $employee->nama_lengkap }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
          <div>
            <label class="mb-1 block text-sm font-medium">Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal', $attendance->tanggal) }}"
              class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-red-600">
          </div>
          <div>
            <label class="mb-1 block text-sm font-medium">Status Absensi</label>
            <select name="status_absensi"
              class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-red-600">
              @foreach (['hadir', 'izin', 'sakit', 'alpha'] as $st)
                <option value="{{ $st }}" {{ old('status_absensi', $attendance->status_absensi) == $st ? 'selected' : '' }}>
                  {{ ucfirst($st) }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
          <div>
            <label class="mb-1 block text-sm font-medium">Waktu Masuk</label>
            <input type="time" name="waktu_masuk" value="{{ old('waktu_masuk', $attendance->waktu_masuk) }}"
              class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-red-600">
          </div>
          <div>
            <label class="mb-1 block text-sm font-medium">Waktu Keluar</label>
            <input type="time" name="waktu_keluar" value="{{ old('waktu_keluar', $attendance->waktu_keluar) }}"
              class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-red-600">
          </div>
        </div>

        <div class="mt-2 flex items-center justify-end gap-3">
          <a href="{{ route('attendances.index') }}"
            class="rounded-lg px-4 py-2 text-sm text-gray-600 hover:text-gray-800">Batal</a>
          <button type="submit" class="rounded-lg bg-red-700 px-4 py-2 text-sm font-semibold text-white hover:bg-red-800">
            Update
          </button>
        </div>
      </form>
    </div>
  </div>
@endsection