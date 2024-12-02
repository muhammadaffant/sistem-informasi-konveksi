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
    protected $guarded = ['id'];

    /**
     * Relasi ke model categories
     * Pemesanan memiliki satu categories (one-to-one).
     */
    public function kategori()
    {
        return $this->belongsTo(Category::class, 'kategori_id'); // Pastikan 'kategori_id' sesuai dengan nama kolom di database
    }

    public function pemesananDetail()
    {
        return $this->hasMany(PemesananDetail::class);
    }

    public function statusColor()
    {
        $color = '';

        switch ($this->status) {
            case 'completed':
                $color = 'success';
                break;
            case 'pending':
                $color = 'warning';
                break;
            case 'process':
                $color = 'info';
                break;
            case 'canceled':
                $color = 'danger';
                break;
            default:
                break;
        }

        return $color;
    }
}
