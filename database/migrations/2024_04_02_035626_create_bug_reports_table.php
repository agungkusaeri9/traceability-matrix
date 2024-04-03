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
        Schema::create('bug_report', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('project_id')->constrained('project')->cascadeOnDelete();
            $table->foreignId('fitur_id')->constrained('fitur')->cascadeOnDelete();
            $table->string('temuan');
            $table->text('deskripsi')->nullable();
            $table->string('link');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bug_report');
    }
};
