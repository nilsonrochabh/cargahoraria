<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelAtividade extends Model
{
   protected $table='atividade';

   protected $fillable =[
        'professor_id',
        'seguimento_id',
        'serie_id',     
        'evento_id',
        'hora',
        'unidade_id',
        'justificativa'];

    public function relEvento()
    {
        return $this->belongsTo ('App\Models\ModelEvento','evento_id');
    }
 
    public function relProfessor()
    {
        return $this->belongsTo('App\Models\ModelProfessor', 'professor_id');
    }
    public function relSeguimento()
    {
        return $this->belongsTo('App\Models\ModelSeguimento', 'seguimento_id');
    }
    public function relSerie()
    {
        return $this->belongsTo('App\Models\ModelSerie', 'serie_id');
    }
  

}
