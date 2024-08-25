@extends('backend.layouts.app_main')
@push('meta-seo')
    <title>Fazzblog - Postingan</title>
    <meta content="Halaman Postingan" name="description">
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
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Halaman Postingan</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('be.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Postingan</li>
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
                        <a href="{{ route('be.postingan.add') }}" class="btn btn-primary rounded-6">Tambah Postingan</a>
                    </div>
                    <div class="table-responsive">
                        <table id="tbl_postingan" class="table border table-striped table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($get_postingan as $key => $item)
                                    @php
                                        $id = base64_encode($item->id);
                                        $id_postingan = "'" . $id . "'";
                                    @endphp
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td width="5">
                                            <img src="{{ asset('assets/be/images/icons') . '/' . $item->image }}"
                                                style="border-radius:
                                                    6px;width:65px;height:45px; object-fit:cover;" />
                                        </td>
                                        <td class="text-capitalized">{{ Str::limit($item->title, 90, '...') }}
                                        </td>
                                        <td class="text-capitalized text-wrap">{{ $item->nm_kategori }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success rounded-6"
                                                onclick="edit_postingan({{ $item->id }})">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger rounded-6"
                                                data-bs-toggle="modal" data-bs-target="#delete_postingan"
                                                onclick="delete_postingan({{ $item->id }})">
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

            {{-- Hapus Data --}}
            <div id="delete_postingan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content modal-filled bg-dark rounded-6">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <h4 class="mt-2">Yakin Hapus Data postingan?</h4>
                                <p class="mt-3">Data yang telah dihapus tidak bisa dikembalikan!</p>
                                <form action="{{ route('be.postingan.act_delete_postingan') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="hps-id_postingan" name="id_postingan" value="">
                                    <button type="button" class="btn btn-light my-2 rounded-6"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger my-2 rounded-6"
                                        data-bs-dismiss="modal">Yakin</button>
                                </form>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
    </div>
@endsection
@push('js')
    <!--This page plugins -->
    <script src="{{ asset('assets/be/extra-libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/be/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js') }}"></script>
    <script>
        $('#tbl_postingan').DataTable({
            "language": {
                "emptyTable": "Data Postingan Masih Kosong."
            }
        });
    </script>

    <script>
        function edit_postingan(id) {
            window.location.replace("{{ route('be.postingan.edit') }}" + "/" + btoa(id));
        }

        function delete_postingan(id) {
            $("#hps-id_postingan").val(id);
        }
    </script>
@endpush
