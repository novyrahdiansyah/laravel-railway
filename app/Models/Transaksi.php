<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_harga',
        'metode_pembayaran',
        'status'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function items()
{
    return $this->hasMany(TransaksiItem::class);
}

}
