<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMairiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mairies', function (Blueprint $table) {
            $table->increments('id');
            $table->string("nom");
            $table->string("localisation");
            $table->string("phone");
            $table->string("email");
            $table->string("picture")->nullable();
            $table->unsignedBigInteger("commune_id")->index()->nullable();
            $table->string("status")->nullable();
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
        Schema::dropIfExists('mairies');
    }
}
