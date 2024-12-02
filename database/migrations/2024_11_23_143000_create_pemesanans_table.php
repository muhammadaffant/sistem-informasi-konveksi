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
            $table->string('nama');
            $table->string('telepon');
            $table->text('alamat');
            $table->unsignedBigInteger('kategori');
            $table->string('keperluan');
            $table->string('ukuran');
            $table->integer('jumlah');
            $table->string('gambar');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Relasi Foreign Key
            $table->foreign('kategori')->references('id')->on('categories')->onDelete('cascade');
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
