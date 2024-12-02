<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Pemesanan;
use App\Models\Category;

class PemesananMasukController extends Controller
{

    public function index()
    {
        $pemesanans = Pemesanan::orderBy('id', 'asc')->get();
        return view('admin.pemesananmasuk.index',[
            'title' => 'Pemesanan Masuk',
            'active' => 'Pemesanan',
            'categories' => Category::all(),
            'pemesanans' => $pemesanans
        ]);

    }
}
