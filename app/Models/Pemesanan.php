<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    // Table name (opsional jika nama tabel sesuai konvensi Laravel)
    protected $table = 'pemesanans';

    // Kolom yang dapat diisi secara mass assignment
    protected $fillable = [
        'nama',
        'telepon',
        'alamat',
        'kategori',
        'keperluan',
        'ukuran',
        'jumlah',
        'gambar',
        'keterangan',
    ];

    /**
     * Relasi ke model categories
     * Pemesanan memiliki satu categories (one-to-one).
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori'); // Pastikan 'kategori_id' sesuai dengan nama kolom di database
    }
    
}
