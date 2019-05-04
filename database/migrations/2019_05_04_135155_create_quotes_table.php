<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('content');
            $table->string('link_to_the_source');
            $table->boolean('approuved')->default(false);
            $table->timestamps();

            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('authors');

            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')->references('id')->on('languages');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotes');
    }
}
