<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order'; // table name

    protected $primaryKey = 'id_order'; // primary key

    // Define the fillable fields
    protected $fillable = [
        'tanggal_order', 
        'metode_pembayaran', 
        'jumlah_bayar', 
        'alamat',
        'status_order',
        'id_user',
        'payment_proof',
        'created_at',
        'updated_at'
    ];

    public function orderProduk()
    {
        return $this->hasMany(OrderProduk::class, 'id_order', 'id_order');
    }
}