<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episode', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('film_id');
            $table->text('url');
            $table->text('api_url');
            $table->timestamps();

            $table->foreign('film_id')->references('id')->on('films')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episode');
    }
}
