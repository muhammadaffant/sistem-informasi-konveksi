<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index ()
    {

        return view('admin.category.index',[
            'title' => 'Kategori',
            'active' => 'Kategori',
            'categories' => Category::all()
        ]);
    }


    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_kategori' => 'required|unique:categories|max:100'
        ]);

        $category=Category::create($validatedData);

        return back()->with('success', "Kategori {$category->nama_kategori} berhasil ditambahkan.");
    }


    public function update(Request $request, Category $category)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_kategori' => 'required|unique:categories,nama_kategori,' . $category->id . '|max:100',
        ]);
    
        $category->update($validatedData);
    
        return back()->with('success', "Kategori {$category->nama_kategori} berhasil diperbarui.");
    }
    

    public function destroy(Category $category)
    {
        $categoryName = $category->nama_kategori;
        $category->delete();
    
        return back()->with('success', "Kategori {$categoryName} berhasil dihapus.");
    }

}
