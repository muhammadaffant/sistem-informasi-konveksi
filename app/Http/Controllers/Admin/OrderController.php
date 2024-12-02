<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Produk;

class OrderController extends Controller
{
    public function index ()
    {

        return view('admin.order.index', [
            'title' => 'Input Order',
            'active' => 'Input Order',
        ]);
    }
    public function getProdukData()
{
    $produks = Produk::with('variants')->get(); 

    return response()->json($produks);
}

}
