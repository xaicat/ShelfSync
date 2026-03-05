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
            $table->string('name');
            $table->string('image')->nullable(); // To store the image filename
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Links to Category
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->integer('weight')->nullable(); // Kept this to match your Java code
            $table->text('description');
            $table->timestamps();
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
