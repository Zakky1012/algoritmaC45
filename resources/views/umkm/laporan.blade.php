<!-- resources/views/umkm/laporan.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">📊 Laporan Data UMKM</h2>
        {{-- <a href="{{ route('umkm.laporan.pdf') }}" 
           class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg shadow hover:bg-red-700 transition">
            Export PDF
        </a> --}}
    </div>

    <div class="overflow-x-auto bg-white rounded-xl shadow-md border border-gray-200">
        <table class="w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama UMKM</th>
                    <th class="px-6 py-3">Deskripsi</th>
        
                    <th class="px-6 py-3">Alamat</th>
                    <th class="px-6 py-3">Kontak</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($umkms as $index => $umkm)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">{{ $umkm->nama_proyek }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ Str::limit($umkm->deskripsi, 50) }}</td>
                
                        <td class="px-6 py-4">{{ $umkm->alamat_usaha }}</td>
                        <td class="px-6 py-4">{{ $umkm->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
