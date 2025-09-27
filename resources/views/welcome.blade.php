@extends('layouts.temp')

@section('content')
<hr>
<hr>
<hr>
<hr>
<hr>
<hr>
    <!-- Hero Header -->
    <section class="page-header bg-light py-5 mb-5 text-center">
        <div class="container">
            <h1 class="display-4 fw-bold text-dark">UMKM Promotion</h1>
            <p class="lead text-muted">Temukan berbagai produk dan proyek unggulan dari UMKM lokal</p>
            <a href="#mobile-products" class="btn btn-primary mt-3">Jelajahi Sekarang</a>
        </div>
    </section>

    <!-- Product Section -->
    <section id="mobile-products" class="product-store position-relative padding-large no-padding-top">
        <div class="container">
            <div class="row">
                <div class="display-header d-flex justify-content-between pb-3">
                    <h2 class="display-7 text-dark text-uppercase">Daftar Produk UMKM</h2>
                    <div class="btn-right">
                        <a href="{{route('product.index')}}" class="btn btn-medium btn-normal text-uppercase">Go to Shop</a>
                    </div>
                </div>

                <div class="swiper product-swiper">
                    <div class="swiper-wrapper">
                        @foreach($umkms as $umkm)
                        <div class="swiper-slide">
                            <div class="product-card position-relative">
                                <div class="image-holder">
                                    @if($umkm->image)
                                        <img src="{{ asset('storage/' . $umkm->image) }}" alt="{{ $umkm->nama_proyek }}" class="img-fluid rounded shadow">
                                    @else
                                        <img src="{{ asset('images/default.png') }}" alt="default" class="img-fluid rounded shadow">
                                    @endif
                                </div>
                                <div class="cart-concern position-absolute">
                                    <div class="cart-button d-flex">
                                        <a href="{{ route('umkm.show', $umkm->id) }}" class="btn btn-medium btn-black">
                                            Lihat
                                            <svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                    <h3 class="card-title text-uppercase">
                                        <a href="{{ route('umkm.show', $umkm->id) }}">{{ $umkm->nama_proyek }}</a>
                                    </h3>
                                    <span class="item-price text-primary fw-bold">
                                        Rp {{ number_format($umkm->harga, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Optional Swiper navigation --}}
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-pagination position-absolute text-center"></div>
                </div>
            </div>
        </div>
    </section>


    <div class="container my-5">

        {{-- Form Pencarian Kegiatan --}}
        <form method="GET" action="{{ route('home.index') }}" class="mb-4 d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari kegiatan..." value="{{ $search ?? '' }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
    
        {{-- Section Kegiatan --}}
        <h2 class="mb-3">Daftar Kegiatan</h2>
        <div class="row">
            @foreach($kegiatans as $kegiatan)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if($kegiatan->foto)
                            <img src="{{ asset('storage/' . $kegiatan->foto) }}" 
                                 class="card-img-top" 
                                 alt="{{ $kegiatan->nama }}" 
                                 style="height:200px; object-fit:cover;">
                        @else
                            <img src="{{ asset('images/default.png') }}" 
                                 class="card-img-top" 
                                 alt="Default" 
                                 style="height:200px; object-fit:cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $kegiatan->nama }}</h5>
                            <p class="card-text">{{ Str::limit($kegiatan->deskripsi, 100) }}</p>
                        </div>
                        <div class="card-footer text-muted">
                            Tanggal: {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('d M Y') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    
        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {{ $kegiatans->links() }}
        </div>
    
    </div>
@endsection
