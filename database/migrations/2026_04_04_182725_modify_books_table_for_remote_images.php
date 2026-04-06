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
        Schema::table('books', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
            $table->string('author')->nullable()->change();
            $table->text('image')->nullable()->change();
            if (Schema::hasColumn('books', 'weight')) {
                $table->integer('weight')->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('author')->nullable(false)->change();
            $table->string('image')->nullable(false)->change();
        });
    }
};
