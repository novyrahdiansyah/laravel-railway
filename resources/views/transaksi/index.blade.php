@extends('layouts.app')

@section('content')
<h3>Data Transaksi</h3>
<p class="text-muted">Riwayat transaksi penjualan</p>

<a href="/dashboard" class="btn btn-primary mb-3">
    + Transaksi Baru
</a>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Menu</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th width="140">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($transaksis as $i => $t)
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

        <td>Rp {{ number_format($t->total_harga,0,',','.') }}</td>

        <td>
            @if($t->status == 'selesai')
                <span class="badge bg-success">Selesai</span>
            @else
                <span class="badge bg-warning text-dark">Pending</span>
            @endif
        </td>

        <td>
            @if($t->status == 'pending')
                <a href="/transaksi/{{ $t->id }}/bayar"
                   class="btn btn-success btn-sm mb-1">
                    Bayar
                </a>

                <a href="/transaksi/{{ $t->id }}/struk"
                   class="btn btn-secondary btn-sm mb-1">
                    Struk
                </a>

                <form action="/transaksi/{{ $t->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            @else
                <a href="/transaksi/{{ $t->id }}/struk"
                   class="btn btn-secondary btn-sm">
                    Struk
                </a>
            @endif
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center text-muted py-4">
            Belum ada transaksi
        </td>
    </tr>
@endforelse

            </tbody>
        </table>
    </div>
</div>
@endsection
