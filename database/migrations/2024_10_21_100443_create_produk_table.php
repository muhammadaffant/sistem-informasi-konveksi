<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('kode_produk', 100)->unique();
            $table->string('nama_produk'); // Nama produk
            $table->foreignId('category_id')->nullable(); // Kategori produk
            // $table->integer('stok'); // Stok produk
            $table->decimal('harga', 10, 2);
            $table->text('keterangan')->nullable();
            $table->string('foto_produk')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
