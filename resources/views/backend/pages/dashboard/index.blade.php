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
            <div class="card border-end">
                <div class="card-body">
                    @include('backend.layouts.app_session')
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ad exercitationem facere omnis molestias totam
                    harum qui tenetur quia similique veritatis, ab odit eius inventore reprehenderit culpa vero adipisci
                    ullam vitae ipsum illo soluta debitis! Soluta eaque totam atque nihil. Ratione hic, molestiae a minima
                    modi amet sed voluptate adipisci suscipit fugiat, quibusdam repellat impedit maxime nemo, molestias
                    nobis quisquam cupiditate natus harum quam officia. Aliquid quas aperiam consequuntur autem distinctio
                    iste quos tempore rerum accusantium iure. Amet pariatur voluptas tenetur suscipit repellendus voluptates
                    placeat culpa, cum doloremque praesentium voluptate non in nesciunt eos? Nesciunt dicta sit, totam
                    libero nobis ut?
                </div>
            </div>
        </div>
    </div>
@endsection
