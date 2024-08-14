@extends('frontend.layouts.app_main')
@push('meta-seo')
    <title>Fazzblog - {{ $nama_title }}</title>
    <meta content="Halaman Detail Blog Fazzblog" name="description">
    <meta content="Dinda Fazryan" name="author">
    <meta content="fazzblog" name="keywords">
@endpush
@push('custom-css')
    <link rel="stylesheet" href="{{ asset('assets/be/libs/selectpicker/bootstrap-select.min.css') }}">
@endpush
@push('bread_crumb')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0 bg-white">
                        <li class="breadcrumb-item fw-medium">
                            <a href="{{ route('fe.home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item fw-medium">
                            <a href="">{{ $nama_slug }}</a>
                        </li>
                        <li class="breadcrumb-item fw-medium active">
                            {{ $nama_title }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
@endpush
@section('konten')
    <div class="row justify-content-between g-5 detail-post">
        <div class="col-md-12 col-lg-8">
            <h2 class="text-dark fw-bold mt-3">{{ $get_postingan->title }}</h2>
            <span class="fs-7 fw-medium">
                <i class="fas fa-user"></i>
                {{ ucwords($get_postingan->username) }}
                <i class="fas fa-calendar ms-1"></i>
                @php
                    $date_create = date_create($get_postingan->tgl_dibuat);
                    $date = date_format($date_create, 'd M Y');
                @endphp
                {{ $date }}
                <i class="fas fa-tags ms-1"></i>
                {{ $get_postingan->nm_kategori }}
            </span>
            <img src="{{ asset('assets/be/images/icons') . '/' . $get_postingan->image }}" alt="image" loading="lazy"
                class="w-100 mt-3 rounded-8">
            <div class="w-100">
                <p class="blog-content">{!! $get_postingan->content !!}</p>
            </div>
            <div class="share-section mt-4">
                <h5 class="fw-medium text-dark mb-3">Bagikan Postingan</h5>
                <a href="#" class="btn btn-outline-danger rounded-8">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="btn btn-outline-primary rounded-8">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="#" class="btn btn-outline-cyan rounded-8">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="btn btn-outline-success rounded-8">
                    <i class="fab fa-whatsapp"></i>
                </a>
            </div>
        </div>
        <div class="col-md-12 col-lg-4">
            <div class="position-sticwky mb-4" style="top:100px;">
                {{-- <h3 class="fw-bold text-uppercase">Artikel Terbaru</h3> --}}
                <h3 class="fw-bold text-uppercase border-5 border-bottom pb-2">Artikel Terbaru</h3>
                @forelse ($get_postingan_terbaru as $item)
                    <a href="{{ route('fe.detail_postingan', ['nm_kategori' => $item->slug_kategori, 'detail_postingan' => $item->slug]) }}"
                        class="latest-article">
                        <div class="d-flex align-itwems-center justify-content-between border-bottom py-3">
                            <div class="me-3">
                                <span class="fs-7 text-primary fw-medium">{{ $item->nm_kategori }}</span>
                                <h5 class="fw-medium mt-1">{!! Str::limit($item->title, 60) !!}</h5>
                                <span class="fs-7">{{ $item->tgl_dibuat }}</span>
                            </div>
                            <img src="{{ asset('assets/be/images/icons') . '/' . $item->image }}" class="rounded-8"
                                style="width: 120px; height:80px; aspect-ratio:1/1; object-fit: cover;" alt="image"
                                loading="lazy">
                        </div>
                    </a>
                    {{-- <div class="border my-2"></div> --}}
                @empty
                    <p>Tidak ada postingan terbaru!</p>
                @endforelse
            </div>
            <div class="mt-3">
                <h3 class="fw-bold text-uppercase border-5 border-bottom pb-2">Kategori</h3>
                @forelse ($get_kategori as $item)
                    <a href="{{ route('fe.kategori.nm_kategori', ['nm_kategori' => $item->slug_kategori]) }}"
                        class="btn btn-sm btn-outline-dark mt-2 rounded-8 fw-medium">
                        {{ $item->nm_kategori }}
                    </a>
                @empty
                    <div class="col-lg-12 text-center">
                        <p>Tidak ada kategori</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
