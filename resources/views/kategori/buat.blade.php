@extends('layout.app')

@section('konten')
<div class="container">
    <h2>Menambah Kategori Barang</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (Session::has('status'))
    <div class="alert alert-success">
        <p>{{ Session::get('status') }}</p>
    </div>
    @endif
    <form action="{{ url('kategori') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="nama_kategori">
                    Nama Kategori
                </label>
                <input class="form-control" type="text" name="nama_kategori" id="namakategori">
            </div>
        </div>
    </form>
</div>
@endsection

