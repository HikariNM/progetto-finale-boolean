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
        Schema::create('adults', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gender');
            $table->string('breed');
            $table->date('birth_date');
            $table->string('microchip')->unique()->nullable();
            $table->string('coat_color');
            $table->string('tail_type');
            $table->string('pedigree_code')->nullable()->unique();
            $table->string('status')->default('Attivo');
            $table->boolean('is_neutered')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adults');
    }
};
