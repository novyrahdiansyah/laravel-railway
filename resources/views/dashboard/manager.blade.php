@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">Dashboard Manager</h3>
        <small class="text-muted">
            Monitoring Penjualan • {{ now()->format('d F Y') }}
        </small>
    </div>

    <span class="badge bg-primary px-3 py-2">
        {{ auth()->user()->name }} (Manager)
    </span>
</div>

{{-- STAT CARDS --}}
<div class="row g-3 mb-4">

    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-receipt fs-4 text-primary me-2"></i>
                    <span class="text-muted small">Transaksi Hari Ini</span>
                </div>
                <h2 class="fw-bold mb-0">
                    {{ \App\Models\Transaksi::whereDate('created_at', today())->count() }}
                </h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-cash-stack fs-4 text-success me-2"></i>
                    <span class="text-muted small">Pendapatan Hari Ini</span>
                </div>
                <h4 class="fw-bold text-success mb-0">
                    Rp {{ number_format(
                        \App\Models\Transaksi::whereDate('created_at', today())->sum('total_harga'),
                        0, ',', '.'
                    ) }}
                </h4>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-calendar-month fs-4 text-warning me-2"></i>
                    <span class="text-muted small">Pendapatan Bulan Ini</span>
                </div>
                <h4 class="fw-bold mb-0">
                    Rp {{ number_format(
                        \App\Models\Transaksi::whereMonth('created_at', now()->month)
                            ->whereYear('created_at', now()->year)
                            ->sum('total_harga'),
                        0, ',', '.'
                    ) }}
                </h4>
            </div>
        </div>
    </div>

</div>

{{-- MENU TERLARIS --}}
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <h6 class="fw-bold mb-3">
            <i class="bi bi-star-fill text-warning me-1"></i>
            Menu Terlaris
        </h6>

        <table class="table table-sm align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Menu</th>
                    <th class="text-end">Terjual</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $menuTerlaris = \App\Models\TransaksiItem::with('menu')
                        ->selectRaw('menu_id, SUM(jumlah) as total')
                        ->groupBy('menu_id')
                        ->orderByDesc('total')
                        ->take(3)
                        ->get();
                @endphp

                @forelse($menuTerlaris as $item)
                    <tr>
                        <td>{{ $item->menu->nama_menu ?? 'Menu tidak tersedia' }}</td>
                        <td class="text-end fw-semibold">{{ $item->total }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center text-muted">
                            Belum ada data
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- RIWAYAT TRANSAKSI --}}
<div class="card shadow-sm border-0">
    <div class="card-body">
        <h6 class="fw-bold mb-3">
            <i class="bi bi-clock-history me-1"></i>
            Riwayat Transaksi Terakhir
        </h6>

        <table class="table table-sm table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse(\App\Models\Transaksi::latest()->take(5)->get() as $t)
                    <tr>
                        <td>{{ $t->created_at->format('d-m-Y') }}</td>
                        <td>Rp {{ number_format($t->total_harga,0,',','.') }}</td>
                        <td>
                            @if($t->status == 'selesai')
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-warning text-dark">Pending</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">
                            Belum ada transaksi
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
