<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->string('origen')->nullable();
            $table->string('destino')->nullable();
            $table->tinyInteger('estado'); //0:pendiente, 1:recepcionado , 2 Derivado
            $table->unsignedBigInteger('user_id');  
            $table->unsignedBigInteger('tramite_id'); 
            $table->unsignedBigInteger('anterior')->nullable();; 
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('tramite_id')->references('id')->on('tramites');
            $table->foreign('anterior')->references('id')->on('movimientos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimientos');
    }
}
