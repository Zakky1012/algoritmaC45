@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-xl">
    <h1 class="text-2xl font-bold mb-4">{{ $kegiatan->nama }}</h1>

    @if($kegiatan->foto)
        <img src="{{ asset('storage/' . $kegiatan->foto) }}" class="w-full h-64 object-cover rounded mb-4" alt="Foto Kegiatan">
    @endif

    <p class="text-gray-700 mb-2">
        <strong>Tanggal Kegiatan:</strong> 
        {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('d M Y') }}
    </p>

    <p class="text-gray-700"><strong>Deskripsi:</strong></p>
    <p class="text-gray-600 mt-2">{{ $kegiatan->deskripsi }}</p>

    <a href="{{ route('kegiatan.index') }}" class="mt-4 inline-block bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Kembali</a>
</div>
@endsection
