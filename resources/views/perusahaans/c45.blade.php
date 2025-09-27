@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Hasil Perhitungan C4.5</h2>

    <!-- Tombol Generate Rules -->
    <div class="mb-6">
        <a href="{{ route('perusahaan.generateRules') }}"
           class="inline-block px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition-colors duration-200">
            Generate Rules
        </a>
    </div>

    <!-- Section: Gain per Atribut -->
    <div class="mb-8">
        <h3 class="text-xl font-semibold mb-4">Hasil Gain per Atribut</h3>
        <table class="min-w-full divide-y divide-gray-200 bg-white rounded-lg shadow-md">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Atribut</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gain</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($results as $attr => $gain)
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $attr }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ number_format($gain, 4) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4 text-lg font-semibold text-indigo-600">
            Atribut dengan Gain Tertinggi: {{ $bestAttribute }}
        </div>
    </div>

    <!-- Section: Detail Perhitungan Entropy -->
    <div class="mb-8">
        <h3 class="text-xl font-semibold mb-4">Detail Entropy per Atribut</h3>

        @foreach($details as $attr => $info)
            <div class="mb-6 border rounded-lg shadow-sm bg-white">
                <!-- Header Collapse -->
                <button class="w-full px-4 py-3 text-left text-gray-800 font-semibold flex justify-between items-center focus:outline-none focus:ring"
                        onclick="document.getElementById('detail-{{ $attr }}').classList.toggle('hidden')">
                    <span>{{ $attr }} (Gain: {{ number_format($results[$attr], 4) }})</span>
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Content Collapse -->
                <div id="detail-{{ $attr }}" class="hidden p-4">
                    <p class="text-gray-600 mb-2">Entropy Parent: {{ $info['entropy_parent'] }}</p>
                    <p class="text-gray-600 mb-4">Entropy Child: {{ $info['entropy_child'] }}</p>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entropy</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bobot</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hasil</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($info['per_nilai'] as $row)
                                <tr class="hover:bg-gray-100">
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $row['nilai'] }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $row['jumlah'] }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $row['entropy'] }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $row['bobot'] }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $row['hasil'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
