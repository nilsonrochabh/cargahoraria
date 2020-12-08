<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelSeguimento extends Model
{
    use HasFactory;
    protected $table = 'seguimento';

    public function relSerie(){
        return $this->belongsTo('App\Models\ModelSerie');
    }
    public function relMateria(){
        return $this->belongsTo('App\Models\ModelMateiras', 'seguimento_id');
    }
  
}
