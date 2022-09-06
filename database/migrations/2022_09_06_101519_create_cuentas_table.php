<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->id();
            $table->string('nro')->nullable();
            $table->string('d_s')->nullable();
            $table->string('provvedor')->nullable();
            $table->string('vaucher')->nullable();
            $table->string('registro')->nullable();
            $table->string('monto')->nullable();
            $table->string('mes')->nullable();
            $table->string('estado')->nullable();
            $table->string('recibo')->nullable();
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
        Schema::dropIfExists('cuentas');
    }
}
