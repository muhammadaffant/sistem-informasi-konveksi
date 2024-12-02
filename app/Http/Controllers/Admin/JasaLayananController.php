<?php

namespace App\Http\Controllers\Admin;

use App\Models\JasaLayanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JasaLayananController extends Controller
{
    public function index()
    {
        $jasaLayanans = JasaLayanan::all();
        return view('admin.data-layanan.index',[
            'title' => 'Data Layanan',
            'active' => 'Jasa Layanan',
            'jasaLayanans' => $jasaLayanans
        ]);
    }
}
