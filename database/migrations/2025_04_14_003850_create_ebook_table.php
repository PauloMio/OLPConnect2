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
        Schema::create('ebooks', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200)->nullable();
            $table->text('description')->nullable();
            $table->string('author', 100)->nullable();
            $table->string('coverage', 255)->nullable();
            $table->string('pdf', 255)->nullable();
            $table->enum('status', ['inactive', 'active'])->nullable();
            $table->string('category', 100)->nullable();
            $table->string('edition', 50)->nullable();
            $table->string('publisher', 100)->nullable();
            $table->integer('copyrightyear')->nullable();
            $table->string('location', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ebook');
    }
};
