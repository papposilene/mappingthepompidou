<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artworks', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('museum_department', 255);
            $table->uuid('artist_uuid');
            $table->foreign('artist_uuid')->references('uuid')->on('artists');
            $table->string('navigart_id', 255)->unique();
            $table->string('object_inventory', 255)->nullable();
            $table->text('object_title');
            $table->string('object_date', 255)->nullable();
            $table->string('object_type', 255)->nullable();
            $table->text('object_technique')->nullable();
            $table->float('object_height', 8, 2)->nullable();
            $table->float('object_width', 8, 2)->nullable();
            $table->float('object_depth', 8, 2)->nullable();
            $table->float('object_weight', 8, 2)->nullable();
            $table->text('object_copyright')->nullable();
            $table->boolean('object_visibility')->default(0);
            $table->uuid('acquisition_uuid');
            $table->foreign('acquisition_uuid')->references('uuid')->on('acquisition_types');
            $table->integer('acquisition_date', false, true)->nullable();
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
        Schema::dropIfExists('artworks');
    }
}
