@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold">Dashboard Admin</h3>
        <small class="text-muted">
    {{ now()->format('l, d F Y') }}
</small>

        <p class="text-muted mb-0">
           
        </p>
    </div>

    <span class="badge bg-success px-3 py-2">
        {{ auth()->user()->name }} (Admin)
    </span>
</div>


{{-- STAT CARDS --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-primary text-white">
            <div class="card-body">
                <h6 class="text-uppercase">Total Menu</h6>
                <h2>{{ \App\Models\Menu::count() }}</h2>
                <small>Data menu tersedia</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-success text-white">
            <div class="card-body">
                <h6 class="text-uppercase">Total Transaksi</h6>
                <h2>{{ \App\Models\Transaksi::count() }}</h2>
                <small>Seluruh transaksi</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-warning text-dark">
            <div class="card-body">
                <h6 class="text-uppercase">Pendapatan</h6>
                <h4>
                    Rp {{ number_format(\App\Models\Transaksi::sum('total_harga'),0,',','.') }}
                </h4>
                <small>Total penjualan</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-dark text-white">
            <div class="card-body">
                <h6 class="text-uppercase">Total User</h6>
                <h2>{{ \App\Models\User::count() }}</h2>
                <small>Akun terdaftar</small>
            </div>
        </div>
    </div>
</div>

{{-- QUICK ACTION --}}
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="mb-3">Aksi Cepat</h5>
                <a href="/menu/create" class="btn btn-primary btn-sm me-2">
                    + Tambah Menu
                </a>
                <a href="/transaksi" class="btn btn-success btn-sm me-2">
                    Lihat Transaksi
                </a>
                <a href="/user" class="btn btn-dark btn-sm">
                    Kelola User
                </a>
            </div>
        </div>
    </div>
</div>

{{-- TRANSAKSI TERAKHIR --}}
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="mb-3">Transaksi Terakhir</h5>

                <table class="table table-sm table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Menu</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(\App\Models\Transaksi::with('items.menu')->latest()->take(5)->get() as $i => $t)
                            @php
                                $menuNames = $t->items
                                    ->map(fn($item) => $item->menu->nama_menu ?? null)
                                    ->filter();

                                $shown = $menuNames->take(2);
                                $sisa  = $menuNames->count() - $shown->count();
                            @endphp

                            <tr>
                                <td>{{ $i + 1 }}</td>

                                <td>
                                    {{ $shown->implode(', ') }}
                                    @if($sisa > 0)
                                        (+{{ $sisa }})
                                    @endif
                                </td>

                                <td>{{ $t->items->sum('jumlah') }}</td>

                                <td>
                                    Rp {{ number_format($t->total_harga,0,',','.') }}
                                </td>

                                <td>{{ $t->created_at->format('d-m-Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    Belum ada transaksi
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
