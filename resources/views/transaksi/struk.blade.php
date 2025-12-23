<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Transaksi</title>
    
    

    <style>
        .back-btn {
    display: inline-block;
    margin-top: 6px;
    font-size: 12px;
    text-decoration: none;
    color: #000;
}

@media print {
    button, .back-btn {
        display: none;
    }
}

        body {
            font-family: monospace;
            font-size: 13px;
            max-width: 280px;
            margin: auto;
            color: #000;
        }

        .center {
            text-align: center;
        }

        .line {
            border-top: 1px dashed #000;
            margin: 8px 0;
        }

        table {
            width: 100%;
        }

        td {
            padding: 2px 0;
            vertical-align: top;
        }

        .right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        @media print {
            button {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="center bold">
    🍽 RUMAH MAKAN
</div>
<div class="center">
    Jl. Contoh Alamat No. 123
</div>

<div class="line"></div>

<table>
    <tr>
        <td>Tanggal</td>
        <td class="right">{{ $transaksi->created_at->format('d-m-Y H:i') }}</td>
    </tr>
    <tr>
        <td>Kasir</td>
        <td class="right">{{ $transaksi->user->name ?? '-' }}</td>
    </tr>
    <tr>
        <td>Status</td>
        <td class="right bold">
            {{ strtoupper($transaksi->status) }}
        </td>
    </tr>
    <tr>
        <td>Bayar</td>
        <td class="right">
            {{ strtoupper($transaksi->metode_bayar ?? '-') }}
        </td>
    </tr>
</table>

<div class="line"></div>

<table>
@foreach($transaksi->items as $item)
    <tr>
        <td colspan="2">
            {{ $item->menu->nama_menu ?? 'Menu tidak tersedia' }}
        </td>
    </tr>
    <tr>
        <td>
            {{ $item->jumlah }} x
            Rp {{ number_format($item->harga,0,',','.') }}
        </td>
        <td class="right">
            Rp {{ number_format($item->jumlah * $item->harga,0,',','.') }}
        </td>
    </tr>
@endforeach
</table>

<div class="line"></div>

<table>
    <tr class="bold">
        <td>TOTAL</td>
        <td class="right">
            Rp {{ number_format($transaksi->total_harga,0,',','.') }}
        </td>
    </tr>
</table>

<div class="line"></div>

<div class="center">
    Terima kasih 🙏<br>
    Selamat menikmati
</div>

<div class="center" style="margin-top:12px;">
    <button onclick="window.print()">🖨 Cetak</button>
</div>

<div class="center" style="margin-top:6px;">
    <a href="/dashboard" class="back-btn">⬅ Kembali ke Dashboard</a>
</div>

</body>
</html>
