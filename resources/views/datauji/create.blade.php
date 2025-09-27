@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Tambah Data Uji</h2>

    <form action="{{ route('datauji.store') }}" method="POST" class="space-y-4">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" name="nib" placeholder="NIB" value="{{ old('nib') }}" class="border px-3 py-2 rounded w-full">
            <input type="text" name="nama_perusahaan" placeholder="Nama Perusahaan" value="{{ old('nama_perusahaan') }}" class="border px-3 py-2 rounded w-full">
            <input type="text" name="skala_usaha" placeholder="Skala Usaha" value="{{ old('skala_usaha') }}" class="border px-3 py-2 rounded w-full">
            <input type="text" name="nama_proyek" placeholder="Nama Proyek" value="{{ old('nama_proyek') }}" class="border px-3 py-2 rounded w-full">
            <input type="text" name="alamat_usaha" placeholder="Alamat Usaha" value="{{ old('alamat_usaha') }}" class="border px-3 py-2 rounded w-full">
            <input type="text" name="kecamatan_usaha" placeholder="Kecamatan" value="{{ old('kecamatan_usaha') }}" class="border px-3 py-2 rounded w-full">
            <input type="text" name="kelurahan_usaha" placeholder="Kelurahan" value="{{ old('kelurahan_usaha') }}" class="border px-3 py-2 rounded w-full">
            <input type="text" name="jenis_usaha" placeholder="Jenis Usaha" value="{{ old('jenis_usaha') }}" class="border px-3 py-2 rounded w-full">
            <input type="text" name="nomor_identitas_user" placeholder="No Identitas User" value="{{ old('nomor_identitas_user') }}" class="border px-3 py-2 rounded w-full">
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" class="border px-3 py-2 rounded w-full">
            <input type="text" name="nomor_telp" placeholder="Nomor Telp" value="{{ old('nomor_telp') }}" class="border px-3 py-2 rounded w-full">
            <input type="number" name="modal_usaha" placeholder="Modal Usaha" value="{{ old('modal_usaha') }}" class="border px-3 py-2 rounded w-full">
            <input type="number" name="tenaga_kerja" placeholder="Tenaga Kerja" value="{{ old('tenaga_kerja') }}" class="border px-3 py-2 rounded w-full">
            <select name="label" class="border px-3 py-2 rounded w-full">
                <option value="">-- Pilih Label --</option>
                <option value="layak" {{ old('label')=='layak'?'selected':'' }}>Layak</option>
                <option value="Tidak layak" {{ old('label')=='Tidak layak'?'selected':'' }}>Tidak layak</option>
                <option value="pertimbangkan" {{ old('label')=='pertimbangkan'?'selected':'' }}>Pertimbangkan</option>
            </select>
        </div>

        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Simpan</button>
        <a href="{{ route('datauji.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Batal</a>
    </form>
</div>
@endsection
