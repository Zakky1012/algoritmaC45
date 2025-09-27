@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Daftar UMKM</h2>
        <div class="flex space-x-2 items-center mb-6">

            <!-- Tombol Tambah -->
            <a href="{{ route('umkm.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Tambah UMKM
            </a>
        
            <!-- Form Import -->
            <form action="{{ route('umkm.import') }}" method="POST" enctype="multipart/form-data" class="relative">
                @csrf
                <label class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 cursor-pointer transition">
                    Import UMKM
                    <input type="file" name="file" class="hidden" onchange="this.form.submit()">
                </label>
            </form>
        
            <!-- Tombol Hapus Semua -->
            <button id="hapusSemuaBtn" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                Hapus Semua
            </button>
        
            <!-- Tombol Lihat Label -->
            <a href="{{ route('umkm.labels') }}" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition">
                Lihat Label
            </a>
        </div>
        
    </div>
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Berhasil!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

{{-- Notifikasi Error --}}
@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Gagal!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif

<div class="overflow-x-auto bg-white shadow rounded-lg">
    <table class="min-w-full table-auto border border-gray-200">
        <thead class="bg-gray-100">
            <tr class="text-center">
                <th class="px-4 py-2 border">NIB</th>
                <th class="px-4 py-2 border">Nama Perusahaan</th>
                {{-- ✅ Kolom Foto --}}
                <th class="px-4 py-2 border">Foto</th>
                <th class="px-4 py-2 border">Skala Usaha</th>
                <th class="px-4 py-2 border">Modal Usaha</th>
                <th class="px-4 py-2 border">Tenaga Kerja</th>
                <th class="px-4 py-2 border">Label</th>
                <th class="px-4 py-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @forelse ($umkms as $umkm)
            <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-2 border">{{ $umkm->nib }}</td>
                <td class="px-4 py-2 border">{{ $umkm->nama_perusahaan }}</td>
                
                {{-- ✅ Tampilkan Foto --}}
                <td class="px-4 py-2 border">
                    @if($umkm->image)
                        <img src="{{ asset('storage/' . $umkm->image) }}" alt="Foto UMKM" class="h-16 w-16 object-cover rounded mx-auto">
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                </td>

                <td class="px-4 py-2 border">{{ $umkm->skala_usaha }}</td>
                <td class="px-4 py-2 border">{{ number_format($umkm->modal_usaha, 0, ',', '.') }}</td>
                <td class="px-4 py-2 border">{{ $umkm->tenaga_kerja }}</td>
                <td class="px-4 py-2 border">{{ $umkm->label }}</td>
                <td class="px-4 py-2 border flex justify-center gap-2">
                    <a href="{{ route('umkm.show', $umkm->id) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Lihat</a>
                    <a href="{{ route('umkm.edit', $umkm->id) }}" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">Edit</a>
                    <form action="{{ route('umkm.destroy', $umkm->id) }}" method="POST" class="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="px-4 py-4 text-center text-gray-500">Data UMKM kosong.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>


    <div class="mt-4">
        {{ $umkms->links() }}
    </div>
</div>

<script>
    // SweetAlert Hapus Semua
    document.getElementById('hapusSemuaBtn').addEventListener('click', function() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Semua data UMKM akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus semua!'
        }).then((result) => {
            if (result.isConfirmed) {
                // submit form deleteAll
                fetch("{{ route('umkm.deleteAll') }}", {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                }).then(() => {
                    Swal.fire(
                        'Terhapus!',
                        'Semua data UMKM telah dihapus.',
                        'success'
                    ).then(() => {
                        location.reload();
                    });
                });
            }
        })
    });

    // SweetAlert Hapus per Baris
    document.querySelectorAll('.deleteForm').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });


    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            timer: 2000,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session("error") }}',
            timer: 2500,
            showConfirmButton: false
        });
    @endif
</script>
@endsection
