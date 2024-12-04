<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduk extends Model
{
    protected $table = 'order_produk'; // table name

    protected $primaryKey = 'id_order_produk'; // primary key

    // Define the fillable fields
    protected $fillable = [
        'id_order', 
        'id_produk',
        'jumlah'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}
