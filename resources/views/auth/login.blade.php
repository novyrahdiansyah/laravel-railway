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
                    Sistem Informasi Penjualan
                </p>
            </div>

            {{-- ERROR --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- FORM LOGIN --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-group mb-3">
    <span class="input-group-text bg-light">
        <i class="bi bi-envelope-fill text-success"></i>
    </span>
    <input type="email"
           name="email"
           class="form-control"
           placeholder="email@example.com"
           required autofocus>
</div>


<div class="input-group mb-3">
    <span class="input-group-text bg-light">
        <i class="bi bi-lock-fill text-success"></i>
    </span>
    <input type="password"
           name="password"
           class="form-control"
           placeholder="••••••••"
           required>
</div>


                <div class="d-grid mt-4">
                    <button class="btn btn-success">
                        Login
                    </button>
                </div>
                <div class="text-center mt-3">
    <small class="text-muted">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-success fw-semibold">
            Daftar di sini
        </a>
    </small>
</div>

            </form>

            {{-- FOOTER --}}
            <div class="text-center mt-4">
                <small class="text-muted">
                    © {{ date('Y') }} Rumah Makan
                </small>
            </div>
        </div>
    </div>
</div>
@endsection
