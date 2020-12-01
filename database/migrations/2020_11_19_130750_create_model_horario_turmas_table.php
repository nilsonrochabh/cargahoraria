<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelHorarioTurmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horario_turma', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('serie_id');
            $table->integer('turma_id');
            $table->integer('turno_id');
            $table->integer('horario_id');
            $table->integer('diasemana_id');
            $table->integer('professor_id');
            $table->integer('materia_id');
            $table->integer('user_id');
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
        Schema::dropIfExists('model_horario_turmas');
    }
}
