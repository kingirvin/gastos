<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGirosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giros', function (Blueprint $table) {
            $table->id();
            $table->string('nro')->nullable();
            $table->string('reg_siaf')->nullable();
            $table->string('periodo')->nullable();
            $table->string('cheque')->nullable();
            $table->string('monto')->nullable();
            $table->string('observacion')->nullable();
            $table->tinyInteger('estado')->default('1');
            $table->unsignedBigInteger('user_id');  
            $table->unsignedBigInteger('conciliacion_id');  
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('conciliacion_id')->references('id')->on('conciliaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('giros');
    }
}
