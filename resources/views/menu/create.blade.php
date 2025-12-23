@extends('layouts.app')

@section('content')
<h3>Tambah Menu</h3>

<form method="POST" action="/menu" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
    <label class="form-label">Gambar Menu</label>
    <input type="file" name="gambar" class="form-control">
</div>


    <div class="mb-3">
        <label class="form-label">Nama Menu</label>
        <input type="text" name="nama_menu" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Harga</label>
        <input type="number" name="harga" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-control"></textarea>
    </div>

    <button class="btn btn-success">Simpan</button>
    <a href="/menu" class="btn btn-secondary">Kembali</a>
</form>
@endsection
