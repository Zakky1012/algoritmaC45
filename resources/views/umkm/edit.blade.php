@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-4xl">
    <h2 class="text-2xl font-bold mb-6">Edit UMKM</h2>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 rounded">
            <ul class="list-disc pl-5 text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ✅ Tambah enctype untuk upload file --}}
    <form action="{{ route('umkm.update', $umkm->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">NIB</label>
                <input type="text" name="nib" value="{{ old('nib', $umkm->nib) }}" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-semibold mb-1">Nama Perusahaan</label>
                <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan', $umkm->nama_perusahaan) }}" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-semibold mb-1">Skala Usaha</label>
                <select name="skala_usaha" class="w-full border border-gray-300 rounded px-3 py-2">
                    <option value="Rendah" {{ $umkm->skala_usaha == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                    <option value="Menengah Rendah" {{ $umkm->skala_usaha == 'Menengah Rendah' ? 'selected' : '' }}>Menengah Rendah</option>
                    <option value="Menengah Tinggi" {{ $umkm->skala_usaha == 'Menengah Tinggi' ? 'selected' : '' }}>Menengah Tinggi</option>
                    <option value="Tinggi" {{ $umkm->skala_usaha == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                </select>
            </div>
            <div>
                <label class="block font-semibold mb-1">Nama Proyek</label>
                <input type="text" name="nama_proyek" value="{{ old('nama_proyek', $umkm->nama_proyek) }}" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div class="md:col-span-2">
                <label class="block font-semibold mb-1">Alamat Usaha</label>
                <textarea name="alamat_usaha" class="w-full border border-gray-300 rounded px-3 py-2">{{ old('alamat_usaha', $umkm->alamat_usaha) }}</textarea>
            </div>
            <div>
                <label class="block font-semibold mb-1">Kecamatan Usaha</label>
                <input type="text" name="kecamatan_usaha" value="{{ old('kecamatan_usaha', $umkm->kecamatan_usaha) }}" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-semibold mb-1">Kelurahan Usaha</label>
                <input type="text" name="kelurahan_usaha" value="{{ old('kelurahan_usaha', $umkm->kelurahan_usaha) }}" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-semibold mb-1">Jenis Usaha</label>
                <input type="text" name="jenis_usaha" value="{{ old('jenis_usaha', $umkm->jenis_usaha) }}" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-semibold mb-1">Nomor Identitas User</label>
                <input type="text" name="nomor_identitas_user" value="{{ old('nomor_identitas_user', $umkm->nomor_identitas_user) }}" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-semibold mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $umkm->email) }}" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-semibold mb-1">Nomor Telp</label>
                <input type="text" name="nomor_telp" value="{{ old('nomor_telp', $umkm->nomor_telp) }}" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-semibold mb-1">Modal Usaha</label>
                <input type="number" name="modal_usaha" value="{{ old('modal_usaha', $umkm->modal_usaha) }}" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-semibold mb-1">Tenaga Kerja</label>
                <input type="number" name="tenaga_kerja" value="{{ old('tenaga_kerja', $umkm->tenaga_kerja) }}" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
             {{-- ✅ Tambah Harga --}}
             <div>
                <label class="block font-semibold mb-1">Harga Produk (Rp)</label>
                <input type="number" name="harga" value="{{ old('harga', $umkm->harga) }}" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            {{-- ✅ Tambah Deskripsi --}}
            <div class="md:col-span-2">
                <label class="block font-semibold mb-1">Deskripsi</label>
                <textarea name="deskripsi" class="w-full border border-gray-300 rounded px-3 py-2">{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
            </div>

            {{-- ✅ Tambah Upload Foto --}}
            <div class="md:col-span-2">
                <label class="block font-semibold mb-1">Foto Usaha</label>
                @if($umkm->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $umkm->image) }}" alt="Foto UMKM" class="h-32 rounded">
                    </div>
                @endif
                <input type="file" name="image" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
        </div>

        <div class="mt-6 flex gap-3">
            <a href="{{ route('umkm.show', $umkm->id) }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
        </div>
    </form>
</div>
@endsection
