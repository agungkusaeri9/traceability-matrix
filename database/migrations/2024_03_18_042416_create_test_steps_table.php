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
        Schema::create('test_step', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('test_case_id')->constrained('test_case')->cascadeOnDelete();
            $table->string('test_step');
            $table->string('test_data')->nullable();
            $table->string('expected_behavior')->nullable();
            $table->string('test_result')->nullable();
            $table->date('date');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_step');
    }
};
