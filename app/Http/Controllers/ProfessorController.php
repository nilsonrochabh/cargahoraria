<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ModelProfessor;
use App\Models\ModelUnidade;
use App\Models\ModelMaterias;
use App\Models\ModelHorarioTurma;
use App\Models\ModelDiaSemana;
use App\Models\ModelEnturmarProfessor;
use App\Models\ModelHorario;
use App\Models\ModelSerie;
use App\Models\ModelSeguimento;
use App\Models\ModelTurma;
use App\Models\ModelTurno;
use App\Models\ModelProfessorHorario;
use App\Models\ModelMateriaProfessor;
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
        $materias = ModelMaterias::all();
        $professores =ModelProfessor::get(); 
               
        return view('professor/cad', compact('usuario','materias','professores'));
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
            'materia3_id'=>$request->materia3_id,
            'materia4_id'=>$request->materia4_id,
            'materia5_id'=>$request->materia5_id,]);
            if($cadastro){
                return redirect('professor/');
             
        }
    }

    public function show($id)
    {
        $materias = ModelMaterias::all();
        $professor = ModelProfessor::find($id);
        $horarioProf = ModelProfessorHorario::with('professor_id')->find($id);
        //$turmas = $this->objTurma->all();
        return view('professor/visualizar',compact('professor','horarioProf','materias'));
    
    }
    public function edit($id)
    {
        $professor = ModelProfessor::find($id);
        $usuario = Auth::user();
        $materias = ModelMaterias::all();
        return view('professor/create',compact('professor','usuario','materias'));
    }
    public function enturmar($id){
        $usuario = Auth::user();
        $professor = ModelProfessor::find($id);
        $materias = ModelMaterias::get();
        $diasemana = ModelDiaSemana::get();
        $turmas=ModelTurma::get();
        $turno=ModelTurno::get();
        $horario=Modelhorario::get();
        return view('professor/enturmar', 
                compact('professor','usuario','diasemana','turmas','horario','turno','materias'));
    }
    public function professorturma(Request $request){
        $cadastro = ModelEnturmarProfessor::create([
            'professor_id'=>$request->professor_id,
            'unidade_id'=>$request->unidade_id,
            'materia_id'=>$request->materia_id,
            'seguimento_id'=>$request->seguimento_id,
            'serie_id'=>$request->serie_id,
            'diasemana_id'=>$request->diasemana_id,
            'turma_id'=>$request->turma_id,
            'turno_id'=>$request->turno_id,
            'usuario_id'=>$request->usuario_id,]);
            if($cadastro){
                return redirect('professor/listaturma');
            }
    }
    public function listaprofessor(){
        $usuario = Auth::user();
        $professor = ModelProfessor::all();
        $materias = ModelMaterias::get();
        $diasemana = ModelDiaSemana::get();
        $turmas=ModelTurma::get();
        $turno=ModelTurno::get();
        $horario=Modelhorario::get();
        $seguimento=ModelSeguimento::get();
        $serie=ModelSerie::get();

        return view('professor/listaturma', 
                compact('professor','usuario','diasemana','turmas','horario','turno','materias','seguimento','serie'));

    }

    public function update(Request $request, $id)
    {
        $atualizar=ModelProfessor::where(['id'=>$id])->update([
            'matricula'=>$request->matricula,
            'nm_professor'=>$request->nm_professor,
            'unidade_id'=>$request->unidade_id,
            'carga_horaria'=>$request->carga_horaria,
            'h_hora'=>$request->h_hora,
            'materia1_id'=>$request->materia1_id,
            'materia2_id'=>$request->materia2_id,
            'materia3_id'=>$request->materia3_id,]);

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
        
    }

    public function adddisciplina(Request $request){
        
        return $request;

    }


}
