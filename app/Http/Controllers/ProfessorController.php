<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ModelProfessor;
use App\Models\ModelUnidade;
use App\Models\ModelMaterias;
use Illuminate\Support\Facades\Auth;

class ProfessorController extends Controller
{
  
    private $objProfessor;
    private $objUnidade;
    private $objMateria;

    public function __constructor()
    {
        $this->objProfessor = new ModelProfessor();
        $this->objUnidade = new ModelUnidade();
        $this->objMateria = new ModelMaterias();
    }
    public function index()
    {
         $professores =ModelProfessor::get(); 
         //dd($this->objUnidade->find(2)->relProfessor) ;
         //dd(ModelProfessor::find(2)->relUnidade) ;
         //dd($this->objProfessor->all()) ;
         //dd($this->objUnidade->all());$professor=ModelProfessor::get();
         $usuario = Auth::user();
         
         return view('professor.index',compact('professores','usuario'));
    }
    public function create()
    {   
        $usuario = Auth::user();
        $professor=ModelProfessor::get();
        $materias = ModelMaterias::all();
               
        return view('professor/create', compact('professor','usuario','materias'));
    }

    
    public function store(Request $request)
    {
        $cadastro = ModelProfessor::create([
            'matricula'=>$request->matricula,
            'id'=>$request->id,
            'nm_professor'=>$request->nm_professor,
            'unidade_id'=>$request->unidade_id,
            'carga_horaria'=>$request->carga_horaria,
            'h_hora'=>$request->h_hora,
            'materia1_id'=>$request->materia1_id,
            'materia2_id'=>$request->materia2_id,
            'materia3_id'=>$request->materia3_id,]);
            if($cadastro){
                return redirect('professor/');
            }
    }

    public function show($id)
    {
        $professor = ModelProfessor::find($id);
        //$turmas = $this->objTurma->all();
        return view('professor/visualizar',compact('professor'));
    
    }
    public function edit($id)
    {
        $professor = ModelProfessor::find($id);
        $usuario = Auth::user();
        return view('professor/create',compact('professor','usuario'));
    }

    public function update(Request $request, $id)
    {
        $atualizar=ModelProfessor::where(['id'=>$id])->update([
            'matricula'=>$request->matricula,
            'nm_professor'=>$request->nm_professor,
            'unidade_id'=>$request->unidade_id,
            'carga_horaria'=>$request->carga_horaria,
            'h_hora'=>$request->h_hora,]);
            if($atualizar){
                return redirect('professor/');
            }
            
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
            $professores=ModelProfessor::where('nm_professor','LIKE','%'.$request->search."%")->get();
            if($professores)
            {
            foreach ($professores as $key => $prof) {
            $output.=
            '<td>'.$prof->matricula.'</td>'.
            '<td>'.$prof->nm_professor.'</td>'.  
            '<td>'.$prof->carga_horaria.'</td>'.  
            '<td>
                <a href="professor/'.$prof->id.'">
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
