<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::table('news_caches', function(Blueprint $table){

            //
            // Tidak ada perubahan
            //

        });

    }


    public function down(): void
    {

        //

    }

};