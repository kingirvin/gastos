<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRdrComprobantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rdr_comprobantes', function (Blueprint $table) {
            $table->id();
            $table->string('siaf')->nullable();
            $table->string('documento_tipo')->nullable();
            $table->string('nro_doc')->nullable();
            $table->string('importe')->nullable();
            $table->tinyInteger('eliminar')->default('0');
            $table->tinyInteger('estado')->default('1');
            $table->unsignedBigInteger('user_id');  
            $table->unsignedBigInteger('proveedor_id');  
            //id de los tipos de datos;
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rdr_comprobantes');
    }
}