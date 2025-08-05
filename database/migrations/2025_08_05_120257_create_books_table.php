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
        Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->string('title')->index();
        $table->foreignId('author_id')->constrained()->onDelete('cascade');
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->timestamps();

        // Pindahkan kolom baru ke bawah dan hapus ->after()
        $table->decimal('ratings_avg', 4, 2)->default(0);
        $table->unsignedInteger('voter_count')->default(0);

        $table->index('ratings_avg')->index(); // Adding index for faster lookups
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
