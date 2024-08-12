@extends('frontend.layouts.app_main')
@push('meta-seo')
    <title>Fazzblog - Kategori</title>
    <meta content="Halaman Kategori Fazzblog" name="description">
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
            <div class="text-center">
                <h1 class="display-4 fw-medium text-dark">Kategori</h1>
                <p class="mt-3">Temukan berbagai artikel menarik dan edukatif dalam beragam kategori <br> mulai
                    dari
                    tips & trik hingga kesehatan, pendidikan, dan berita terkini.</p>
            </div>
            <div class="d-flex justify-content-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0 bg-white">
                        <li class="breadcrumb-item fw-medium"><a href="{{ route('fe.home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item fw-medium active">Kategori
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
    <div class="row all-category mt-3">
        @forelse ($get_kategori as $kategori)
            <div class="col-6 col-md-4 col-lg-2">
                <a href="/kategori/{{ $kategori->slug_kategori }}" class="category-link">
                    <div class="category-item">
                        {{ $kategori->nm_kategori }}
                    </div>
                </a>
            </div>
        @empty
            <div class="col-lg-12 text-center">
                <p>Tidak ada kategori</p>
            </div>
        @endforelse
    </div>
@endsection
