@if ($errors->any())
    <div class="alert alert-danger alert-dismissible border-0 fade show" role="alert">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif(\Session::has('success'))
    <div class="alert alert-success alert-dismissible border-0 fade show" role="alert">
        <strong>Berhasil - </strong> {!! \Session::get('success') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif(\Session::has('failed'))
    <div class="alert alert-danger alert-dismissible border-0 fade show" role="alert">
        <strong>Gagal - </strong> {!! \Session::get('failed') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
