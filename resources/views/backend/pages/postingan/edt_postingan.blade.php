@extends('backend.layouts.app_main')
@push('meta-seo')
    <title>Fazzblog - Edit Postingan</title>
    <meta content="Halaman Edit Postingan" name="description">
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
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Halaman Postingan</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('be.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('be.postingan.list') }}">Postingan</a>
                            </li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Edit Postingan</li>
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
                    <form action="{{ route('be.postingan.act_edit_postingan') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="mb-3">
                                    <input type="hidden" id="edt_id_postingan" name="id_postingan"
                                        value="{{ $get_postingan->id }}">
                                    <label for="edt-title" class="form-label">Judul</label>
                                    <input type="text" id="edt-title" name="title" class="form-control"
                                        placeholder="Masukan Judul Postingan" value="{{ $get_postingan->title }}">
                                </div>
                                <div class="mb-3">
                                    <label for="edt-id_kategori" class="form-label">Kategori</label>
                                    <select class="selectpicker form-select form-control" id="edt-id_kategori"
                                        name="id_kategori" data-style="select-with-transition" data-live-search="true"
                                        data-size="7">
                                        @foreach ($get_kategori as $item)
                                            <option value="{{ $item->id }}" @selected($get_postingan->id_kategori == $item->id)>
                                                {{ $item->nm_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="edt-slug" class="form-label">Slug</label>
                                    <input type="text" id="edt-slug" name="slug" class="form-control"
                                        placeholder="Masukan Slug" value="{{ $get_postingan->slug }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="edt-image" class="form-label">Gambar</label>
                                    <input type="file" id="edt-image" name="image" class="form-control"
                                        accept="image/*" onchange="gantiGambar()">

                                    <input type="hidden" id="edt-old_image" name="old_image" class="form-control"
                                        value="">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label d-block" for="edt-img">Gambar Lama</label>
                                    <img id="edt-img"
                                        src="{{ asset('assets/be/images/icons/') . '/' . $get_postingan->image }}"
                                        width="90" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="editor" class="form-label">Konten</label>
                                <textarea name="content" id="editor" cols="30" rows="30">{!! $get_postingan->content !!}</textarea>
                            </div>
                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-primary">Update Postingan</button>
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
        getSlug('#edt-title', '#edt-slug');
        // Membuat Slug
        function getSlug(input, output) {
            $(input).keyup(function() {
                var nm_input = $(input).val();
                var lower = nm_input.replace(/\s+/g, '-').toLowerCase();;
                $(output).val(lower);
            });
        }

        function gantiGambar() {
            $("#edt-old_image").val("gantiGambar");
        }
    </script>
@endpush
