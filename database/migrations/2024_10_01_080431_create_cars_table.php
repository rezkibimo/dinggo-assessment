<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('license_plate')->unique(); // Unique to prevent duplicates
            $table->string('license_state');
            $table->string('vin')->unique();
            $table->year('year');
            $table->string('colour');
            $table->string('make');
            $table->string('model');
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
}
