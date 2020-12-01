<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidade', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nm_unidade');
            $table->string('sigla_unidade');
            $table->string('ds_cidade');
            $table->string('sg_uf');
            $table->string('ds_logo');
            $table->string('ds_email');
            $table->integer('cd_institucional');
            $table->date('dt_inicial_cadastro');
            $table->date('dt_final_cadastro');
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
        Schema::dropIfExists('unidade');
    }
}
