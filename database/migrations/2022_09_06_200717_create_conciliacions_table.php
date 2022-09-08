<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConciliacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conciliaciones', function (Blueprint $table) {
            $table->id();
            $table->string('exp_siaf')->nullable();
            $table->string('oc_os')->nullable();
            $table->string('proveedor')->nullable();
            $table->string('voucher')->nullable();
            $table->string('siaf')->nullable();
            $table->string('registro')->nullable();
            $table->string('monto')->nullable();
            $table->string('mes')->nullable();
            $table->string('recibo')->nullable();
            $table->tinyInteger('estado')->default('1');
            $table->unsignedBigInteger('user_id');  
            $table->timestamps();            
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conciliacions');
    }
}
