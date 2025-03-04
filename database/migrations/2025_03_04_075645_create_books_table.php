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
            $table->string('title');
            $table->string('author');
            $table->unsignedBigInteger('fk_category');
            $table->integer('total_books')->default(0);
            $table->integer('total_borrow')->default(0)->nullable();
            $table->integer('total_book_available')->default(0)->nullable();
            $table->timestamps();
            $table->foreign('fk_category')->references('id')->on('categories')->restrictOnDelete();
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