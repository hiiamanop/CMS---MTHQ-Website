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
        Schema::create('list_beritas', function (Blueprint $table) {
            $table->id();
            $table->string('kategori_berita'); // Bisa diubah menjadi ENUM jika nilai kategori terbatas
            $table->string('judul_berita');
            $table->date('tanggal_upload'); // Menggunakan tipe DATE
            $table->text('highlight_berita'); // Menggunakan TEXT untuk highlight yang lebih panjang
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_beritas');
    }
};
