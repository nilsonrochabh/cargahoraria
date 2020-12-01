<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\SistemaRepository;
use Log;
use Exception;

class SistemaController extends Controller
{

    protected $sistemaRepository;

    public function __construct(SistemaRepository $sistemaRepository)
    {
        $this->sistemaRepository = $sistemaRepository;
    }

    public function logarApp(Request $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');

        try {
            if (!$this->sistemaRepository->login($login,$password))
                throw new Exception("Login ou senha incorretos.");

            $infoUsuario = $this->sistemaRepository->showUsuario("ds_login",$login);
            $grupos = $infoUsuario['grupo'];

            if (count($grupos) == 0)
                throw new Exception("Grupo não configurado. Favor procurar a TI da ISJB.");

            $obras = $this->sistemaRepository->buscarObrasApp($grupos);
            $user = $this->sistemaRepository->showUsuarioApp($login);
            $userInfo = array_merge($user,[ "filiais" => $obras ]);

            return response()->json([ "user" => $userInfo ],200);

        } catch(Exception $e){
            return response($e->getMessage(),400);
        }
    }



}
