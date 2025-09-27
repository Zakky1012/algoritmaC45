@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <div class="bg-white shadow-lg rounded-xl p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">Detail Perusahaan</h2>
        
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-sm">
            <div>
                <dt class="font-semibold text-gray-700">NIB</dt>
                <dd class="text-gray-900">{{ $perusahaan->nib }}</dd>
            </div>

            <div>
                <dt class="font-semibold text-gray-700">Nama Perusahaan</dt>
                <dd class="text-gray-900">{{ $perusahaan->nama_perusahaan }}</dd>
            </div>

            <div>
                <dt class="font-semibold text-gray-700">Skala Usaha</dt>
                <dd class="text-gray-900">{{ $perusahaan->skala_usaha }}</dd>
            </div>

            <div>
                <dt class="font-semibold text-gray-700">Jenis Usaha</dt>
                <dd class="text-gray-900">{{ $perusahaan->jenis_usaha }}</dd>
            </div>

            <div>
                <dt class="font-semibold text-gray-700">Nama Proyek</dt>
                <dd class="text-gray-900">{{ $perusahaan->nama_proyek ?? '-' }}</dd>
            </div>

            <div>
                <dt class="font-semibold text-gray-700">Alamat Usaha</dt>
                <dd class="text-gray-900">{{ $perusahaan->alamat_usaha ?? '-' }}</dd>
            </div>

            <div>
                <dt class="font-semibold text-gray-700">Kecamatan</dt>
                <dd class="text-gray-900">{{ $perusahaan->kecamatan_usaha ?? '-' }}</dd>
            </div>

            <div>
                <dt class="font-semibold text-gray-700">Kelurahan</dt>
                <dd class="text-gray-900">{{ $perusahaan->kelurahan_usaha ?? '-' }}</dd>
            </div>

            <div>
                <dt class="font-semibold text-gray-700">Nomor Identitas User</dt>
                <dd class="text-gray-900">{{ $perusahaan->nomor_identitas_user ?? '-' }}</dd>
            </div>

            <div>
                <dt class="font-semibold text-gray-700">Email</dt>
                <dd class="text-gray-900">{{ $perusahaan->email ?? '-' }}</dd>
            </div>

            <div>
                <dt class="font-semibold text-gray-700">Nomor Telepon</dt>
                <dd class="text-gray-900">{{ $perusahaan->nomor_telp ?? '-' }}</dd>
            </div>

            <div>
                <dt class="font-semibold text-gray-700">Modal Usaha</dt>
                <dd class="text-gray-900">Rp {{ number_format($perusahaan->modal_usaha, 0, ',', '.') }}</dd>
            </div>

            <div>
                <dt class="font-semibold text-gray-700">Tenaga Kerja</dt>
                <dd class="text-gray-900">{{ $perusahaan->tenaga_kerja }}</dd>
            </div>

            <div class="md:col-span-2">
                <dt class="font-semibold text-gray-700">Label</dt>
                <dd>
                    @if($perusahaan->label == 'Layak')
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                            {{ $perusahaan->label }}
                        </span>
                    @elseif($perusahaan->label == 'Tidak Layak')
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                            {{ $perusahaan->label }}
                        </span>
                    @else
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            {{ $perusahaan->label }}
                        </span>
                    @endif
                </dd>
            </div>
        </dl>

        <div class="mt-6 flex justify-end">
            <a href="{{ route('perusahaans.index') }}" 
               class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection
