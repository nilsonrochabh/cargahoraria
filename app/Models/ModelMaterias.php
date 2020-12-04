<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelMaterias extends Model
{
    use HasFactory;
    protected $table = 'materia';
    

    public function relSerie()
    {
        return $this->belongsTo('app/Models/ModelSerie','serie_id');
    }

    public function relProfessor()
    {
        return $this->belongsTo('app/Models/ModelProfessor','materia_id');
    }
}
