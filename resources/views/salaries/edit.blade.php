@extends('master')
@section('title','Edit Gaji Pegawai')

@section('content')
<div class="space-y-6">
  <div class="flex items-center justify-between">
    <h1 class="text-2xl font-semibold">Edit Gaji Pegawai</h1>
    <a href="{{ route('salaries.index') }}" class="text-sm text-blue-600 hover:underline">← Kembali</a>
  </div>

  @if ($errors->any())
    <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
      <ul class="list-disc space-y-1 pl-5">
        @foreach ($errors->all() as $err) <li>{{ $err }}</li> @endforeach
      </ul>
    </div>
  @endif

  <div class="rounded-2xl bg-white p-6 shadow ring-1 ring-gray-100">
    <form action="{{ route('salaries.update', $salary->id) }}" method="POST" class="space-y-4">
      @csrf
      @method('PUT')

      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div class="sm:col-span-2">
          <label class="mb-1 block text-sm font-medium">Karyawan</label>
          <select name="karyawan_id" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-red-600" required>
            <option value="">-- Pilih Karyawan --</option>
            @foreach ($employees as $employee)
              <option value="{{ $employee->id }}" {{ old('karyawan_id',$salary->karyawan_id)==$employee->id?'selected':'' }}>
                {{ $employee->nama_lengkap }}
              </option>
            @endforeach
          </select>
        </div>

        <div>
          <label class="mb-1 block text-sm font-medium">Bulan</label>
          <input type="month" name="bulan" value="{{ old('bulan', $salary->bulan) }}"
                 class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-red-600" required>
        </div>

        <div>
          <label class="mb-1 block text-sm font-medium">Gaji Pokok</label>
          <input type="number" step="0.01" name="gaji_pokok" value="{{ old('gaji_pokok', $salary->gaji_pokok) }}"
                 class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-red-600" required>
        </div>

        <div>
          <label class="mb-1 block text-sm font-medium">Tunjangan</label>
          <input type="number" step="0.01" name="tunjangan" value="{{ old('tunjangan', $salary->tunjangan) }}"
                 class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-red-600" required>
        </div>

        <div>
          <label class="mb-1 block text-sm font-medium">Potongan</label>
          <input type="number" step="0.01" name="potongan" value="{{ old('potongan', $salary->potongan) }}"
                 class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-red-600" required>
        </div>

        <div class="sm:col-span-2">
          <label class="mb-1 block text-sm font-medium">Total Gaji</label>
          <input type="number" step="0.01" id="total_gaji" name="total_gaji"
                 value="{{ old('total_gaji', $salary->total_gaji) }}"
                 class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-red-600"
                 placeholder="Boleh dikosongkan — akan dihitung otomatis">
        </div>
      </div>

      <div class="mt-2 flex items-center justify-end gap-3">
        <a href="{{ route('salaries.index') }}" class="rounded-lg px-4 py-2 text-sm text-gray-600 hover:text-gray-800">Batal</a>
        <button type="submit" class="rounded-lg bg-red-700 px-4 py-2 text-sm font-semibold text-white hover:bg-red-800">Update</button>
      </div>
    </form>
  </div>
</div>

<script>
  (function () {
    const gaji = document.querySelector('input[name="gaji_pokok"]');
    const tunj = document.querySelector('input[name="tunjangan"]');
    const pot  = document.querySelector('input[name="potongan"]');
    const total= document.getElementById('total_gaji');
    function n(v){ return parseFloat(v || 0) || 0; }
    function hitung(){
      const r = n(gaji.value)+n(tunj.value)-n(pot.value);
      if (document.activeElement !== total || total.value === '') total.value = r.toFixed(2);
    }
    ['input','change'].forEach(e => { gaji.addEventListener(e,hitung); tunj.addEventListener(e,hitung); pot.addEventListener(e,hitung); });
    hitung();
  })();
</script>
@endsection
