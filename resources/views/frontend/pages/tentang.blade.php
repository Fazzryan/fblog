@extends('frontend.layouts.app_main')
@push('meta-seo')
    <title>Fazzblog - Tentang</title>
    <meta content="Halaman Tentang Fazzblog" name="description">
    <meta content="Dinda Fazryan" name="author">
    <meta content="fazzblog" name="keywords">
@endpush
@push('custom-css')
    <link rel="stylesheet" href="{{ asset('assets/be/libs/selectpicker/bootstrap-select.min.css') }}">
@endpush
@section('konten')
    <div class="row justify-content-center about">
        <div class="col-lg-6">
            <div class="d-md-flex text-center text-md-start">
                <img src="{{ asset('assets/be/images/pic') . '/' . $get_profile->foto }}" alt="profile" class="img-profile"
                    loading="lazy">
                <div class="ms-md-5 ms-0 mt-3 mt-md-0">
                    <h1 class="fw-bold">{{ $get_profile->nm_depan }} {{ $get_profile->nm_belakang }} </h1>
                    <p>Seorang yang antusias dalam dunia pemrograman. Senang mempelajari
                        hal-hal
                        baru, terutama
                        mengenai pemrograman web dan desain web. Bahagia berbagi pengetahuan dan belajar dari orang
                        lain.</p>
                    <div class="icon-section justify-content-center justify-content-md-start">
                        <a href="{{ $get_profile->instagram }}" class="icon-item" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="{{ $get_profile->github }}" class="icon-item" target="_blank">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="{{ $get_profile->youtube }}" class="icon-item" target="_blank">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-12 text-center">
            <h2 class="fw-bold d-inline-block position-relative">Hubungi Saya
                {{-- <span class="d-block w-100 bg-dark position-absolute start-0"
                style="height: 2px; bottom: -5px;"></span> --}}
            </h2>
        </div>
        <div class="col-md-8 col-lg-6 mt-3">
            @if (session('status'))
                <div class="alert alert-danger alert-dismissible bg-danger fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible bg-success rounded-8 text-white fw-medium fade show"
                    role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{ route('fe.act_send_message') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <input class="form-control rounded-8 @error('nm_lengkap') is-invalid @enderror" id="nm_lengkap"
                                type="text" name="nm_lengkap" placeholder="Nama Lengkap" required>
                        </div>
                        @error('nm_lengkap')
                            <span class="error text-danger fs-6"> * {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <input class="form-control rounded-8 @error('email') is-invalid @enderror" id="email"
                                type="email" name="email" placeholder="Email" required>
                        </div>
                        @error('email')
                            <span class="error text-danger fs-6"> * {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-12">
                        <textarea name="pesan" id="pesan" class="form-control rounded-8 @error('pesan') is-invalid @enderror"
                            cols="12" rows="7" required></textarea>
                        @error('pesan')
                            <span class="error text-danger fs-6"> * {{ $message }}</span>
                        @enderror
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-dark fw-medium rounded-8">
                                <i class="fas fa-paper-plane me-1"></i>
                                Kirim
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
