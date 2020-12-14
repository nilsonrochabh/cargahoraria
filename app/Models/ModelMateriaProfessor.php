<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelMateriaProfessor extends Model
{
    protected $table = 'materiaprofessor';

    protected $fillable=['professor_id','materia_id'];

    public function relProfessorMateria()
    {
        return $this->belongsTo('app/Models/ModelProfessor','professor_id');
    }
    public function relMateriaProfessor()
    {
        return $this->belongsTo('app/Models/ModelMateria','Materia_id');
    }
}
