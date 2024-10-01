<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->decimal('price', 10, 2);
            $table->string('repairer');
            $table->text('overview_of_work');
            $table->timestamps();

            // Add unique constraint
            $table->unique(['car_id', 'repairer', 'overview_of_work'], 'unique_quote');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('quotes');
    }
}
