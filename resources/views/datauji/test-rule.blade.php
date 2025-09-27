@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Hasil Uji Rule C4.5</h2>

    <!-- Persentase Cocok -->
    <div class="mb-6 p-4 bg-green-100 rounded-lg shadow-md">
        <p class="text-lg font-semibold">
            Persentase Cocok: <span class="text-green-700">{{ $persentaseCocok }}%</span>
        </p>
    </div>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full table-auto border border-gray-200">
            <thead class="bg-gray-100">
                <tr class="text-center">
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">NIB</th>
                    <th class="px-4 py-2 border">Nama Perusahaan</th>
                    <th class="px-4 py-2 border">Label Asli</th>
                    <th class="px-4 py-2 border">Label Prediksi</th>
                    <th class="px-4 py-2 border">Status</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($predicted as $index => $d)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 border">{{ $d->nib }}</td>
                    <td class="px-4 py-2 border">{{ $d->nama_perusahaan }}</td>
                    <td class="px-4 py-2 border">{{ $d->label_asli }}</td>
                    <td class="px-4 py-2 border">{{ $d->prediksi_label }}</td>
                    <td class="px-4 py-2 border">
                        @if($d->status === 'Cocok')
                            <span class="text-green-600 font-semibold">{{ $d->status }}</span>
                        @else
                            <span class="text-red-600 font-semibold">{{ $d->status }}</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
