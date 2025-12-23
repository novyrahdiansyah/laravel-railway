@extends('layouts.app')

@section('content')
<h3 class="mb-3">Tambah User</h3>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="/user">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="admin">Admin</option>
                    <option value="kasir">Kasir</option>
                    <option value="manager">Manager</option>
                </select>
            </div>

            <button class="btn btn-success">Simpan</button>
            <a href="/user" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
