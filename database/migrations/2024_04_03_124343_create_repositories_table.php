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
        Schema::create('repository', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('nama_dokumen');
            $table->string('file');
            $table->text('deskripsi')->nullable();
            $table->string('jenis');
            $table->bigInteger('ukuran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repository');
    }
};
