@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Data Uji</h2>

    <!-- Tombol CRUD & Import -->
    <div class="flex flex-wrap gap-3 mb-6">

        <!-- Tambah Data -->
        <a href="{{ route('datauji.create') }}" 
           class="px-5 py-2 bg-gradient-to-r from-indigo-500 to-blue-500 text-white font-semibold rounded-lg shadow-md hover:from-indigo-600 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all">
            + Tambah Data
        </a>
    
        <!-- Hapus Semua -->
        <form action="{{ route('datauji.destroyAll') }}" method="POST" onsubmit="return confirm('Hapus semua data?');">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="px-5 py-2 bg-gradient-to-r from-red-500 to-rose-500 text-white font-semibold rounded-lg shadow-md hover:from-red-600 hover:to-rose-600 focus:outline-none focus:ring-2 focus:ring-red-400 transition-all">
                Hapus Semua
            </button>
        </form>
    
        <!-- Import Excel -->
        <form action="{{ route('datauji.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-2">
            @csrf
            <input type="file" name="file" accept=".xlsx,.xls,.csv" 
                   class="border px-3 py-1 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-300">
            <button type="submit" 
                    class="px-5 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white font-semibold rounded-lg shadow-md hover:from-green-600 hover:to-emerald-600 focus:outline-none focus:ring-2 focus:ring-green-400 transition-all">
                Import Excel
            </button>
        </form>
    
        <!-- Tombol Uji Rule -->
        <a href="{{ route('datauji.testRule') }}"
           class="px-5 py-2 bg-gradient-to-r from-yellow-400 to-orange-500 text-white font-semibold rounded-lg shadow-md hover:from-yellow-500 hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition-all">
            Uji Rule
        </a>
    
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session("success") }}',
                confirmButtonColor: '#10b981'
            });
        @endif
    
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session("error") }}',
                confirmButtonColor: '#ef4444'
            });
        @endif
    </script>
    
    <!-- Tabel data -->
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full table-auto border border-gray-200">
            <thead class="bg-gray-100">
                <tr class="text-center">
                    <th class="px-4 py-2 border">NIB</th>
                    <th class="px-4 py-2 border">Nama Perusahaan</th>
                    <th class="px-4 py-2 border">Skala Usaha</th>
                    <th class="px-4 py-2 border">Modal</th>
                    <th class="px-4 py-2 border">Tenaga Kerja</th>
                    <th class="px-4 py-2 border">Label</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse ($datauji as $d)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $d->nib }}</td>
                    <td class="px-4 py-2 border">{{ $d->nama_perusahaan }}</td>
                    <td class="px-4 py-2 border">{{ $d->skala_usaha }}</td>
                    <td class="px-4 py-2 border">{{ $d->modal_usaha }}</td>
                    <td class="px-4 py-2 border">{{ $d->tenaga_kerja }}</td>
                    <td class="px-4 py-2 border">{{ $d->label }}</td>
                    <td class="px-4 py-2 border relative">
                        <!-- Dropdown aksi -->
                        <div class="inline-block relative">
                            <button 
                                class="flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-blue-500 text-white font-semibold rounded-lg shadow-md hover:from-indigo-600 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all"
                                onclick="toggleDropdown('dropdown-{{ $d->id }}')">
                                Aksi 
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                        
                            <div id="dropdown-{{ $d->id }}" class="hidden absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-10 overflow-hidden">
                                <a href="{{ route('datauji.edit', $d->id) }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition-colors">Edit</a>
                                <form action="{{ route('datauji.destroy', $d->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors">Hapus</button>
                                </form>
                            </div>
                        </div>
                        
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center px-4 py-2">Belum ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $datauji->links() }}
    </div>
</div>

<!-- Script toggle dropdown -->
<script>
    function toggleDropdown(id) {
        const el = document.getElementById(id);
        el.classList.toggle('hidden');
    }

    // Klik di luar dropdown untuk menutup
    window.addEventListener('click', function(e) {
        document.querySelectorAll('[id^="dropdown-"]').forEach(drop => {
            if (!drop.contains(e.target) && !drop.previousElementSibling.contains(e.target)) {
                drop.classList.add('hidden');
            }
        });
    });
</script>
@endsection
