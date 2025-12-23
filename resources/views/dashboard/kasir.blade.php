@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">Dashboard Kasir</h3>
        <small class="text-muted">
            {{ now()->format('l, d F Y') }}
        </small>
    </div>

    <span class="badge bg-success px-3 py-2">
        {{ auth()->user()->name }} (Kasir)
    </span>
</div>

{{-- RINGKASAN --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6 class="text-uppercase small text-muted">
                    <i class="bi bi-receipt me-1"></i>
                    Transaksi Hari Ini
                </h6>
                <h3 class="fw-bold">
                    {{ \App\Models\Transaksi::whereDate('created_at', today())->count() }}
                </h3>
            </div>
        </div>
    </div>
</div>

{{-- DAFTAR MENU --}}
<form action="/transaksi/checkout" method="POST">
@csrf

<div class="row g-3">
@foreach(\App\Models\Menu::all() as $menu)
    <div class="col-md-3">
        <div class="card h-100 shadow-sm border-0">
            <img src="{{ $menu->gambar
                ? asset('storage/'.$menu->gambar)
                : 'https://via.placeholder.com/300x200' }}"
                 class="card-img-top"
                 style="height:150px; object-fit:cover;">

            <div class="card-body d-flex flex-column">
                <h6 class="fw-bold mb-1">{{ $menu->nama_menu }}</h6>
                <small class="text-muted mb-2">
                    {{ $menu->deskripsi ?? '-' }}
                </small>

                <strong class="mb-2 text-success">
                    Rp {{ number_format($menu->harga,0,',','.') }}
                </strong>

                <input type="number"
                       name="items[{{ $menu->id }}]"
                       class="form-control form-control-sm mt-auto"
                       placeholder="Qty"
                       min="0">
            </div>
        </div>
    </div>
@endforeach
</div>

{{-- CHECKOUT BAR --}}
<div class="position-sticky bottom-0 bg-white border-top mt-4 py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <span class="text-muted">
            Pilih menu lalu checkout
        </span>

        <button class="btn btn-success px-4">
            <i class="bi bi-cart-check me-1"></i>
            Checkout
        </button>
    </div>
</div>

</form>

@endsection
