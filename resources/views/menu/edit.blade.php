@extends('layouts.app')

@section('content')
<h3>Edit Menu</h3>

<form action="/menu/{{ $menu->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')


    <div class="mb-3">
    <label class="form-label">Gambar Menu</label>
    <input type="file" name="gambar" class="form-control">

    @if($menu->gambar)
        <img src="{{ asset('storage/'.$menu->gambar) }}"
             width="120"
             class="mt-2 rounded">
    @endif
</div>


    <div class="mb-3">
        <label class="form-label">Nama Menu</label>
        <input type="text" name="nama_menu" value="{{ $menu->nama_menu }}" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Harga</label>
        <input type="number" name="harga" value="{{ $menu->harga }}" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-control">{{ $menu->deskripsi }}</textarea>
    </div>

    <button class="btn btn-warning">Update</button>
</form>
@endsection
