<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\ModelUnidade;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    // protected $connection = 'mysql2';
    // protected $table = "usuario";
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $
     protected $fillable = [
         'name',
         'email',
         'password',
         'unidade_id',
         

     ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function relUnidade()
    {
        return $this->hasMany('App/Models/ModelUnidade.php','unidade_id');
    }
}
