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
        Schema::create('litters', function (Blueprint $table) {
            $table->id();
            $table->string('title'); //Litter A
            $table->date('birth_date');
            $table->string('mother_id')->nullable()->constrained('adults')->nullOnDelete();
            $table->string('father_id')->nullable()->constrained('adults')->nullOnDelete();
            $table->string('external_father_name')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('In programma');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('litters');
    }
};
