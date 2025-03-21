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
        Schema::create('program_pengasuhans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')
                  ->nullable()
                  ->constrained('sections')
                  ->cascadeOnDelete();
            $table->string('nama_attribute');
            $table->enum('tipe_konten', ['teks', 'gambar'])->default('teks')->nullable();
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
        Schema::dropIfExists('program_pengasuhans');
    }
};