@extends('backend.layouts.app_main')
@push('meta-seo')
    <title>Fazzblog - Dashboard</title>
    <meta content="Halaman Dashboard" name="description">
    <meta content="Dinda Fazryan" name="author">
    <meta content="fazzblog" name="keywords">
@endpush
@push('custom-css')
    <!-- This page plugin CSS -->
    <link rel="stylesheet" href="{{ asset('assets/be/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/be/extra-libs/datatables.net-bs4/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/be/libs/selectpicker/bootstrap-select.min.css') }}">
@endpush
@push('bread_crumb')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
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
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
@endpush
@section('konten')
    <div class="row">
        <div class="col-md-12">
            @include('backend.layouts.app_session')
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card rounded-8">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <div class="d-inline-flex align-items-center">
                                <h2 class="text-dark mb-1 font-weight-medium">{{ $jml_postingan }}</h2>
                            </div>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Jumlah Postingan
                            </h6>
                        </div>
                        <div class="ms-auto mt-md-3 mt-lg-0">
                            <i data-feather="layers" class="feather-icon text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card rounded-8">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">{{ $jml_kategori }}</h2>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Jumlah Kategori
                            </h6>
                        </div>
                        <div class="ms-auto mt-md-3 mt-lg-0">
                            <i data-feather="box" class="feather-icon text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card rounded-8">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <div class="d-inline-flex align-items-center">
                                <h2 class="text-dark mb-1 font-weight-medium">{{ $jml_pesan }}</h2>
                            </div>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Jumlah Pesan
                            </h6>
                        </div>
                        <div class="ms-auto mt-md-3 mt-lg-0">
                            <i data-feather="message-circle" class="feather-icon text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card rounded-8">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <div class="d-inline-flex align-items-center">
                                <h2 class="text-dark mb-1 font-weight-medium">...</h2>
                            </div>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Cooming Soon
                            </h6>
                        </div>
                        <div class="ms-auto mt-md-3 mt-lg-0">
                            <i data-feather="help-circle" class="feather-icon text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Postingan --}}
    <div class="col-lg-12">
        <div class="card rounded-8">
            <div class="card-body">
                <h4 class="mb-3 fw-medium text-dark">Tabel Postingan</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-light text-dark">
                            <tr>
                                <th>#</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($get_postingan as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{!! Str::limit($item->title, 90) !!}</td>
                                    <td>{{ $item->nm_kategori }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" align="center">Data masih kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-md-flex align-items-center justify-content-end">
                    <a href="{{ route('be.postingan.list') }}"
                        class="rounded-8 btn fs-7 btn-primary text-end fw-medium">Lihat
                        Semua <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
        {{-- Tabel Pesan --}}
        <div class="card rounded-8 mt-3">
            <div class="card-body">
                <h4 class="mb-3 fw-medium text-dark">Tabel Pesan</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-light text-dark">
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Pesan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($get_pesan as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->nm_lengkap }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{!! Str::limit($item->pesan, 90) !!}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" align="center">Data masih kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-md-flex align-items-center justify-content-end">
                    <a href="{{ route('be.pesan.list') }}" class="rounded-8 btn fs-7 btn-primary text-end fw-medium">Lihat
                        Semua <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection
