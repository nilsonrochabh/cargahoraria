<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelUnidade extends Model
{
    protected $table = 'unidade';

    public function relUsers()
    {
        return $this->belongsTo('App\Models\ModelUser','id');
    }
    public function relUnidade()
    {
        return $this->belongsTo('App\Models\ModelUser','id', 'user_id');
    }

    public function relProfessor(){
        return $this->belongsTo( 'App\Models\ModelProfessor', 'unidade_id');
    }
}
