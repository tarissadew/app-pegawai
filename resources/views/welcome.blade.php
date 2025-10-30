@extends('master')
@section('title', 'Beranda')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-20">

  <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-10">
    
    {{-- Kiri: teks & tombol --}}
    <div class="space-y-8 order-2 md:order-1">
      <div>
        <p class="text-2xl md:text-3xl font-semibold text-gray-900">Selamat Datang,</p>
        <p class="mt-1 text-3xl md:text-4xl font-bold">
          <span class="text-red-700">Para Pegawai</span> 👋
        </p>
      </div>

      <div class="flex flex-wrap gap-4">
        <a href="{{ route('employees.index') }}"
           class="bg-red-700 text-white px-6 py-3 text-sm font-semibold rounded-md hover:bg-red-800 transition">
          Lihat Karyawan
        </a>
        <a href="{{ route('employees.index') }}"
           class="border border-red-700 text-red-700 px-6 py-3 text-sm font-semibold rounded-md hover:bg-red-50 transition">
          Data Karyawan
        </a>
      </div>
    </div>

    {{-- Kanan: gambar + kapsul pink di belakang --}}
    <div class="order-1 md:order-2 flex justify-center">
      <div class="relative flex items-center justify-center">

        {{-- gambar utama --}}
        <img
          src="{{ asset('img/hero-pegawai.png') }}"
          alt="Ilustrasi Pegawai"
          class="relative z-10 h-72 md:h-80 lg:h-96 object-contain select-none">
      </div>
    </div>

  </div>
</div>
@endsection
