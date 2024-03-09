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
        Schema::create('skenario', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('fitur_id')->constrained('fitur')->cascadeOnDelete();
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('test_case', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('skenario_id')->constrained('skenario')->cascadeOnDelete();
            $table->string('nama');
            $table->enum('tipe', ['Happy Case', 'Unhappy Case'])->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_case');
        Schema::dropIfExists('skenario');
    }
};
