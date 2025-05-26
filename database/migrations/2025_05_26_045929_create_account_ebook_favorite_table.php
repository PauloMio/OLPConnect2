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
        Schema::create('account_ebook_favorite', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained('account')->onDelete('cascade');
            $table->foreignId('ebook_id')->constrained('ebooks')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['account_id', 'ebook_id']); // prevent duplicate favorites
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_ebook_favorite');
    }
};
