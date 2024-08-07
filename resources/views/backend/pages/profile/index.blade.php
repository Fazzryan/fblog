@extends('backend.layouts.app_main')
@push('meta-seo')
    <title>Fazzblog - Profile</title>
    <meta content="Halaman Profile" name="description">
    <meta content="Dinda Fazryan" name="author">
    <meta content="fazzblog" name="keywords">
@endpush
@push('custom-css')
    <!-- This page plugin CSS -->
    <link rel="stylesheet" href="{{ asset('assets/be/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/be/extra-libs/datatables.net-bs4/css/responsive.dataTables.min.css') }}">
@endpush
@push('bread_crumb')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Halaman Profile</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('be.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Profile</li>
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
        @include('backend.layouts.app_session')
        <div class="col-md-6">
            <div class="card">

                <div class="card-body">

                    <dl class="row">
                        <dt class="col-sm-4">Foto Profile</dt>
                        <dd class="col-sm-8">
                            <img src="" alt="profile" class="img-fluid rounded-circle">
                        </dd>

                        <dt class="col-sm-4">Username</dt>
                        <dd class="col-sm-8">
                            <div class="text-capitalized">{{ $profile->username }}</div>
                        </dd>

                        <dt class="col-sm-4">Nama Depan</dt>
                        <dd class="col-sm-8">{{ $profile->nm_depan }}</dd>

                        <dt class="col-sm-4">Nama Belakang</dt>
                        <dd class="col-sm-8">{{ $profile->nm_belakang }}</dd>

                        <dt class="col-sm-4">Youtube</dt>
                        <dd class="col-sm-8">{{ $profile->youtube }}</dd>

                        <dt class="col-sm-4">Instagram</dt>
                        <dd class="col-sm-8">{{ $profile->instagram }}</dd>

                        <dt class="col-sm-4">Github</dt>
                        <dd class="col-sm-8">{{ $profile->github }}</dd>

                    </dl>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <img src="" alt="profile" class="img-fluid rounded-circle">
                <div class="card-body">

                </div>
            </div>
        </div>
    @endsection
    @push('js')
        <!--This page plugins -->
        <script>
            // Delete Kategori
            function edit_profile(id) {}
        </script>
    @endpush
