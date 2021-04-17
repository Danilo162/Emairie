<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPermissionTable extends Migration
{
    /**
     * Run the migrations.
     * php artisan migrate --path=/database/migrations/2020_10_07_164511_create_mode_paiements_table.php
     * @return void
     */
    public function up()
    {
        Schema::create('user_permission', function (Blueprint $table) {
            $table->unsignedInteger("user_id");
            $table->unsignedInteger("permission_id");
//            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
//            $table->foreign("permission_id")->references("id")->on("permissions")->onDelete("cascade");
            $table->timestamps();
            $table->primary(["user_id","permission_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_permission');
    }
}
