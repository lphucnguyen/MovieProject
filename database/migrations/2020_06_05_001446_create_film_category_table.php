<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film_category', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignUuid('film_id')->references('id')->on('films')->onDelete('cascade');
            $table->foreignUuid('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->unique(['film_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('film_category');
    }
}
