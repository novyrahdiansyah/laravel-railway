<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Informasi Rumah Makan</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/dashboard">🍽 Rumah Makan</a>

        <ul class="navbar-nav ms-auto align-items-center">
            @auth
                <span class="navbar-text text-white me-3">
                    {{ auth()->user()->name }} ({{ auth()->user()->role }})
                </span>

                @if(auth()->user()->role == 'admin')
                    <li class="nav-item"><a class="nav-link" href="/menu">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="/user">User</a></li>
                @endif

                @if(in_array(auth()->user()->role, ['admin','kasir']))
                    <li class="nav-item"><a class="nav-link" href="/transaksi">Transaksi</a></li>
                @endif

                <li class="nav-item ms-2">
                    <form method="POST" action="/logout">
                        @csrf
                        <button class="btn btn-danger btn-sm">Logout</button>
                    </form>
                </li>
            @endauth
        </ul>
    </div>
</nav>

<div class="container mt-5 pt-4">


    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Tombol kembali (kecuali dashboard) --}}
    @if(!request()->is('dashboard') && url()->previous() != url()->current())
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm mb-3">
            ← Kembali
        </a>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
