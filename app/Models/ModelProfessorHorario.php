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
        'materia_id'];

    public function relHorarioTurma()
    {
          return $this->hasOne( 'App\Models\ModelHorarioTurma','id' ,'horarioturma_id');
    }
    public function relDiaSemana()
    {
         return $this->belongsTo( 'App\Models\ModelDiaSemana','diasemana_id')->orderBy('id','ASC');
    }  
    public function relProfessor()
    {
        return $this->belongsTo('App\Models\ModelProfessor', 'professor_id');
    }
    public function relHorario()
    {
        return $this->belongsTo('App\Models\ModelHorario', 'horario_id');
    }  
    public function relMateria()
    {
        return $this->belongsTo('App\Models\ModelMaterias', 'materia_id');
    }
   
}
