@extends('layouts.app')

@section('content')
<h3>Data Menu</h3>
<p class="text-muted">Daftar menu makanan yang tersedia</p>

<a href="/menu/create" class="btn btn-primary btn-sm mb-3">+ Tambah Menu</a>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th width="140">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @forelse($menus as $i => $m)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $m->nama_menu }}</td>
                    <td>Rp {{ number_format($m->harga,0,',','.') }}</td>
                    <td>{{ $m->deskripsi }}</td>
                    <td>
                        <a href="/menu/{{ $m->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                        <form action="/menu/{{ $m->id }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus menu?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        Data menu belum ada
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
