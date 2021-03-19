<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist_movements', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('artist_uuid');
            $table->foreign('artist_uuid')->references('uuid')->on('artists');
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
        Schema::dropIfExists('artist_movements');
    }
}
