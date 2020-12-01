<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelHorarioTurma extends Model
{
    protected $table='horarioturma';
    protected $fillable=['seguimento_id','serie_id','turma_id','turno_id','unidade_id','usuario_id'];


    public function relProfessor()
    {
        return $this->HasMany('App\Models\ModelProfessor', 'id','professor_id');
    }
    public function relDiaSemana()
    {
        return $this->HasMany('App\Models\ModelDiaSemana', 'diasemana_id');
    }
    public function relHorario()
    {
        return $this->HasMany('App\Models\ModelHorario', 'horario_id');
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
        return $this->belongsTo('App\Models\ModelTurma', 'turma_id','id');
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
