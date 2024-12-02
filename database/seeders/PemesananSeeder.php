<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;
use App\Models\Pemesanan;

class PemesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pemesanan::create([
            'nama' => 'John Doe',
            'telepon' => '081234567890',
            'alamat' => 'Jl. Merpati No. 10,',
            'kategori' => 1, // ID kategori dari tabel categories
            'keperluan' => 'Kaos Acara Ulang Tahun',
            'ukuran' => 'M',
            'jumlah' => 50,
            'gambar' => 'uploads/desain1.png', // Path gambar (contoh)
            'keterangan' => 'Tambahkan logo di bagian depan.',

        ]);
    }
}
