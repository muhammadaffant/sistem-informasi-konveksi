<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    use HasFormatRupiah;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $appends = ['formatted_harga'];
    protected $with = ['category'];
    protected $table = 'produk';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'category_id',
        // 'stok',
        'harga',
        'keterangan',
        'foto_produk',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastProduk = Produk::orderBy('id', 'desc')->first();
            $number = $lastProduk ? ((int)substr($lastProduk->kode_produk, -3)) + 1 : 1;
            $model->kode_produk = 'PRDK-' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }

    
    public function variants()
    {
        return $this->hasMany(ProdukVariant::class, 'produk_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

        // Menambahkan accessor untuk 'formatted_harga'
        public function getFormattedHargaAttribute()
        {
            return $this->formatrupiah('harga'); // Menggunakan fungsi formatrupiah di trait
        }
}
