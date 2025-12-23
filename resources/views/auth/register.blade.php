@extends('layouts.auth')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height:80vh;">
<div class="card shadow-lg border-0 bg-white"
 style="max-width:420px; width:100%;">
        <div class="card-body p-4">

            {{-- LOGO / BRAND --}}
            <div class="text-center mb-4">
                <h2 class="fw-bold text-success">🍽 Rumah Makan</h2>
                <p class="text-muted small">
                    Registrasi Akun
                </p>
            </div>

            {{-- ERROR --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- FORM REGISTER --}}
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="input-group mb-3">
    <span class="input-group-text bg-light">
        <i class="bi bi-person-fill text-success"></i>
    </span>
    <input type="text"
           name="name"
           class="form-control"
           placeholder="Nama lengkap"
           required>
</div>


<div class="input-group mb-3">
    <span class="input-group-text bg-light">
        <i class="bi bi-envelope-fill text-success"></i>
    </span>
    <input type="email"
           name="email"
           class="form-control"
           placeholder="email@example.com"
           required>
</div>


<div class="input-group mb-3">
    <span class="input-group-text bg-light">
        <i class="bi bi-lock-fill text-success"></i>
    </span>
    <input type="password"
           name="password"
           class="form-control"
           placeholder="Password"
           required>
</div>


<div class="input-group mb-3">
    <span class="input-group-text bg-light">
        <i class="bi bi-shield-lock-fill text-success"></i>
    </span>
    <input type="password"
           name="password_confirmation"
           class="form-control"
           placeholder="Konfirmasi password"
           required>
</div>


                <div class="d-grid mt-4">
                    <button class="btn btn-success">
                        Daftar
                    </button>
                </div>
            </form>

            {{-- FOOTER --}}
            <div class="text-center mt-3">
                <small class="text-muted">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-success fw-semibold">
                        Login di sini
                    </a>
                </small>
            </div>

        </div>
    </div>
</div>
@endsection
