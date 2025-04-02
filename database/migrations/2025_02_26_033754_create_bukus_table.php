<?php

use App\Models\Kategori;
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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignIdFor(Kategori::class) // Foreign key for Kategori
                  ->constrained() // Automatically sets up the foreign key constraint
                  ->onDelete('cascade'); // Optional: define behavior on delete
            $table->text('judul'); // Book title
            $table->string('penulis')->nullable(); // Author name
            $table->string('penerbit')->nullable(); // Publisher name
            $table->string('isbn')->nullable(); // ISBN number
            $table->string('tahun')->nullable(); // Year of publication
            $table->string('jumlah')->nullable(); // Quantity
            $table->string('foto')->nullable(); // Photo path
            $table->text('deskripsi')->nullable(); // Description
            $table->decimal('rating', 2, 1)->default(0); // Rating with default value
            $table->timestamps(); // Created at and updated at timestamps
            $table->softDeletes(); // Soft delete column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus'); // Drop the table if it exists
    }
};