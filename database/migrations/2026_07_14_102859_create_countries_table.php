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
       Schema::create('countries', function ($table) {

    $table->id();

    $table->string('name');

    $table->string('code');

    $table->string('region')->nullable();

    $table->string('currency')->nullable();

    $table->string('language')->nullable();

    $table->decimal('latitude',10,7)
          ->nullable();

    $table->decimal('longitude',10,7)
          ->nullable();

    $table->timestamps();

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
