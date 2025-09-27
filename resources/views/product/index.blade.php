@extends('layouts.temp')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4 fw-bold">Produk UMKM</h2>

    <div class="row g-4">
        @foreach($umkms as $umkm)
            <div class="col-md-4 col-sm-6">
                <div class="card h-100 shadow-sm border-0 rounded-4">
                    <!-- Gambar Produk -->
                    <div class="position-relative">
                        @if($umkm->image)
                            <img src="{{ asset('storage/' . $umkm->image) }}" class="card-img-top rounded-top-4" alt="{{ $umkm->nama }}">
                        @else
                            <img src="https://via.placeholder.com/400x250?text=No+Image" class="card-img-top rounded-top-4" alt="No Image">
                        @endif
                        <span class="badge bg-success position-absolute top-0 start-0 m-2 px-3 py-2 rounded-pill">
                            {{ $umkm->kategori->name ?? 'UMKM' }}
                        </span>
                    </div>

                    <!-- Detail Produk -->
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-dark">{{ $umkm->nama_proyek }}</h5>
                        <p class="card-text text-muted small">
                            {{ Str::limit($umkm->deskripsi, 100) }}
                        </p>

                        <div class="mt-auto">
                            <p class="fw-bold text-primary mb-2">Rp {{ number_format($umkm->harga, 0, ',', '.') }}</p>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('umkm.show', $umkm->id) }}" class="btn btn-outline-primary btn-sm rounded-pill">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>
                                <a href="https://wa.me/{{ $umkm->kontak }}" target="_blank" class="btn btn-success btn-sm rounded-pill">
                                    <i class="bi bi-whatsapp"></i> Hubungi
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
