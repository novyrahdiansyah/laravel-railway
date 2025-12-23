@extends('layouts.app')

@section('content')
<h3>Manajemen User</h3>
<p class="text-muted">Pengelolaan akun pengguna sistem</p>

<a href="/user/create" class="btn btn-primary btn-sm mb-3">
    + Tambah User
</a>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th width="140">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $i => $u)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>
                        <span class="badge bg-secondary">{{ strtoupper($u->role) }}</span>
                    </td>
                    <td>
                        <a href="/user/{{ $u->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                        @if(auth()->id() != $u->id)
                        <form action="/user/{{ $u->id }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus user?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
