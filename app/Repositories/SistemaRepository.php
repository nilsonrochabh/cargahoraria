<?php

namespace App\Repositories;

use App\Model\Usuario;
use App\Repositories\sistema\GrupoRepository;
use Session;

class SistemaRepository
{
    public function login($login,$senha)
    {
        return (Usuario::where('ds_login','=',$login)->where('ds_senha','=',md5($senha))->get()->count() > 0) ?: false;
    }

    public function showUsuario($campo,$valor)
    {
        return Usuario::where($campo,'=',$valor)->with(['grupo' => function($query){
            $query->with('obra')->with('rota');
        }])
        ->get()
        ->first()
        ->toArray();
    }

    public function showUsuarioApp($login)
    {
        return Usuario::where('ds_login',$login)
        ->get()
        ->first()
        ->toArray();
    }

    public function buscarObrasApp($grupos)
    {
        $obras = [];
        foreach($grupos as $gr):
            $obras = array_merge($obras,array_column($gr['obra'],'cd_instituicao'));
        endforeach;
        $result = array_filter($obras, function($item){
            return $item != "0";
        });
        $r = array_unique($result);
        sort($r);
        return $r;
    }

}
