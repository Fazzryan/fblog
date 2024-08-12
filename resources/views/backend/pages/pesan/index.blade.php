@extends('backend.layouts.app_main')
@push('meta-seo')
    <title>Fazzblog - Pesan</title>
    <meta content="Halaman Pesan" name="description">
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
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Halaman Pesan</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('be.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Pesan</li>
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

                    <div class="table-responsive mt-4">
                        <table id="tbl_pesan" class="table border table-striped table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th width="5">No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Pesan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($get_pesan as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td class="text-capitalized">{{ $item->nm_lengkap }}</td>
                                        <td class="text-capitalized">{{ $item->email }}</td>
                                        <td class="">{{ Str::limit($item->pesan, 70, '...') }}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success rounded-6"
                                                data-bs-toggle="modal" data-bs-target="#lihat_pesan"
                                                onclick="lihat_pesan({{ $item->id }})">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger rounded-6"
                                                data-bs-toggle="modal" data-bs-target="#delete_pesan"
                                                onclick="delete_pesan({{ $item->id }})">
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

            {{-- lihat pesan --}}
            <div id="lihat_pesan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-8">
                        <div class="modal-header">
                            <h5 class="modal-title fw-medium text-dark">
                                Dari :
                                <span id="view-nm_lengkap"></span>,
                                <span id="view-email" class="fst-italic"></span>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label fw-medium">Pesan</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <textarea id="view-pesan" class="form-control" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> {{-- modal content --}}
                </div>{{-- modal dialog --}}
            </div>{{-- modal --}}

            {{-- Hapus Data --}}
            <div id="delete_pesan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content modal-filled bg-dark rounded-6">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <h4 class="mt-2">Yakin Hapus Pesan?</h4>
                                <p class="mt-3">Data yang telah dihapus tidak bisa dikembalikan!</p>
                                <form action="{{ route('be.pesan.act_delete_pesan') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="hps-id_pesan" name="id_pesan" value="">
                                    <button type="button" class="btn btn-light my-2 rounded-6"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger my-2 rounded-6"
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
        $('#tbl_pesan').DataTable({
            "language": {
                "emptyTable": "Data Pesan Masih Kosong."
            }
        });
    </script>
    <script>
        // Lihat pesan
        function lihat_pesan(id) {
            @foreach ($get_pesan as $val)
                if (id == "{{ $val->id }}") {
                    $("#view-nm_lengkap ").text("{{ $val->nm_lengkap }}");
                    $("#view-email ").text("{{ $val->email }}");
                    $("#view-pesan ").val("{{ $val->pesan }}");
                }
            @endforeach
        }
        // Delete Kategori
        function delete_pesan(id) {
            $("#hps-id_pesan").val(id);
        }
    </script>
@endpush
