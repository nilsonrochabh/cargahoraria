<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelProfessor extends Model
{
    
    protected $table='professor';
    protected $fillable =[
        'matricula',
        'id',
        'nm_professor',
        'unidade_id',     
        'carga_horaria',
        'h_hora',
        'materia1_id',
        'materia2_id',
        'materia3_id',
        'materia4_id',
        'materia5_id'];

    public function relUnidade(){
        return $this->belongsTo( 'App\Models\ModelUnidade', 'unidade_id');
    }
    public function relProfessorHorario(){
        return $this->hasOne( 'App\Models\ModelProfessorHorario','professor_id');
    }
    public function relHorarioTurma()
    {
        return $this->hasOne('App\Models\ModelHorarioTurma', 'horarioturma_id','id');
    }
    public function relMateria()
    {
        return $this->belongsTo('App\Models\ModelMaterias',  'materia_id');
    }
    public function relDiaSemana()
    {
        return $this->belongsTo('App\Models\ModelDiaSemana',  'diasemana_id');
    }
 
}
    