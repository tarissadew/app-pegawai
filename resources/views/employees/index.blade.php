@extends('master')
@section('title', 'Daftar Pegawai')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold">Daftar Pegawai</h1>
        <a href="{{ route('employees.create') }}"
           class="inline-flex items-center rounded-lg bg-red-700 px-3 py-2 text-sm font-medium text-white hover:bg-red-800">
            + Tambah Employee
        </a>
    </div>

    @if (session('success'))
        <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto rounded-xl shadow">
        <table class="w-full border-collapse overflow-hidden rounded-xl text-sm">
            <thead>
                <tr class="bg-red-700 text-left text-white">
                    <th class="px-4 py-3 font-medium">Nama Lengkap</th>
                    <th class="px-4 py-3 font-medium">Email</th>
                    <th class="px-4 py-3 font-medium">No. Telp</th>
                    <th class="px-4 py-3 font-medium">Tanggal lahir</th>
                    <th class="px-4 py-3 font-medium">Alamat</th>
                    <th class="px-4 py-3 font-medium">Tgl. Masuk</th>
                    <th class="px-4 py-3 font-medium">Status</th>
                    <th class="px-4 py-3 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse($employees as $employee)
                    <tr>
                        <td class="px-4 py-3">{{ $employee->nama_lengkap }}</td>
                        <td class="px-4 py-3">{{ $employee->email }}</td>
                        <td class="px-4 py-3">{{ $employee->nomor_telepon }}</td>
                        <td class="px-4 py-3">{{ $employee->tanggal_lahir }}</td>
                        <td class="px-4 py-3">{{ $employee->alamat }}</td>
                        <td class="px-4 py-3">{{ $employee->tanggal_masuk }}</td>
                        <td class="px-4 py-3">
                            @php
                                $status = strtolower($employee->status ?? '');
                                $cls = match($status) {
                                    'aktif' => 'bg-green-100 text-green-700 ring-green-200',
                                    'nonaktif', 'non-aktif' => 'bg-gray-100 text-gray-700 ring-gray-200',
                                    'cuti' => 'bg-yellow-100 text-yellow-800 ring-yellow-200',
                                    default => 'bg-blue-100 text-blue-700 ring-blue-200',
                                };
                            @endphp
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ring-1 {{ $cls }}">
                                {{ ucfirst($employee->status ?? '-') }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <a class="text-blue-600 hover:underline" href="{{ route('employees.show', $employee->id) }}">Detail</a>
                                <a class="text-amber-600 hover:underline" href="{{ route('employees.edit', $employee->id) }}">Edit</a>
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-700 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-10 text-center text-gray-500">Belum ada data employee</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Pagination -->
    <div class="flex justify-center mt-4">
        {{ $employees->links() }}
    </div>
</div>
@endsection
