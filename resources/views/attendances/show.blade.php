@extends('master')
@section('title','Detail Kehadiran')

@section('content')
<div class="space-y-6">
  <div class="flex items-center justify-between">
    <h1 class="text-2xl font-semibold">Detail Kehadiran</h1>
    <div class="flex items-center gap-3">
      <a href="{{ route('attendances.edit', $attendance->id) }}" class="text-amber-600 hover:underline">Edit</a>
      <a href="{{ route('attendances.index') }}" class="text-blue-600 hover:underline">Kembali</a>
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
          <td class="px-4 py-3">Karyawan</td>
          <td class="px-4 py-3">{{ optional($attendance->employee)->nama_lengkap ?? '—' }}</td>
        </tr>
        <tr>
          <td class="px-4 py-3">Tanggal</td>
          <td class="px-4 py-3">{{ $attendance->tanggal }}</td>
        </tr>
        <tr>
          <td class="px-4 py-3">Waktu Masuk</td>
          <td class="px-4 py-3">{{ $attendance->waktu_masuk ?? '—' }}</td>
        </tr>
        <tr>
          <td class="px-4 py-3">Waktu Keluar</td>
          <td class="px-4 py-3">{{ $attendance->waktu_keluar ?? '—' }}</td>
        </tr>
        <tr>
          <td class="px-4 py-3">Status</td>
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
        </tr>
      </tbody>
    </table>
  </div>

  <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST"
        onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="flex justify-end">
    @csrf
    @method('DELETE')
    <button type="submit" class="rounded-lg bg-red-700 px-4 py-2 text-sm font-semibold text-white hover:bg-red-800">
      Hapus
    </button>
  </form>
</div>
@endsection
