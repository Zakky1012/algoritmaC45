@extends('layout.temp')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <!-- Gambar Utama -->
                <div class="position-relative">
                    @if($umkm->image)
                        <img src="{{ asset('storage/' . $umkm->image) }}" class="card-img-top" alt="{{ $umkm->nama }}">
                    @else
                        <img src="https://via.placeholder.com/900x400?text=No+Image" class="card-img-top" alt="No image">
                    @endif
                    <div class="position-absolute top-0 start-0 p-3">
                        <a href="{{ route('umkm.index') }}" class="btn btn-sm btn-light shadow-sm">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>

                <!-- Konten Detail -->
                <div class="card-body p-4">
                    <h2 class="fw-bold">{{ $umkm->nama }}</h2>
                    <p class="text-muted mb-3"><i class="bi bi-geo-alt-fill"></i> {{ $umkm->lokasi ?? 'Lokasi tidak tersedia' }}</p>

                    <h5 class="fw-semibold">Deskripsi</h5>
                    <p class="text-justify" style="line-height: 1.7;">
                        {!! nl2br(e($umkm->deskripsi ?? 'Belum ada deskripsi')) !!}
                    </p>

                    @if($umkm->kontak)
                        <div class="mt-3">
                            <h5 class="fw-semibold">Kontak</h5>
                            <p><i class="bi bi-telephone-fill"></i> {{ $umkm->kontak }}</p>
                        </div>
                    @endif

                    @if($umkm->sosial_media)
                        <div class="mt-3">
                            <h5 class="fw-semibold">Sosial Media</h5>
                            <a href="{{ $umkm->sosial_media }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill">
                                <i class="bi bi-instagram"></i> Kunjungi
                            </a>
                        </div>
                    @endif

                    <!-- Gallery -->
                    @if(!empty($umkm->gallery) && count($umkm->gallery) > 0)
                        <div class="mt-4">
                            <h5 class="fw-semibold">Galeri Produk</h5>
                            <div class="row g-3">
                                @foreach($umkm->gallery as $img)
                                    <div class="col-md-4 col-6">
                                        <div class="ratio ratio-4x3 rounded shadow-sm overflow-hidden">
                                            <img src="{{ asset('storage/' . $img) }}" class="img-fluid object-fit-cover" alt="Gallery">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Tombol Aksi -->
                    <div class="mt-4 d-flex gap-2">
                        <a href="#" class="btn btn-success rounded-pill px-4">
                            <i class="bi bi-cart"></i> Beli Sekarang
                        </a>
                        <a href="{{ route('umkm.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="bi bi-arrow-left-circle"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
