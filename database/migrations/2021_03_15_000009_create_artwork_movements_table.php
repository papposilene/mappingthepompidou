<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtworkMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artwork_movements', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('artwork_uuid');
            $table->foreign('artwork_uuid')->references('uuid')->on('artworks');
            $table->uuid('movement_uuid');
            $table->foreign('movement_uuid')->references('uuid')->on('movements');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artwork_movements');
    }
}
