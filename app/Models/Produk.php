<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    public $timestamps = false;
    protected $table = 'produk'; // table name

    protected $primaryKey = 'id_produk'; // primary key

    // Define the fillable fields
    protected $fillable = [
        'nama_produk', 
        'merk', 
        'jenis', 
        'ukuran', 
        'harga', 
        'image'
    ];
}
