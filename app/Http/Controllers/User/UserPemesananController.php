<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pemesanan;

use App\Models\Category;

class UserPemesananController extends Controller
{
    public function index ()
    {
        return view('user.pemesanan',[
            'title' => 'Pemesanan',
            'categories' => Category::all(),
            'active' => 'Pemesanan'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
            'kategori' => 'required',
            'keperluan' => 'required|string',
            'ukuran' => 'required|string',
            'jumlah' => 'required|integer|min:1',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $fileName = null;
        if ($request->hasFile('gambar')) {
            // Simpan file ke folder 'desain' di storage/app/public
            $fileName = $request->file('gambar')->store('desain', 'public');
        }

        // Simpan data pemesanan
        Pemesanan::create([
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'kategori' => $request->kategori,
            'keperluan' => $request->keperluan,
            'ukuran' => $request->ukuran,
            'jumlah' => $request->jumlah,
            'gambar' => $fileName, // Path gambar yang disimpan
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Pemesanan berhasil dikirim.');
    }

}
