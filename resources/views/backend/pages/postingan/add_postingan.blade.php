@extends('backend.layouts.app_main')
@push('meta-seo')
    <title>Fazzblog - Tambah Postingan</title>
    <meta content="Halaman Tambah Postingan" name="description">
    <meta content="Dinda Fazryan" name="author">
    <meta content="fblog" name="keywords">
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
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Halaman Postingan</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('be.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('be.postingan.list') }}">Postingan</a>
                            </li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Tambah Postingan</li>
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
            <div class="card">
                <div class="card-body">
                    @include('backend.layouts.app_session')

                    <div class="mb-3">
                        <a href="{{ route('be.postingan.list') }}" class="btn btn-primary">Kembali</a>
                    </div>
                    <form action="{{ route('be.postingan.act_add_postingan') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="add-title" class="form-label">Judul</label>
                                    <input type="text" id="add-title" name="title" class="form-control"
                                        placeholder="Masukan Judul Postingan" value="{{ old('title') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="add-id_kategori" class="form-label">Kategori</label>
                                    <select class="selectpicker form-select form-control" id="add-id_kategori"
                                        name="id_kategori" data-style="select-with-transition" data-live-search="true"
                                        data-size="7">
                                        {{-- @foreach ($get_jenis_kelamin as $val_jk)
                                            <option value="{{ $val_jk['id'] }}" @selected(old('jenis_kelamin') == $val_jk['id'])>
                                                {{ $val_jk['val'] }}</option>
                                        @endforeach --}}
                                        @foreach ($get_kategori as $item)
                                            <option value="{{ $item->id }}">{{ $item->nm_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="add-slug" class="form-label">Slug</label>
                                    <input type="text" id="add-slug" name="slug" class="form-control"
                                        placeholder="Masukan Slug" value="{{ old('slug') }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="add-image" class="form-label">Gambar</label>
                                    <input type="file" id="add-image" name="image" class="form-control"
                                        accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="editor" class="form-label">Konten</label>
                                <textarea name="content" id="editor" cols="30" rows="30">{{ old('content') }}</textarea>
                            </div>
                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-primary">Tambah Postingan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <!--This page plugins -->
    <script src="{{ asset('assets/be/extra-libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/be/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/be/libs/selectpicker/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/be/vendor/ckeditor.js') }}" type="text/javascript"></script>
    <script>
        $('#tbl_postingan').DataTable({
            "language": {
                "emptyTable": "Data Postingan Masih Kosong."
            }
        });
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                window.editor = editor;
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        getSlug('#add-title', '#add-slug');
        // Membuat Slug
        function getSlug(input, output) {
            $(input).keyup(function() {
                var nm_input = $(input).val();
                var lower = nm_input.replace(/\s+/g, '-').toLowerCase();;
                $(output).val(lower);
            });
        }
        // Edit Kategori
    </script>
@endpush
