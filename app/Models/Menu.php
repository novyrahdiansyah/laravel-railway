<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_menu',
        'harga',
        'deskripsi',
        'gambar'
    ];
    public function transaksiItems()
{
    return $this->hasMany(TransaksiItem::class);
}

    
}
