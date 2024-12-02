<?php

namespace App\Http\Controllers\Admin;

use App\Models\JasaLayanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class JasaLayananController extends Controller
{
    protected $title = 'Data Layanan';
    protected $active = 'Jasa Layanan';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.data-layanan.index', [
            'title' => $this->title,
            'active' => $this->active,
        ]);
    }

    public function data()
    {
        $jasaLayanan = JasaLayanan::orderBy('id', 'DESC');

        return datatables($jasaLayanan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($q) {
                return '
                <button onclick="editForm(`' . route('jasalayanan.show', $q->id) . '`)" class="btn btn-xs btn-primary mr-1"><i class="fas fa-pencil-alt"></i></button>
                <button onclick="deleteData(`' . route('jasalayanan.destroy', $q->id) . '`, `' . $q->nama_jasa . '`)" class="btn btn-xs btn-danger mr-1"><i class="fas fa-trash-alt"></i></button>
                ';
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function store(Request $request)
    {
        $rules = [
            'nama_jasa' => 'required',
            'deskripsi' => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Maaf, inputan yang Anda masukkan salah. Silakan periksa kembali dan coba lagi'
            ], 422);
        }

        $data = [
            'nama_jasa' => $request->nama_jasa,
            'deskripsi' => $request->deskripsi
        ];

        JasaLayanan::create($data);

        return response()->json(['message' => 'Data berhasil disimpan']);
    }

    public function show($id)
    {
        $jasaLayanan = JasaLayanan::findOrfail($id);

        return response()->json(['data' => $jasaLayanan]);
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'nama_jasa' => 'required',
            'deskripsi' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Input tidak valid. Silakan periksa dan coba lagi.'
            ], 422);
        }

        // Temukan data berdasarkan ID
        $jasaLayanan = JasaLayanan::findOrFail($id);

        // Perbarui data
        $jasaLayanan->update($request->only(['nama_jasa', 'deskripsi']));

        return response()->json(['message' => 'Data berhasil diperbarui']);
    }

    public function destroy($id)
    {
        // Cari data berdasarkan ID
        $jasaLayanan = JasaLayanan::findOrFail($id);

        // Hapus data
        $jasaLayanan->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
