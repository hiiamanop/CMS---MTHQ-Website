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
        Schema::create('detail_beritas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('list_berita_id')
                  ->nullable() // Tambahkan nullable di sini
                  ->constrained('list_beritas') // Menyebut tabel secara eksplisit
                  ->cascadeOnDelete(); // Hapus detail jika berita terkait dihapus
            $table->string('nama_attribute'); // Perbaikan nama kolom
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_beritas');
    }
};