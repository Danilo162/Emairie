<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModePaiementsTable extends Migration
{
    /**
     * Run the migrations. php artisan migrate --path=/database/migrations/2020_10_07_164511_create_mode_paiements_table.php
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mode_paiements', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
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
        Schema::dropIfExists('mode_paiements');
    }
}
