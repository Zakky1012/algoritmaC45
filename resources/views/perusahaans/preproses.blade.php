@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Data Preproses Perusahaan</h2>

    <!-- Tombol Perhitungan Entropy & Gain -->
    <div class="mb-4">
        <a href="{{ route('perusahaan.c45') }}" 
           class="inline-block bg-gradient-to-r from-indigo-500 to-purple-500 text-white font-semibold px-6 py-2 rounded-lg shadow hover:shadow-lg transition duration-300">
           Hitung Entropy & Gain
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Perusahaan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIB</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Skala Usaha</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Modal Usaha</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tenaga Kerja</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Label</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($result as $perusahaan)
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $perusahaan->nama_perusahaan }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $perusahaan->nib }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $perusahaan->skala_usaha }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $perusahaan->modal_usaha }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $perusahaan->tenaga_kerja }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $perusahaan->label }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
        {{ $perusahaans->links('pagination::tailwind') }}
    </div>
</div>
@endsection
