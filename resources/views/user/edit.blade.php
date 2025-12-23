@extends('layouts.app')

@section('content')
<h3 class="mb-3">Edit User</h3>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="/user/{{ $user->id }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="name" class="form-control"
                       value="{{ $user->name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                       value="{{ $user->email }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-select">
                    <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
                    <option value="kasir" {{ $user->role=='kasir'?'selected':'' }}>Kasir</option>
                    <option value="manager" {{ $user->role=='manager'?'selected':'' }}>Manager</option>
                </select>
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="/user" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
