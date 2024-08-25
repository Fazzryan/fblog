@extends('frontend.layouts.app_main')
@push('meta-seo')
    <title>Fazzblog - Kategori {{ $nama_kategori }}</title>
    <meta content="Halaman Postingan Kategori Fazzblog" name="description">
    <meta content="Dinda Fazryan" name="author">
    <meta content="fazzblog" name="keywords">
@endpush

@push('bread_crumb')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-lg-12">
            <div class="text-center">
                <h1 class="display-4 fw-medium text-dark">Kategori :
                    <span class="text-primary">{{ $nama_kategori }}</span>
                </h1>
                <p class="mt-3">Temukan berbagai artikel menarik dan edukatif dalam beragam kategori <br> mulai
                    dari
                    tips & trik hingga kesehatan, pendidikan, dan berita terkini.</p>
            </div>
            <div cl <div class="d-flex justify-content-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0 bg-white">
                        <li class="breadcrumb-item fw-medium">
                            <a href="{{ route('fe.home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item fw-medium">
                            <a href="{{ route('fe.kategori.list') }}">Kategori</a>
                        </li>
                        <li class="breadcrumb-item fw-medium active">
                            {{ $nama_kategori }}
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
    <div class="row category mt-3">
        <div class="category-wrap">
            <span class="scroll scroll-backward">
                <a class="text-dark" href="#"><i class="bi bi-caret-left-fill"></i> </a>
            </span>
            <span class="scroll scroll-forward">
                <a class="text-dark" href="#"><i class="bi bi-caret-right-fill"></i> </a>
            </span>
            <ul id="scrollContainer">
                {{-- <li class="category-item active">
                    <a href="">Personal Web Design</a>
                </li> --}}
                @foreach ($get_kategori as $item)
                    <li class="category-item {{ request()->segment(2) == $item->slug_kategori ? 'active' : '' }}">
                        <a href="{{ route('fe.kategori.nm_kategori', ['nm_kategori' => $item->slug_kategori]) }}"
                            class="text-capitalize">{{ $item->nm_kategori }}</a>
                    </li>
                @endforeach
            </ul>

        </div>
    </div>

    <div class="row">
        <div class="row">
            @forelse ($get_postingan as $item)
                <div class="col-md-6 col-lg-4 mt-md-2 mt-3">
                    <div class="card rounded-8 shadow-none">
                        <a href="{{ route('fe.detail_postingan', ['nm_kategori' => $item->slug_kategori, 'detail_postingan' => $item->slug]) }}"
                            class="overflow-hidden" style="border-radius:14px; transition:all .5s">
                            <img src="{{ asset('assets/be/images/icons') . '/' . $item->image }}"
                                style="width: 100%; object-fit:cover; aspect-ratio: 16/10; border-radius:14px;"
                                alt="image" class="card-image">
                        </a>
                        <div class="card-body p-0">
                            <div class="d-flex justify-content-between mt-3 fs-6">
                                <a href="{{ route('fe.kategori.nm_kategori', ['nm_kategori' => $item->slug_kategori]) }}"
                                    class="card-link fw-medium"> <i class="bi bi-tags"></i>
                                    {{ $item->nm_kategori }}</a>
                                <div class="fs-6 fw-medium">
                                    @php
                                        $date_create = date_create($item->tgl_dibuat);
                                        $date = date_format($date_create, 'd M Y');
                                    @endphp
                                    {{ $date }}
                                </div>
                            </div>
                            <h3 class="card-title mt-2 ">
                                <a href="{{ route('fe.detail_postingan', ['nm_kategori' => $item->slug_kategori, 'detail_postingan' => $item->slug]) }}"
                                    class="card-link text-capitalize">
                                    {!! Str::limit($item->title, 70) !!}
                                </a>
                            </h3>
                            <p class="card-text m-0 fs-6">{!! Str::limit($item->content, 90) !!}</p>
                        </div>
                        {{-- <div class="bg-white px-0 fs-6">
                            <div class="d-flex justify-content-between">
                                <span class="fw-medium">Oleh {{ $item->username }}</span>
                                <div class="fs-6 fw-medium">
                                    {{ $item->tgl_dibuat }}
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            @empty
                <p class="text-center">Tidak ada postingan</p>
            @endforelse
        </div>
    </div>
@endsection
