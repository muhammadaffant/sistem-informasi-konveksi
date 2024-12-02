<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;

class PemesananMasukController extends Controller
{
    protected $title = 'Pemesanan Masuk';
    protected $active = 'Pemesanan';

    /**
     * Display the main page.
     */
    public function index()
    {
        return view('admin.pemesananmasuk.index', [
            'title' => $this->title,
            'active' => $this->active,
        ]);
    }

    /**
     * Fetch data for DataTables.
     */
    public function data()
    {
        $query = Pemesanan::with('kategori')->select('pemesanans.*');

        return datatables()
            ->of($query)
            ->addIndexColumn()
            ->editColumn('aksi', fn($q) => $this->renderActionButtons($q))
            ->editColumn('status', fn($q) => $this->renderStatusBadge($q))
            // ->editColumn('gambar', fn($q) => $this->renderImageColumn($q))
            ->rawColumns(['aksi', 'status', 'gambar'])
            ->make(true);
    }

    /**
     * Fetch details of a specific order.
     */
    public function detail($id)
    {
        $pemesanan = Pemesanan::with('pemesananDetail', 'kategori')->find($id);

        if (!$pemesanan) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'data' => $pemesanan
        ]);
    }

    /**
     * Update the status of an order.
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:pemesanans,id',
            'status' => 'required|in:pending,process,completed,canceled',
        ]);

        $pemesanan = Pemesanan::findOrFail($request->id);
        $pemesanan->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diubah.'
        ]);
    }

    /**
     * Render action buttons for DataTables.
     */
    protected function renderActionButtons($pemesanan)
    {
        $detailUrl = route('admin.pemesanan.detail', $pemesanan->id);

        return '
        <button onclick="detailForm(`' . $detailUrl . '`)" class="btn btn-xs btn-primary mb-2">
            <i class="fas fa-eye"></i> Lihat
        </button>
        <button class="btn btn-xs btn-primary change-status" data-id="' . $pemesanan->id . '" data-status="' . $pemesanan->status . '">
            <i class="fas fa-edit"></i> Ubah Status
        </button>
    ';
    }

    /**
     * Render status badge for DataTables.
     */
    protected function renderStatusBadge($pemesanan)
    {
        $badgeClasses = [
            'pending' => 'badge-warning',
            'process' => 'badge-info',
            'completed' => 'badge-success',
            'canceled' => 'badge-danger',
        ];

        $class = $badgeClasses[$pemesanan->status] ?? 'badge-secondary';
        $status = ucfirst($pemesanan->status);

        return '<span class="badge ' . $class . '">' . $status . '</span>';
    }

    /**
     * Render image column for DataTables.
     */
    protected function renderImageColumn($pemesanan)
    {
        if ($pemesanan->gambar) {
            $imageUrl = asset('storage/' . $pemesanan->gambar);
            return '<img src="' . $imageUrl . '" class="img-thumbnail" style="max-width: 100px;">';
        }

        return '<span class="text-muted">Tidak ada gambar</span>';
    }
}
