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
        'materia3_id'];

    public function relUnidade(){
        return $this->belongsTo( 'App\Models\ModelUnidade', 'unidade_id');
    }
}
