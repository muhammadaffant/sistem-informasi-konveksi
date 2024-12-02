<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('kode_pemesanan');
            $table->unsignedBigInteger('user_id'); // Relasi dengan user (customer)
            $table->unsignedBigInteger('kategori_id');
            $table->string('nama_lengkap');
            $table->string('telepon');
            $table->string('keperluan');
            $table->text('alamat_pengiriman'); // Alamat pengiriman untuk pesanan
            $table->integer('total_item')->default(0);
            $table->integer('total_harga')->default(0);
            $table->enum('status', ['pending', 'process', 'completed', 'canceled'])->default('pending'); // Status pemesanan
            $table->string('gambar')->default('default.png');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemesanans');
    }
}
