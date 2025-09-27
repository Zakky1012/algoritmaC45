@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Kegiatan</h1>
        <a href="{{ route('kegiatan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Tambah Kegiatan</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded-lg shadow">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2 border-b">No</th>
                    <th class="px-4 py-2 border-b">Nama</th>
                    <th class="px-4 py-2 border-b">Foto</th>
                    <th class="px-4 py-2 border-b">Tanggal</th>
                    <th class="px-4 py-2 border-b">Deskripsi</th>
                    <th class="px-4 py-2 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kegiatan as $index => $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 border-b">{{ $item->nama }}</td>
                    <td class="px-4 py-2 border-b">
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" class="w-20 h-20 object-cover rounded" alt="Foto Kegiatan">
                        @else
                            <span class="text-gray-400">Tidak ada</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d M Y') }}</td>
                    <td class="px-4 py-2 border-b">{{ Str::limit($item->deskripsi, 50) }}</td>
                    <td class="px-4 py-2 border-b space-x-2">
                        <a href="{{ route('kegiatan.show', $item->id) }}" class="bg-gray-500 hover:bg-gray-600 text-white px-2 py-1 rounded text-sm">Lihat</a>
                        <a href="{{ route('kegiatan.edit', $item->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded text-sm">Edit</a>
                        <form action="{{ route('kegiatan.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?');">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
