<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Produk;
use App\Models\Category;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::orderBy('id', 'asc')->get();
        return view('admin.produk.index',[
            'title' => 'Produk',
            'active' => 'Stok Produk',
            'produks' => $produks
        ]);
    }

        public function create()
        {
            $lastProduk = Produk::orderBy('id', 'desc')->first();
            $number = $lastProduk ? ((int)substr($lastProduk->kode_produk, -3)) + 1 : 1;
            $kodeProduk = 'PRDK-' . str_pad($number, 3, '0', STR_PAD_LEFT);
            return view('admin.produk.create', [
                'categories' => Category::all(),
                'title' => 'Tambah Produk',
                'kodeProduk' => $kodeProduk,
                'active' => 'Stok Produk',
            ]);
        }
    
        public function store(Request $request)
        {
            // Validasi input
            $validatedData = $request->validate([
                'kode_produk' => 'required|unique:produk|max:100',
                'nama_produk' => 'required|unique:produk',
                'category_id' => 'required',
                // 'stok' => 'required|integer',
                'harga' => 'required',
                'keterangan' => 'nullable',
                'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
                'sizes' => 'required|array',
                'quantities' => 'required|array',
            ]);

            $validatedData['harga'] = str_replace('.', '', $validatedData['harga']);
    
            // Menyimpan foto produk
            if ($request->hasFile('foto_produk')) {
                // $fileName = time() . '.' . $request->foto_produk->extension();
                $fileName = $request->file('foto_produk')->store('produk', 'public');
                $validatedData['foto_produk'] = $fileName;
            }
    
            // Produk::create($validatedData);
            $produk = Produk::create([
                'kode_produk' => $validatedData['kode_produk'],
                'nama_produk' => $validatedData['nama_produk'],
                'category_id' => $validatedData['category_id'],
                // 'stok' => $validatedData['stok'],
                'harga' => $validatedData['harga'],
                'keterangan' => $validatedData['keterangan'] ?? null,
                'foto_produk' => $validatedData['foto_produk'] ?? null,
            ]);

            // Simpan varian produk (sizes dan quantities) ke tabel 'product_variants'
            foreach ($validatedData['sizes'] as $index => $size) {
                $produk->variants()->create([
                    'size' => $size,
                    'quantity' => $validatedData['quantities'][$index] ?? 0,
                ]);
            }
    
            return redirect('/admin/produk')->with('success', 'Produk berhasil ditambahkan.');
        }
    
        // form edit produk (Update - Form)
        public function edit(Produk $produk)
        {
            return view('admin.produk.edit', [
                'title' => 'Edit Produk',
                'active' => 'Stok Produk',
                'produk' => $produk,
                'categories' => Category::all(),
                'variants' => $produk->variants,
            ]);
        }
    
        // Memperbarui produk yang ada di database (Update - Update)
        public function update(Request $request, Produk $produk)
        {
            // $request->merge([
            //     'harga' => preg_replace('/[^0-9]/', '', $request->harga)
            // ]);
            // Validasi input
            $validatedData = $request->validate([
                'kode_produk' => 'required|max:100|',
                'nama_produk' => 'required',
                'category_id' => 'required',
                'harga' => 'required',
                'keterangan' => 'nullable',
                'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'sizes' => 'required|array',
                'quantities' => 'required|array',
            ]);
            $validatedData['harga'] = str_replace('.', '', $validatedData['harga']);
    
            // Memperbarui foto produk jika ada
            if ($request->hasFile('foto_produk')) {
                Storage::disk('public')->delete($produk->foto_produk);
                // $fileName = time() . '.' . $request->foto_produk->extension();
                $fileName = $request->file('foto_produk')->store('produk', 'public');
                $validatedData['foto_produk'] = $fileName;
            }
    
            // Memperbarui data produk
            $produk->update($validatedData);

                // Hapus varian lama
            $produk->variants()->delete();

            foreach ($validatedData['sizes'] as $index => $size) {
                $produk->variants()->create([
                    'size' => $size,
                    'quantity' => $validatedData['quantities'][$index] ?? 0,
                ]);
            }
    
            return redirect('/admin/produk')->with('success', 'Produk berhasil diperbarui.');
        }
    
        // Menghapus produk dari database (Delete)
        public function destroy(Produk $produk)
        {
            // if ($produk->foto_produk && file_exists(public_path('images/' . $produk->foto_produk))) {
            //     unlink(public_path('images/' . $produk->foto_produk)); // Hapus file gambar jika ada
            // }
                  // Check if an image is associated and delete it
            if (!is_null($produk->foto_produk)) {
                Storage::disk('public')->delete($produk->foto_produk);
            }
    
            $produk->delete();
            return redirect('/admin/produk')->with('success', 'Produk berhasil dihapus.');
        }
}
