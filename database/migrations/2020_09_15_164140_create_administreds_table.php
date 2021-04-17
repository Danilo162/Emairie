<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministredsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administreds', function (Blueprint $table) {
            $table->increments('id');
            $table->string("firstname");
            $table->string("lastname");
            $table->string("phone");
            $table->string("phone2")->nullable();
            $table->string("email");
            $table->string("birth_date");
            $table->string("birth_place");
            $table->string("birth_commune_id");
            $table->string("residence_commune_id");
            $table->string("job");
            $table->string("picture");
            $table->string("gender");
            $table->string("identity_papers_type");
            $table->string("identity_papers_id");
            $table->string("birth_certificate_number");
            $table->string("mairie_id");
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
        Schema::dropIfExists('administreds');
    }
}
