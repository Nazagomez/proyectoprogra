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
            $table->foreignId('category_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->string('title');
            $table->string('author');
            $table->string('publisher');
            $table->unsignedInteger('price');
            $table->string('currency', 8)->default('CRC');
            $table->string('language', 32);
            $table->string('format', 32);
            $table->unsignedSmallInteger('pages');
            $table->string('isbn', 32);
            $table->integer('publication_year');
            $table->unsignedSmallInteger('stock');
            $table->string('status', 32);
            $table->unsignedBigInteger('inventory_value')->nullable();
            $table->string('image_filename')->nullable();
            $table->text('description');
            $table->timestamps();
            $table->index(['title', 'author']);
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
