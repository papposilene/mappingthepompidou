<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('navigart_id', 255)->unique();
            $table->string('artist_name', 255);
            $table->string('artist_type', 255)->nullable();
            $table->string('artist_gender', 255)->nullable();
            $table->integer('artist_birth', false, true)->nullable();
            $table->integer('artist_death', false, true)->nullable();
            $table->string('artist_nationality', 255)->nullable();
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
        Schema::dropIfExists('artists');
    }
}
