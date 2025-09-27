@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-4xl">
    <h2 class="text-2xl font-bold mb-6">Detail UMKM</h2>

    <div class="bg-white shadow rounded-lg p-6">

        {{-- ✅ Foto UMKM --}}
        <div class="flex justify-center mb-6">
            @if($umkm->image)
                <img src="{{ asset('storage/' . $umkm->image) }}" alt="Foto UMKM" class="h-48 w-48 object-cover rounded-lg shadow">
            @else
                <div class="h-48 w-48 flex items-center justify-center bg-gray-100 rounded-lg text-gray-400">
                    Tidak ada foto
                </div>
            @endif
        </div>

        {{-- ✅ Deskripsi UMKM --}}
        @if($umkm->deskripsi)
            <div class="mb-6">
                <p class="font-semibold">Deskripsi:</p>
                <p class="text-gray-700">{{ $umkm->deskripsi }}</p>
            </div>
        @endif

        {{-- Detail lainnya --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="font-semibold">NIB:</p>
                <p class="text-gray-700">{{ $umkm->nib }}</p>
            </div>
            <div>
                <p class="font-semibold">Nama Perusahaan:</p>
                <p class="text-gray-700">{{ $umkm->nama_perusahaan }}</p>
            </div>
            <div>
                <p class="font-semibold">Skala Usaha:</p>
                <p class="text-gray-700">{{ $umkm->skala_usaha }}</p>
            </div>
            <div>
                <p class="font-semibold">Nama Proyek:</p>
                <p class="text-gray-700">{{ $umkm->nama_proyek }}</p>
            </div>
            <div>
                <p class="font-semibold">Alamat Usaha:</p>
                <p class="text-gray-700">{{ $umkm->alamat_usaha }}</p>
            </div>
            <div>
                <p class="font-semibold">Kecamatan Usaha:</p>
                <p class="text-gray-700">{{ $umkm->kecamatan_usaha }}</p>
            </div>
            <div>
                <p class="font-semibold">Kelurahan Usaha:</p>
                <p class="text-gray-700">{{ $umkm->kelurahan_usaha }}</p>
            </div>
            <div>
                <p class="font-semibold">Jenis Usaha:</p>
                <p class="text-gray-700">{{ $umkm->jenis_usaha }}</p>
            </div>
            <div>
                <p class="font-semibold">Nomor Identitas User:</p>
                <p class="text-gray-700">{{ $umkm->nomor_identitas_user }}</p>
            </div>
            <div>
                <p class="font-semibold">Email:</p>
                <p class="text-gray-700">{{ $umkm->email }}</p>
            </div>
            <div>
                <p class="font-semibold">Nomor Telp:</p>
                <p class="text-gray-700">{{ $umkm->nomor_telp }}</p>
            </div>
            <div>
                <p class="font-semibold">Modal Usaha:</p>
                <p class="text-gray-700">{{ number_format($umkm->modal_usaha,0,',','.') }}</p>
            </div>
            <div>
                <p class="font-semibold">Tenaga Kerja:</p>
                <p class="text-gray-700">{{ $umkm->tenaga_kerja }}</p>
            </div>
            <div>
                <p class="font-semibold">Label:</p>
                <p class="text-gray-700">{{ $umkm->label ?? '-' }}</p>
            </div>
        </div>

        <div class="mt-6 flex gap-3">
            <a href="{{ route('umkm.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
            <a href="{{ route('umkm.edit', $umkm->id) }}" class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-500">Edit</a>
        </div>
    </div>
</div>
@endsection
