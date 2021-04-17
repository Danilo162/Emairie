<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemeMairiesTable extends Migration
{
    /**
     * Run the migrations.  php artisan migrate --path=/database/migrations/2020_10_05_161339_create_theme_mairies_table.php
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theme_mairies', function (Blueprint $table) {
            $table->increments('id');
            $table->string("theme");
            $table->integer("mairie_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('theme_mairies');
    }
}
