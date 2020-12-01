<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ModelUser;

class ConsultaController extends Controller
{
    public function index()
    {

        if(Auth::check()===true){
            
            $usuario = Auth::user();
            
            //dd($unidades->all());
            return view('consulta.index', compact('usuario'));  
        }
       //$atividades = $this->objAtividade->all();
      
       // $professores = $this->objProfessor->all();
       // return view('atividades.index',compact('professores'));
   }

    public function create()
  {
     
  }

  public function store(Request $request)
  {
     
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
   
  }
  public function edit($id)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      //
  }
}
