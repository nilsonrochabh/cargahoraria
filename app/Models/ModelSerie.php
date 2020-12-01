<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelSerie extends Model
{
    use HasFactory;
    protected $table='serie';

    public function relSeguimento()
    {
        return $this->hasMany('App\Models\ModelSeguimento');
    }
    public function relMateria()
    {
        return $this->belongsTo('App\Models\ModelMateria', 'materia_id');
    }
}
