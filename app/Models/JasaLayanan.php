<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JasaLayanan extends Model
{
    use HasFactory;


    protected $fillable = [
        'nama_jasa',
        'deskripsi',
    ];

}
