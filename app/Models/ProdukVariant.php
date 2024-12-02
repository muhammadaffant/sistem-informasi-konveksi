<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukVariant extends Model
{
    use HasFactory;


    protected $table = 'product_variants';


    protected $fillable = ['produk_id', 'size', 'quantity'];
    
    public function product()
    {
        return $this->belongsTo(Produk::class);
    }   
}
