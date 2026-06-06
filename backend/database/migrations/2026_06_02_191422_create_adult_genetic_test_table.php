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
        Schema::create('adult_genetic_test', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adult_id')->constrained()->onDelete('cascade');
            $table->foreignId('genetic_test_id')->constrained()->onDelete('cascade');
            $table->string('result')->nullable();
            $table->date('test_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adult_genetic_test');
    }
};
