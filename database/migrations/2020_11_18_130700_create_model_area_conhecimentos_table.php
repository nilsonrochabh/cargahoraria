<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelAreaConhecimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areaconhecimentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_seguimento')->unsigned();
            $table->foreign('id_seguimento')->references('id')->on('seguimento')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nm_areaconhecimento');
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
        Schema::dropIfExists('areaconhecimentos');
    }
}
