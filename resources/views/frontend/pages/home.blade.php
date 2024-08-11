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
                    @foreach ($get_kategori as $category)
                        <li class="category-item {{ request()->segment(3) == $category->slug_kategori ? 'active' : '' }}">
                            <a href="/blog/category/{{ $category->slug_kategori }}"
                                class="text-capitalize">{{ $category->nm_kategori }}</a>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>

    <div class="row">
        @forelse ($get_postingan as $item)
            <div class="col-md-6 col-lg-4 mt-md-2 mt-3">
                <div class="card rounded-8 shadow-none">
                    <a href="/blog/category/{{ $item->nm_kategori }}/{{ $item->slug }}" class="overflow-hidden"
                        style="border-radius:14px; transition:all .5s">
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
                            <a href="{{ route('fe.kategori') . '/' . $item->slug_kategori }}" class="card-link fw-medium">
                                <i class="bi bi-tags"></i>
                                {{ $item->nm_kategori }}</a>
                        </div>
                        <h3 class="card-title mt-2 ">
                            <a href="/blog/category/{{ $item->slug_kategori }}/{{ $item->slug }}"
                                class="card-link text-capitalize">
                                {!! Str::limit($item->title, 60) !!}
                            </a>
                        </h3>
                        <p class="card-text m-0">{!! Str::limit($item->content, 90) !!}</p>
                    </div>
                    <div class="bg-white px-0 fs-6">
                        <div class="d-flex justify-content-between">
                            <span class="fw-medium">Oleh <span class="text-capitalized">{{ $item->username }}</span></span>
                            <div class="fs-6 fw-medium">
                                {{ $item->tgl_dibuat }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <p class="text-center">Tidak ada postingan</p>
        @endforelse
        {{-- <div class="d-flex justify-content-center mt-4">{{ $items->links() }}
        </div> --}}
    </div>
@endsection
