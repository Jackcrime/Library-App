<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pinjam_id')->constrained('pinjams')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Tambahkan kolom user_id
            $table->foreignId('buku_id')->constrained('bukus')->onDelete('cascade'); // Tambahkan kolom buku_id
            $table->date('tgl_kembali');
            $table->decimal('denda', 10, 2)->default(0);
            $table->string('stats')->default('Belum Lunas');
            $table->timestamps();
            $table->softDeletes();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('pengembalians'); 
    }
};