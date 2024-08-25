@extends('frontend.layouts.app_main')
@push('meta-seo')
    <title>Fazzblog</title>
    <meta content="Halaman Utama Fazzblog" name="description">
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
    {{-- <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Halaman Dashboard</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="">Dashboard</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
@endpush
@section('konten')
    <div class="row">
        <div class="col-lg-12">
            <div class="text-center">
                @if (request('keywords'))
                    <h2 class="display-7 text-capitalize">menampilkan hasil
                        dari "<span class="fw-bold text-dark ">{{ request('keywords') }}</span>"</h3>
                    @else
                        <h1 class="display-4 fw-medium text-dark">Trending On <span class="text-primary">Fazzblog</span>
                        </h1>
                        <h4 class="text-dark fw-medium my-3">"Couriosity didn't kill the cat, it created the
                            mousetrap"
                            <br>
                            -Patrick
                            Hanlon
                        </h4>
                        <h4 class="text-muted">So read on to nourish your mind. The wheel isn't going to reinvent
                            itself
                        </h4>
                @endif
            </div>
        </div>
    </div>

    <div class="row category mt-3">
        <div class="col-lg-12">
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
    </div>

    <div class="row justify-content-start">
        @forelse ($get_postingan as $item)
            <div class="col-md-6 col-lg-4 mt-md-2 mt-3">
                <div class="card rounded-8 shadow-none">
                    <a href="{{ route('fe.detail_postingan', ['nm_kategori' => $item->slug_kategori, 'detail_postingan' => $item->slug]) }}"
                        class="overflow-hidden" style="border-radius:14px; transition:all .5s">
                        @if ($item->image)
                            <img src="{{ asset('assets/be/images/icons/' . $item->image) }}"
                                style="width: 100%; object-fit:cover; aspect-ratio: 16/10; border-radius:14px;"
                                alt="image" class="card-image" loading="lazy">
                        @else
                            <img src="https://source.unsplash.com/photos/random/" alt="image" class="card-image">
                        @endif
                    </a>
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between mt-3 fs-6">
                            <a href="{{ route('fe.kategori.nm_kategori', ['nm_kategori' => $item->slug_kategori]) }}"
                                class="card-link fw-medium">
                                <i class="bi bi-tags"></i>
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
                        <p class="card-text m-0">{!! Str::limit($item->content, 90) !!}</p>
                    </div>
                    {{-- <div class="bg-white px-0 fs-6">
                        <div class="d-flex justify-content-between">
                            <span class="fw-medium">Oleh <span>{{ ucwords($item->username) }}</span></span>
                            <div class="fs-6 fw-medium">
                                @php
                                    $date_create = date_create($item->tgl_dibuat);
                                    $date = date_format($date_create, 'd M Y');
                                @endphp
                                {{ $date }}
                            </div>
                        </div>
                    </div> --}}

                </div>
            </div>
        @empty
            <div class="col-md-6 col-lg-5 text-center">
                <img src="{{ asset('assets/fe/images/404/notfound.svg') }}" alt="image" class="w-75 mb-5 mt-3">
                <h3 class="fw-bolder">Tidak Menemukan Hasil!</h3>
                <p>Tampaknya kami tidak dapat menemukan hasil apa pun berdasarkan penelusuran Anda.
                </p>
                <a href="{{ route('fe.home') }}" class="btn btn-dark rounded-6 fw-bold">
                    <i class="fas fa-reply"></i>
                    Kembali
                </a>
            </div>
        @endforelse
        <div class="d-flex justify-content-center mt-4">{{ $get_postingan->links() }}
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var $scrollContainer = $('#scrollContainer');
            var scrollAmount = 200; // Jumlah scroll dalam piksel

            function checkScroll() {
                var maxScrollLeft = $scrollContainer[0].scrollWidth - $scrollContainer[0].clientWidth;
                $('.scroll-backward').toggle($scrollContainer.scrollLeft() > 0);
                $('.scroll-forward').toggle($scrollContainer.scrollLeft() < maxScrollLeft);
            }

            // Initial check
            checkScroll();

            $('.scroll-backward').click(function() {
                $scrollContainer.scrollLeft($scrollContainer.scrollLeft() - scrollAmount);
                setTimeout(checkScroll,
                    100); // Tambahkan sedikit jeda untuk memastikan scroll telah terjadi
            });

            $('.scroll-forward').click(function() {
                $scrollContainer.scrollLeft($scrollContainer.scrollLeft() + scrollAmount);
                setTimeout(checkScroll,
                    100); // Tambahkan sedikit jeda untuk memastikan scroll telah terjadi
            });

            $scrollContainer.on('scroll', checkScroll); // Perbarui tombol ketika konten digulir secara manual
        });
    </script>
@endpush
