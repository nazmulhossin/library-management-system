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
            $table->id('book_id');
            $table->string('title', 255); // Title of the book
            $table->text('description')->nullable();
            $table->string('author', 255);
            $table->string('publisher', 255)->nullable();
            $table->date('publication_date')->nullable();
            $table->string('edition', 5)->nullable();
            $table->string('isbn', 13)->nullable();
            $table->integer('pages')->nullable();
            $table->string('category', 100)->nullable();
            $table->integer('total_copies')->default(1);
            $table->integer('available_copies')->nullable();
            $table->string('cover_image', 255);
            $table->timestamp('uploaded_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            // Adding indexes for better performance
            $table->index('book_id');
            $table->index('author');
            $table->index('title');
            $table->index('publisher');
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
