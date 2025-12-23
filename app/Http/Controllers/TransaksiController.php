<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use Illuminate\Http\Request;


class TransaksiController extends Controller
{
    public function destroy($id)
{
    \App\Models\Transaksi::findOrFail($id)->delete();
    return redirect('/transaksi')->with('success', 'Transaksi berhasil dihapus');
}

    public function index()
    {
        $transaksis = Transaksi::with('menu')->get();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create(Request $request)
    {
        $menus = \App\Models\Menu::all();
        $selectedMenu = $request->menu;
    
        return view('transaksi.create', compact('menus', 'selectedMenu'));
    }
    

    public function store(Request $request)
    {
        $menu = Menu::find($request->menu_id);
        $total = $menu->harga * $request->jumlah;

        Transaksi::create([
            'menu_id' => $request->menu_id,
            'jumlah' => $request->jumlah,
            'total_harga' => $total
        ]);

        return redirect('/transaksi/'.$transaksi->id.'/bayar');

    }
    public function checkout(Request $request)
    {
        $total = 0;
    
        // 1. Buat transaksi dulu
        $transaksi = Transaksi::create([
            'total_harga' => 0,
            'status' => 'pending'
        ]);
        
        // 2. Simpan item transaksi
        foreach ($request->items as $menu_id => $qty) {
            if ($qty > 0) {
                $menu = Menu::find($menu_id);
    
                if ($menu) {
                    $subtotal = $menu->harga * $qty;
    
                    TransaksiItem::create([
                        'transaksi_id' => $transaksi->id,
                        'menu_id' => $menu_id,
                        'jumlah' => $qty,
                        'harga' => $menu->harga,
                        'subtotal' => $subtotal
                    ]);
    
                    $total += $subtotal;
                }
            }
        }
    
        // 3. Update total
        $transaksi->update([
            'total_harga' => $total
        ]);
    
        // 🔴 INI YANG SERING SALAH
        // JANGAN redirect ke /transaksi
        // HARUS ke halaman bayar
        return redirect('/transaksi/' . $transaksi->id . '/bayar');
    }
    
public function bayar($id)
{
    $transaksi = Transaksi::findOrFail($id);
    return view('transaksi.bayar', compact('transaksi'));
}
public function prosesBayar(Request $request, $id)
{
    $transaksi = Transaksi::findOrFail($id);

    $transaksi->update([
        'metode_bayar' => $request->metode_bayar,
        'status' => 'selesai'
    ]);

    return redirect('/transaksi/' . $id . '/struk');
}



// Transaksi.php
public function items()
{
    return $this->hasMany(TransaksiItem::class);
}

// TransaksiItem.php
public function menu()
{
    return $this->belongsTo(Menu::class);
}


public function struk($id)
{
    $transaksi = Transaksi::with('items.menu')->findOrFail($id);
    return view('transaksi.struk', compact('transaksi'));
}

}
