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
        Schema::create('account', function (Blueprint $table) {
            $table->id();
            $table->string('firstname', 100)->nullable();
            $table->string('lastname', 100)->nullable();
            $table->decimal('credit', 10, 2)->nullable();
            $table->dateTime('loggedin')->nullable();
            $table->dateTime('loggedout')->nullable();
            $table->string('schoolid', 50)->nullable();
            $table->date('birthdate')->nullable();
            $table->enum('status', ['inactive', 'active'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account');
    }
};
