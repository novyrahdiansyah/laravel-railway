@extends('layouts.app')

@section('content')
<h3 class="mb-3">Tambah Transaksi</h3>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="/transaksi">
            @csrf

            <div class="mb-3">
                <label class="form-label">Pilih Menu</label>
                <select name="menu_id" class="form-select">
@foreach($menus as $menu)
    <option value="{{ $menu->id }}"
        {{ isset($selectedMenu) && $selectedMenu == $menu->id ? 'selected' : '' }}>
        {{ $menu->nama_menu }} - Rp {{ number_format($menu->harga) }}
    </option>
@endforeach
</select>

            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" required>
            </div>

            <button class="btn btn-success">Simpan Transaksi</button>
            <a href="/transaksi" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
<script>
document.querySelector('select[name="menu_id"]').addEventListener('change', hitung);
document.querySelector('input[name="jumlah"]').addEventListener('input', hitung);

function hitung() {
    const menu = document.querySelector('select[name="menu_id"]');
    const jumlah = document.querySelector('input[name="jumlah"]').value;
    const harga = menu.options[menu.selectedIndex]?.dataset.harga || 0;
    const total = harga * jumlah;

    document.getElementById('total').innerText =
        total ? 'Rp ' + total.toLocaleString('id-ID') : '';
}
</script>

<p class="mt-3">
    <strong>Total: <span id="total"></span></strong>
</p>

@endsection
