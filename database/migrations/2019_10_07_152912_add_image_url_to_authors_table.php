<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageUrlToAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('authors', function (Blueprint $table) {
            //
            if (!Schema::hasColumn('authors', 'image_url')) {
                $table->string('image_url')->default("/img//defaultImage.jpg");
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('authors', function (Blueprint $table) {
            //
            if (Schema::hasColumn('authors', 'image_url')) {
                $table->dropColumn('image_url');
            }
        });
    }
}
