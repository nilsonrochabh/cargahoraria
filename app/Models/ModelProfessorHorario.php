<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelProfessorHorario extends Model
{
  
    protected $table = 'horarioturmaprofessor';

    protected $fillable =[
        'horarioturma_id',
        'diasemana_id',
        'horario_id',
        'professor_id',     
        'materia_id',];

}
