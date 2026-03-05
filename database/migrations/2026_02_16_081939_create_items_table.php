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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('title');        // Item Name
            $table->text('description');    // Item Details
            $table->decimal('price', 8, 2); // Price (e.g., 99.99)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Links item to the User who created it
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
