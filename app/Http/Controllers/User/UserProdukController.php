<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;

class UserProdukController extends Controller
{
    public function index ()
        {
            $produks = Produk::all();


            return view('user.produk-list',[
                'active' => 'produk',
                'title' => 'Produk',
                'produks' => $produks
            ]);
        }

    public function show(Produk $produk)
        {
            return view('user.detail-produk', [
                'title' => 'Detail Produk',
                'active' => 'Produk',
                'produk' => $produk,
            ]);
        }

        
}
