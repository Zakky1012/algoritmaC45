@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-800">Daftar Perusahaan</h2>
        <div class="flex space-x-2">
            <a href="{{ route('perusahaans.create') }}" 
               class="px-3 py-1.5 text-sm bg-indigo-600 text-white rounded shadow hover:bg-indigo-700 transition">
               + Tambah
            </a>
        
            <a href="{{ route('perusahaans.preprocess') }}" 
               class="px-3 py-1.5 text-sm bg-green-600 text-white rounded shadow hover:bg-green-700 transition">
               ⚡ Preproses
            </a>
        
            <form action="{{ route('perusahaans.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center space-x-1">
                @csrf
                <input type="file" name="file" accept=".xlsx,.xls" 
                       class="block w-32 text-xs text-gray-700 border border-gray-300 rounded cursor-pointer focus:outline-none">
                <button type="submit" 
                        class="px-3 py-1.5 text-sm bg-yellow-500 text-white rounded shadow hover:bg-yellow-600 transition">
                    📥 Import
                </button>
            </form>
        
            <form action="{{ route('perusahaans.destroyAll') }}" method="POST" onsubmit="return confirm('Yakin hapus semua data?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-3 py-1.5 text-sm bg-red-600 text-white rounded shadow hover:bg-red-700 transition">
                    🗑 Hapus Semua
                </button>
            </form>
            
            
        </div>
        
    </div>

    {{-- ✅ Jumlah data --}}
    <div class="mb-3 text-sm text-gray-600">
        Total data terinput: <span class="font-semibold">{{ $perusahaans->total() }}</span>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700 uppercase text-sm">
                    <th class="p-3">No</th>
                    <th class="p-3">NIB</th>
                    <th class="p-3">Nama Perusahaan</th>
                    <th class="p-3">Skala Usaha</th>
                    <th class="p-3">Jenis Usaha</th>
                    <th class="p-3">Modal Usaha</th>
                    <th class="p-3">Tenaga Kerja</th>
                    <th class="p-3">Label</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($perusahaans as $index => $p)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">
                        {{ ($perusahaans->currentPage() - 1) * $perusahaans->perPage() + $index + 1 }}
                    </td>
                    <td class="p-3">{{ $p->nib }}</td>
                    <td class="p-3">{{ $p->nama_perusahaan }}</td>
                    <td class="p-3">{{ $p->skala_usaha }}</td>
                    <td class="p-3">{{ $p->jenis_usaha }}</td>
                    <td class="p-3">{{ $p->modal_usaha }}</td>
                    <td class="p-3">{{ $p->tenaga_kerja }}</td>
                    <td class="p-3">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                            {{ $p->label == 'layak' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $p->label }}
                        </span>
                    </td>
                    <td class="p-3 text-center">
                        {{-- ✅ Dropdown Aksi --}}
                        <div class="relative inline-block text-left">
                            <button type="button" 
                                class="px-3 py-1.5 text-sm bg-gray-200 rounded hover:bg-gray-300"
                                onclick="this.nextElementSibling.classList.toggle('hidden')">
                                ⋮
                            </button>
                            <div class="absolute right-0 mt-2 w-32 bg-white border rounded shadow-lg hidden z-10">
                                <a href="{{ route('perusahaans.show', $p->id) }}" 
                                   class="block px-4 py-2 text-sm text-blue-600 hover:bg-gray-100">Detail</a>
                                <a href="{{ route('perusahaans.edit', $p->id) }}" 
                                   class="block px-4 py-2 text-sm text-yellow-600 hover:bg-gray-100">Edit</a>
                                <form action="{{ route('perusahaans.destroy', $p->id) }}" method="POST" 
                                      onsubmit="return confirm('Hapus data?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="p-3 text-center text-gray-500">Belum ada data perusahaan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ✅ Pagination --}}
    <div class="mt-4">
        {{ $perusahaans->links() }}
    </div>
</div>
@endsection
