<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('menu.index', compact('menus'));
    }

    public function create()
    {
        return view('menu.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
    
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')
                                      ->store('menu', 'public');
        }
    
        Menu::create($data);
    
        return redirect('/menu')->with('success', 'Menu berhasil ditambahkan');
    }
    

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('menu.edit', compact('menu'));
    }

    public function update(Request $request, $id)
{
    $menu = Menu::findOrFail($id);
    $data = $request->all();

    if ($request->hasFile('gambar')) {
        $data['gambar'] = $request->file('gambar')
                                  ->store('menu', 'public');
    }

    $menu->update($data);

    return redirect('/menu')->with('success', 'Menu berhasil diupdate');
}


    public function destroy($id)
    {
        Menu::destroy($id);
        return redirect('/menu')->with('success', 'Menu berhasil dihapus');
    }
}
