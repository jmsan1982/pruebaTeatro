<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableReservas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table){
            $table->id();

            $table->integer('id_user');
            $table->foreign('id_user')->references('id')->on('users');

            $table->integer('id_butaca');
            $table->foreign('id_butaca')->references('id')->on('butacas');

            $table->timestamp('fecha');
            $table->integer('numero_personas');
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
        Schema::drop('reservas');
    }
}
