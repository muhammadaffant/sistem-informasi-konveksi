<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produk;

class HomeController extends Controller
{
    public function ownerHome()
    {
        return view('owner.dashboard',[
            'title' => 'Owner Dashboard',
            'active' => 'Dashboard'
        ]);
    }
    
    public function adminHome()
    {

        $produkCount = Produk::count(); // Menghitung total stok produk
        return view('admin.dashboard',[
            'title' => 'Dashboard',
            'active' => 'Dashboard',
            'produkCount' => $produkCount, // Kirim data stok ke view
        ]);
    }

    public function userHome()
    {
        return view('user.home',[
            'title' => 'Home',
            'active' => 'Home',
        ]);
    }
}
