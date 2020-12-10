<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelEnturmarProfessor extends Model
{
    protected $table='turmaprofessor';
    protected $fillable=['professor_id','unidade_id','materia_id','seguimento_id',
                        'serie_id','diasemana_id','turma_id','turno_id','usuario_id'];
}