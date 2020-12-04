<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ModelDiaSemana;
use App\Models\ModelEvento;
use App\Models\ModelProfessor;
use App\Models\ModelTurma;
use App\Models\ModelTurno;
use App\Models\ModelSerie;
use App\Models\ModelSeguimento;
use App\Models\ModelUnidade;
use App\Models\ModelAtividade;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Auth;



class AtividadeController extends Controller
{
    private $objSerie;

    private $objDiaSemana;
    private $objProfessor;
    private $objTurma;
    private $objTurno;
    private $objSeguimento;
    private $objEvento;
    private $objUnidade;
    private $objAtividade;
  
    

    public function __construct()
    {   
        $this->objProfessor = new ModelProfessor();
        $this->objSeguimento = new ModelSeguimento();
        $this->objSerie = new ModelSerie();
        $this->objDiaSemana = new ModelDiaSemana();
        $this->objTurma = new ModelTurma();
        $this->objTurno = new ModelTurno();
        $this->objEvento = new ModelEvento();
        $this->objAtividade = new ModelAtividade();
        $this->objUnidade = new ModelUnidade();
        
        
       
    }
  
    public function index()
     {
        $atividades = $this->objAtividade->all();
        return view('atividades/lista', compact('atividades'));
        // $professores = $this->objProfessor->all();
        // return view('atividades.index',compact('professores'));
    }
      public function create()
    {
        $professores=$this->objProfessor->all();
        $seguimentos = $this->objSeguimento->all();
        $series =$this->objSerie->all();
        $diasemana =$this->objDiaSemana->all();
        $turmas=$this->objTurma->all();
        $turnos=$this->objTurno->all();
        $eventos=$this->objEvento->all();
        $unidades=$this->objUnidade->all();
        $usuario = Auth::user();
        
        return view('atividades/create', 
               compact('diasemana','series','professores','seguimentos','eventos','unidades','usuario'));
    }
 
    public function store(Request $request)
    {
        $cadastro = $this->objAtividade->create([
            'professor_id'=>$request->professor_id,
            'seguimento_id'=>$request->segui,
            'serie_id'=>$request->serie1,
            'evento_id'=>$request->evento_id,
            'hora'=>$request->hora,
            'unidade_id'=>$request->unidade_id,
            'justificativa'=>$request->justificativa]);


            if($cadastro){
                return redirect('atividade/');
            }
    }

    public function lista()
    {       
        $atividades = $this->objAtividade->all();
       // $atividades->load('professor_id');
        return view('atividade',compact('atividades'));
    }
    public function show($id)
    {
       
        $atividade = $this->objAtividade->find($id);
        
        return view('atividades/visualizar',compact('atividade',));
    
    }
    public function edit($id)
    {
        $atividade=$this->objAtividade->find($id);
        $professores=$this->objProfessor->all();
        $seguimentos = $this->objSeguimento->all();
        $series =$this->objSerie->all();
        $eventos=$this->objEvento->all();
        $unidades=$this->objUnidade->all();
        $usuario = Auth::user();
        
        return view('atividades/create', 
               compact('series','professores','seguimentos','eventos','unidades','usuario','atividade'));
        
    }

    public function getHora($prof_id) 
    {        
    $historicoHora = $this->objProfessor->where("id",$prof_id)->get("h_hora","id");
    return json_encode($historicoHora);
    }

    public function getUsuario(){
        return json_encode(Auth::user());
    }

    public function update(Request $request, $id)
    {
        
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

    public function search(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $atividades=ModelProfessor::where('nm_professor','LIKE','%'.$request->search."%")->get();
            if($atividades)
            {
            foreach ($atividades as $key => $ativ) {
            $output.=
            '<td>'.$ativ->mn_professor.'</td>'.
            '<td>'.$ativ->nm_seguimento.'</td>'.  
            '<td>'.$ativ->nm_serie.'</td>'.  
            '<td>
                <a href="atividade/'.$ativ->id.'">
                    <button class="btn btn-dark">Vizualizar</button>
                    
                </a>
    
                <a href="">
                    <button class="btn btn-primary">Editar</button>
                    
                </a>
            </td>'
            ;
            }
            return Response($output);
        }
        }
    }

   
}
