@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-4xl">
    <h2 class="text-2xl font-bold mb-6">{{ isset($umkm) ? 'Edit UMKM' : 'Tambah UMKM' }}</h2>

    <form action="{{ isset($umkm) ? route('umkm.update', $umkm->id) : route('umkm.store') }}" method="POST">
        @csrf
        @if(isset($umkm)) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-medium">NIB</label>
                <input type="text" name="nib" value="{{ $umkm->nib ?? old('nib') }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block mb-1 font-medium">Nama Perusahaan</label>
                <input type="text" name="nama_perusahaan" value="{{ $umkm->nama_perusahaan ?? old('nama_perusahaan') }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block mb-1 font-medium">Skala Usaha</label>
                <select name="skala_usaha" class="w-full border rounded px-3 py-2">
                    <option value="">-- Pilih Skala --</option>
                    <option value="Rendah" @selected(($umkm->skala_usaha ?? '')=='Rendah')>Rendah</option>
                    <option value="Menengah Rendah" @selected(($umkm->skala_usaha ?? '')=='Menengah Rendah')>Menengah Rendah</option>
                    <option value="Menengah Tinggi" @selected(($umkm->skala_usaha ?? '')=='Menengah Tinggi')>Menengah Tinggi</option>
                    <option value="Tinggi" @selected(($umkm->skala_usaha ?? '')=='Tinggi')>Tinggi</option>
                </select>
            </div>
            <div>
                <label class="block mb-1 font-medium">Nama Proyek</label>
                <input type="text" name="nama_proyek" value="{{ $umkm->nama_proyek ?? old('nama_proyek') }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block mb-1 font-medium">Alamat Usaha</label>
                <input type="text" name="alamat_usaha" value="{{ $umkm->alamat_usaha ?? old('alamat_usaha') }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block mb-1 font-medium">Kecamatan Usaha</label>
                <input type="text" name="kecamatan_usaha" value="{{ $umkm->kecamatan_usaha ?? old('kecamatan_usaha') }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block mb-1 font-medium">Kelurahan Usaha</label>
                <input type="text" name="kelurahan_usaha" value="{{ $umkm->kelurahan_usaha ?? old('kelurahan_usaha') }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block mb-1 font-medium">Jenis Usaha</label>
                <input type="text" name="jenis_usaha" value="{{ $umkm->jenis_usaha ?? old('jenis_usaha') }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block mb-1 font-medium">Nomor Identitas User</label>
                <input type="text" name="nomor_identitas_user" value="{{ $umkm->nomor_identitas_user ?? old('nomor_identitas_user') }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block mb-1 font-medium">Email</label>
                <input type="email" name="email" value="{{ $umkm->email ?? old('email') }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block mb-1 font-medium">Nomor Telp</label>
                <input type="text" name="nomor_telp" value="{{ $umkm->nomor_telp ?? old('nomor_telp') }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block mb-1 font-medium">Modal Usaha</label>
                <input type="number" name="modal_usaha" value="{{ $umkm->modal_usaha ?? old('modal_usaha') }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block mb-1 font-medium">Tenaga Kerja</label>
                <input type="number" name="tenaga_kerja" value="{{ $umkm->tenaga_kerja ?? old('tenaga_kerja') }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                {{ isset($umkm) ? 'Update' : 'Simpan' }}
            </button>
            <a href="{{ route('umkm.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection
