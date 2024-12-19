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
        Schema::create('tentang_mhtq_pimpinans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')
                  ->nullable() // Tambahkan nullable di sini
                  ->constrained('sections') // Menyebut tabel secara eksplisit
                  ->cascadeOnDelete(); // Hapus detail jika berita terkait dihapus
            $table->string('nama_attribute');
            $table->string('keterangan');
            $table->enum('tipe_konten', ['teks', 'gambar'])->default('teks');
            $table->text('konten_teks')->nullable();
            $table->string('konten_gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tentang_mhtq_pimpinans');
    }
};
