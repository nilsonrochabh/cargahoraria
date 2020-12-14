<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelHorarioTurma extends Model
{
    protected $table='horarioturma';
    protected $fillable=['seguimento_id','serie_id',
                          'turma_id','turno_id','unidade_id','usuario_id'];


    public function relProfessor()
    {
        return $this->belongsTo('App\Models\ModelProfessor', 'id',);
    }
    public function relDiaSemana()
    {
        return $this->belongsTo('App\Models\ModelDiaSemana', 'id',)->orderBy('id','ASC');
    }
    public function relHorario()
    {
        return $this->belongsTo('App\Models\ModelHorario', 'id');
    }
    public function relSerie()
    {
        return $this->belongsTo('App\Models\ModelSerie', 'serie_id','id');
    }
    public function relSeguimento()
    {
        return $this->belongsTo('App\Models\ModelSeguimento', 'seguimento_id','id');
    }
    public function relTurma()
    {
        return $this->belongsTo('App\Models\ModelTurma', 'turma_id' ,'id');
    }
    public function relTurno()
    {
        return $this->belongsTo('App\Models\ModelTurno', 'turno_id','id');
    }
    public function relProfessorHorario()
    {
        return $this->hasOne('App\Models\ModelProfessorHorario', 'horarioturma_id','id');
    }


}
