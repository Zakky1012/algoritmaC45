@extends('layouts.temp')

@section('content')


<hr>
<hr>
<hr>
<hr>
<hr>
<hr>
<hr>
<hr>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden p-4">
                <div class="row g-4 align-items-center">
                    <!-- Kolom Gambar -->
                    <div class="col-md-5">
                        <div class="ratio ratio-4x3 rounded overflow-hidden shadow-sm">
                            @if($umkm->image)
                                <img src="{{ asset('storage/' . $umkm->image) }}" class="img-fluid object-fit-cover" alt="{{ $umkm->nama }}">
                            @else
                                <img src="https://via.placeholder.com/500x300?text=No+Image" class="img-fluid object-fit-cover" alt="No image">
                            @endif
                        </div>
                    </div>

                    <!-- Kolom Deskripsi -->
                    <div class="col-md-7">
                        <h2 class="fw-bold mb-2">{{ $umkm->nama_proyek }}</h2>
                        <p class="text-muted mb-3"><i class="bi bi-geo-alt-fill"></i> {{ $umkm->lokasi ?? 'Lokasi tidak tersedia' }}</p>

                        <h5 class="fw-semibold">Deskripsi</h5>
                        <p class="text-secondary" style="line-height: 1.7;">
                            {!! nl2br(e($umkm->deskripsi ?? 'Belum ada deskripsi')) !!}
                        </p>

                        @if($umkm->kontak)
                            <div class="mt-3">
                                <h6 class="fw-semibold">Kontak</h6>
                                <p><i class="bi bi-telephone-fill"></i> {{ $umkm->kontak }}</p>
                            </div>
                        @endif

                        @if($umkm->sosial_media)
                            <div class="mt-3">
                                <h6 class="fw-semibold">Sosial Media</h6>
                                <a href="{{ $umkm->sosial_media }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill">
                                    <i class="bi bi-instagram"></i> Kunjungi
                                </a>
                            </div>
                        @endif

                        <!-- Tombol Aksi -->
                        <div class="mt-4 d-flex gap-2">
                       
                            <a href="{{ route('umkm.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="bi bi-arrow-left-circle"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Galeri -->
                @if(!empty($umkm->gallery) && count($umkm->gallery) > 0)
                    <div class="mt-5">
                        <h5 class="fw-semibold mb-3">Galeri Produk</h5>
                        <div class="row g-3">
                            @foreach($umkm->gallery as $img)
                                <div class="col-md-3 col-6">
                                    <div class="ratio ratio-4x3 rounded shadow-sm overflow-hidden">
                                        <img src="{{ asset('storage/' . $img) }}" class="img-fluid object-fit-cover" alt="Gallery">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
