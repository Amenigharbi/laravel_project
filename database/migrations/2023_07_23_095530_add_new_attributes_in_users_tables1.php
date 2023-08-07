<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewAttributesInUsersTables1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

                //1 si le compte est activé 0 si non
                $table->integer('is_verified')
                       ->default(0);

                $table->string('activation_code',255)
                      ->nullable();

                $table->string('activation_token',255)
                      ->nullable();



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
        });


    }
}
