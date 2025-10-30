@extends('master')
@section('title', 'Daftar Kehadiran')

@section('content')
<div class="space-y-6">
  <div class="flex items-center justify-between">
    <h1 class="text-2xl font-semibold">Daftar Hadir Pegawai</h1>
    <a href="{{ route('attendances.create') }}"
       class="inline-flex items-center rounded-lg bg-red-700 px-3 py-2 text-sm font-medium text-white hover:bg-red-800">
      + Tambah Data
    </a>
  </div>

  <div class="overflow-x-auto rounded-xl shadow">
    <table class="w-full border-collapse overflow-hidden rounded-xl text-sm">
      <thead>
        <tr class="bg-red-700 text-left text-white">
          <th class="px-4 py-3 font-medium">Karyawan</th>
          <th class="px-4 py-3 font-medium">Tanggal</th>
          <th class="px-4 py-3 font-medium">Waktu Masuk</th>
          <th class="px-4 py-3 font-medium">Waktu Keluar</th>
          <th class="px-4 py-3 font-medium">Status Absensi</th>
          <th class="px-4 py-3 font-medium">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100 bg-white">
        @forelse($attendances as $attendance)
          <tr>
            <td class="px-4 py-3">
              {{ optional($attendance->employee)->nama_lengkap ?? '—' }}
            </td>
            <td class="px-4 py-3">{{ $attendance->tanggal }}</td>
            <td class="px-4 py-3">{{ $attendance->waktu_masuk ?? '—' }}</td>
            <td class="px-4 py-3">{{ $attendance->waktu_keluar ?? '—' }}</td>
            <td class="px-4 py-3">
              @php
                $st = strtolower($attendance->status_absensi ?? '');
                $badge = match($st) {
                  'hadir' => 'bg-green-100 text-green-700 ring-green-200',
                  'izin'  => 'bg-blue-100 text-blue-700 ring-blue-200',
                  'sakit' => 'bg-yellow-100 text-yellow-800 ring-yellow-200',
                  'alpha' => 'bg-red-100 text-red-700 ring-red-200',
                  default => 'bg-gray-100 text-gray-700 ring-gray-200',
                };
              @endphp
              <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ring-1 {{ $badge }}">
                {{ ucfirst($attendance->status_absensi ?? '-') }}
              </span>
            </td>
            <td class="px-4 py-3">
              <div class="flex items-center gap-3">
                <a class="text-blue-600 hover:underline" href="{{ route('attendances.show', $attendance->id) }}">Detail</a>
                <a class="text-amber-600 hover:underline" href="{{ route('attendances.edit', $attendance->id) }}">Edit</a>
                <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST"
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
            <td colspan="6" class="px-4 py-10 text-center text-gray-500">Belum ada data kehadiran</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if(method_exists($attendances,'links'))
    <div class="flex justify-end">
      {{ $attendances->links() }}
    </div>
  @endif
</div>
@endsection
