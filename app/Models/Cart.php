<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts'; // table name

    protected $primaryKey = 'id'; // primary key

    // Define the fillable fields
    protected $fillable = [
        'user_id', 
        'product_id', 
        'quantity', 
        'price', 
        'created_at',
        'updated_at'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'product_id', 'id_produk');
    }
}