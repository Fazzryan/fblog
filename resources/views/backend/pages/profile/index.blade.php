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
        <div class="col-12">
            @include('backend.layouts.app_session')
        </div>
    </div>
    <div class="row about">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    @if ($profile == null)
                        <p>Belum ada profil.</p>
                    @else
                        <dl class="row">
                            <dd class="col-sm-12 text-center">
                                @if ($profile->foto == null)
                                    <p>Belum ada foto</p>
                                @else
                                    <img src="{{ asset('assets/be/images/pic/') . '/' . $profile->foto }}" alt="profile"
                                        class="img-profile">
                                @endif
                            </dd>

                            <dt class="col-sm-4 fw-medium">Nama Depan</dt>
                            <dd class="col-sm-8">{{ $profile->nm_depan }}</dd>

                            <dt class="col-sm-4 fw-medium">Nama Belakang</dt>
                            <dd class="col-sm-8">{{ $profile->nm_belakang }}</dd>

                            <dt class="col-sm-4 fw-medium">Youtube</dt>
                            <dd class="col-sm-8">{{ $profile->youtube }}</dd>

                            <dt class="col-sm-4 fw-medium">Instagram</dt>
                            <dd class="col-sm-8">{{ $profile->instagram }}</dd>

                            <dt class="col-sm-4 fw-medium">Github</dt>
                            <dd class="col-sm-8">{{ $profile->github }}</dd>
                        </dl>
                    @endif
                    <button type="button" class="btn btn-primary rounded-6" data-bs-toggle="modal"
                        data-bs-target="#edit_profile">Ubah Profile</button>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    @if ($profile == null)
                        <p>Belum ada profil.</p>
                    @else
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="add-username" name="username"
                                        value="{{ $profile->username }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="pass" class="form-label">Password</label>
                                    <input type="text" class="form-control" id="add-pass" name="pass"
                                        value="{{ $profile->pass }}" readonly>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-primary rounded-6" data-bs-toggle="modal"
                                    data-bs-target="#ubah_pw">Ubah Password</button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Edit Data edit_profile --}}
        <div id="edit_profile" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-8">
                    <div class="modal-header">
                        <h4 class="modal-title" id="edit_data_label">Ubah Profile</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('be.profile.act_edit_profile') }}" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-body">
                                <input type="hidden" id="edt-id_user" class="edt-id_user" name="id_user" value="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Nama Depan</label>
                                            <input type="text" id="edt-nm_depan" name="nm_depan" class="form-control"
                                                value="{{ old('nm_depan') }}" placeholder="Masukan Nama Depan" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Nama Belakang</label>
                                            <input type="text" id="edt-nm_belakang" name="nm_belakang"
                                                class="form-control" value="{{ old('nm_belakang') }}"
                                                placeholder="Masukan Nama Belakang" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Profile</label>
                                            <input type="file" id="edt-gambar" name="gambar" class="form-control"
                                                accept="image/*" onchange="gantiGambar()">
                                            <input type="hidden" id="edt-old_image" name="old_image"
                                                class="form-control" value="">
                                            {{-- @if ($profile->foto != null)
                                                <p>belum</p>
                                            @else
                                                <img src="{{ asset('assets/be/images/pic/') . '/' . $profile->foto }}"
                                                    alt="profile" width="100" class="mt-3">
                                            @endif --}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Youtube</label>
                                            <input type="text" id="edt-youtube" name="youtube" class="form-control"
                                                value="{{ old('youtube') }}" placeholder="Masukan Link Youtube" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Instagram</label>
                                            <input type="text" id="edt-instagram" name="instagram"
                                                class="form-control" value="{{ old('instagram') }}"
                                                placeholder="Masukan Link Instagram" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Github</label>
                                            <input type="text" id="edt-github" name="github" class="form-control"
                                                value="{{ old('github') }}" placeholder="Masukan Link Github" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-info rounded-6">
                                        {{ $profile != null ? 'Update' : 'Tambah' }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> {{-- modal content --}}
            </div>{{-- modal dialog --}}
        </div>{{-- modal --}}

        {{-- Edit Data Auth --}}
        <div id="ubah_pw" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-8">
                    <div class="modal-header">
                        <h4 class="modal-title" id="edit_data_label">Ubah Username/Password</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('be.profile.act_edit_auth') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-body">
                                <input type="hidden" id="edt-id_user" class="edt-id_user" name="id_user"
                                    value="">
                                <label class="form-label">Username</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <input type="text" id="edt-username" name="username" class="form-control"
                                                value="{{ old('username') }}" placeholder="Masukan Username" required>
                                        </div>
                                    </div>
                                </div>
                                <label class="form-label">Password</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <input type="text" id="edt-pass" name="pass" class="form-control"
                                                value="{{ old('pass') }}" placeholder="Masukan Password" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-info rounded-6">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> {{-- modal content --}}
            </div>{{-- modal dialog --}}
        </div>{{-- modal --}}
    </div>
@endsection
@push('js')
    <!--This page plugins -->
    <script>
        @if ($profile != null)
            $('#edt-nm_depan').val("{{ $profile->nm_depan }}")
            $('#edt-nm_belakang').val("{{ $profile->nm_belakang }}")
            $('#edt-youtube').val("{{ $profile->youtube }}")
            $('#edt-instagram').val("{{ $profile->instagram }}")
            $('#edt-github').val("{{ $profile->github }}")

            $('.edt-id_user').val("{{ $profile->id_user }}")
            $('#edt-username').val("{{ $profile->username }}")
            $('#edt-pass').val("{{ $profile->pass }}")
        @else
            $('.edt-id_user').val("{{ session()->get('user_session')['id_user'] }}")
        @endif

        function gantiGambar() {
            $("#edt-old_image").val("gantiGambar");
        }
    </script>
@endpush
