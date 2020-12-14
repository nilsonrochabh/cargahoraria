<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\RedisJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ViewErrorBag;
use App\Models\ModelUnidade;
use App\Models\ModelUser;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    protected $objUnidade;
    protected $objUsuario;
    public function __construct()
    {
        $this->objUnidade = new ModelUnidade();
        
        
    }
    
    public function index()
    {
        if(Auth::check()===true){
            
            $usuario = Auth::user();
            $unidades = $this->objUnidade->all();
            //dd($unidades->all());
            return view('pages.dashboard',compact('usuario','unidades'));
        }
       return redirect()->route('pages.login');
    }
    public function loginForm()
    {
        return view('pages.loginForm');
    }
    public function login(Request $request)
    {
        //var_dump($request->all());
        $credencias = [
            'email'=>$request->email,
            'password'=>$request->password,
            'unidade_id'=>$request->unidade
        ];
        //Auth::attempt($credencias);
        if(Auth::attempt($credencias)){
            return redirect()->route('pages');

        }
        return redirect()->back()->withInput()->withErrors(['Os dados informados não conferem']);
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('pages');
    }

    public function getUnidade($unidade_id) 
    {        
    $userUnidade = DB::table("user")->where("unidade_id",$unidade_id)->pluck("nm_unidade","id");
    return json_encode($userUnidade);
    }

}
