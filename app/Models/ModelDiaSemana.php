<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelDiaSemana extends Model
{
    use HasFactory;
    protected $table = 'diasemana';

    public function relProfessorHorario(){
        return $this->belongsTo( 'App\Models\ModelProfessorHorario','id','diasemana_id');
    }
}
