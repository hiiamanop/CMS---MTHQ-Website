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
        Schema::create('berandas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')
                  ->nullable()
                  ->constrained('sections')
                  ->cascadeOnDelete();
            $table->string('nama_attribute');
            $table->string('keterangan');
            $table->enum('tipe_konten', ['teks', 'gambar'])->default('teks'); // Menentukan tipe konten
            $table->text('konten_teks')->nullable(); // Untuk menyimpan konten teks
            $table->string('konten_gambar')->nullable(); // Untuk menyimpan path gambar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berandas');
    }
};