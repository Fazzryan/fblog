@extends('backend.layouts.app_main')
@push('meta-seo')
    <title>Fazzblog - Kategori</title>
    <meta content="Halaman Kategori" name="description">
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
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Halaman Kategori</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('be.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Kategori</li>
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
                    <div class="mb-4">
                        <button type="button" class="btn btn-primary rounded-6" data-bs-toggle="modal"
                            data-bs-target="#tambah_kategori">Tambah
                            Kategori</button>
                    </div>
                    <div class="table-responsive">
                        <table id="tbl_kategori" class="table border table-striped table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Jumlah Postingan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($get_kategori as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->nm_kategori }}</td>
                                        <td>{{ $item->jml }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success rounded-6"
                                                data-bs-toggle="modal" data-bs-target="#edit_kategori"
                                                onclick="edit_kategori({{ $item->id }})">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger rounded-6"
                                                data-bs-toggle="modal" data-bs-target="#delete_kategori"
                                                onclick="delete_kategori({{ $item->id }})">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Tambah Data --}}
            <div id="tambah_kategori" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-8">
                        <div class="modal-header">
                            <h4 class="modal-title" id="tambah_data_label">Tambah Kategori Baru</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('be.kategori.act_add_kategori') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-body">
                                    <label class="form-label">Nama Kategori</label>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <input type="text" id="add-nm_kategori" name="nm_kategori"
                                                    class="form-control" value="{{ old('nm_kategori') }}"
                                                    placeholder="Masukan Nama Kategori" required>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="form-label">Slug</label>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <input type="text" id="add-slug" name="slug" class="form-control"
                                                    value="{{ old('slug') }}" placeholder="Masukan Slug" required
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary rounded-6">Tambah</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>

            {{-- Edit Data --}}
            <div id="edit_kategori" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-8">
                        <div class="modal-header">
                            <h4 class="modal-title" id="edit_data_label">Edit Kategori</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('be.kategori.act_edit_kategori') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-body">
                                    <input type="hidden" id="edt-id_kategori" name="id_kategori" value="">
                                    <label class="form-label">Nama Kategori</label>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <input type="text" id="edt-nm_kategori" name="nm_kategori"
                                                    class="form-control" value="{{ old('nm_kategori') }}"
                                                    placeholder="Masukan Nama Kategori" required>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="form-label">Slug</label>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <input type="text" id="edt-slug" name="slug" class="form-control"
                                                    value="{{ old('slug') }}" placeholder="Masukan Slug" required
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary rounded-6">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> {{-- modal content --}}
                </div>{{-- modal dialog --}}
            </div>{{-- modal --}}

            {{-- Hapus Data --}}
            <div id="delete_kategori" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content modal-filled bg-dark rounded-8">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <h4 class="mt-2">Yakin Hapus Data Kategori?</h4>
                                <p class="mt-3">Data yang telah dihapus tidak bisa dikembalikan!</p>
                                <form action="{{ route('be.kategori.act_delete_kategori') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="hps-id_kategori" name="id_kategori" value="">
                                    <button type="button" class="btn btn-light rounded-6 my-2"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger rounded-6 my-2"
                                        data-bs-dismiss="modal">Yakin</button>
                                </form>
                            </div>
                        </div>
                    </div> {{-- modal content --}}
                </div>{{-- modal dialog --}}
            </div>{{-- modal --}}
        </div>
    </div>
@endsection

@push('js')
    <!--This page plugins -->
    <script src="{{ asset('assets/be/extra-libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/be/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js') }}"></script>

    <script>
        $('#tbl_kategori').DataTable({
            "language": {
                "emptyTable": "Data Kategori Masih Kosong."
            }
        });
    </script>

    <script>
        getSlug('#add-nm_kategori', '#add-slug');
        getSlug('#edt-nm_kategori', '#edt-slug');
        // Membuat Slug
        function getSlug(input, output) {
            $(input).keyup(function() {
                var nm_input = $(input).val();
                var lower = nm_input.replace(/\s+/g, '-').toLowerCase();;
                $(output).val(lower);
            });
        }
        // Edit Kategori
        function edit_kategori(id) {
            @foreach ($get_kategori as $val)
                if (id == "{{ $val->id }}") {
                    $("#edt-id_kategori ").val("{{ $val->id }}");
                    $("#edt-nm_kategori ").val("{{ $val->nm_kategori }}");
                    $("#edt-slug ").val("{{ $val->slug }}");
                }
            @endforeach
        }

        // Delete Kategori
        function delete_kategori(id) {
            $("#hps-id_kategori").val(id);
        }
    </script>
@endpush
