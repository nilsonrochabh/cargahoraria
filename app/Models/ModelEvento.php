<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelEvento extends Model
{
    protected $table = 'evento';


    public function relAtividade()
    {
        return $this->belongsTo('App\Models\ModelAtividade','id');
    }
  
}
