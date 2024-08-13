<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-white border-bottom">
    <div class="container py-1">
        <a class="navbar-brand" href="{{ route('fe.home') }}">
            <img src="{{ asset('assets/be/images/icons/logo.png') }}" width="40" alt="">
            <h3 class="d-inline fw-bolder">Fazz<span class="text-primary">blog</span></h3>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item mx-1">
                    <a class="nav-link fw-medium {{ request()->is('/') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('fe.home') }}">Home</a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link fw-medium {{ request()->is('kategori') || request()->is('nm_kategori') ? 'active' : '' }}"
                        href="{{ route('fe.kategori.list') }}">Kategori</a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link fw-medium {{ request()->is('tentang') ? 'active' : '' }}"
                        href="{{ route('fe.tentang.list') }}">Tentang</a>
                </li>
            </ul>

            <form method="get" action="" class="d-flex">
                {{-- @csrf --}}
                <input class="form-control me-1 rounded-8" type="search" name="keyword"
                    value="{{ old('keyword', request('keyword')) }}" placeholder="Cari Blog" aria-label="Search">
                <button class="btn btn-dark rounded-8" type="submit">
                    <i class="fas fa-search"></i>
                </button>
                {{-- <div class="input-group ">
                    <input type="text" name="keyword" class="form-control rounded-8" placeholder="Cari postingan..."
                        value="{{ old('keyword', request('keyword')) }}" aria-describedby="button-addon2">
                    <button class="btn btn-dark rounded-8" type="submit" id="button-addon2"><i
                            class="bi bi-search"></i></button>
                </div> --}}
            </form>
        </div>
    </div>
</nav>
