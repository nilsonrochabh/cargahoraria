<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Models\ModelAtividade;
use Illuminate\Http\Request;
use App\Models\ModelDiaSemana;
use App\Models\ModelHorario;
use App\Models\ModelHorarioTurma;
use App\Models\ModelProfessor;
use App\Models\ModelTurma;
use App\Models\ModelTurno;
use App\Models\ModelSerie;
use App\Models\ModelProfessorHorario;

use App\Models\ModelMaterias;
use App\Models\ModelSeguimento;
use App\Models\ModelUnidade;
use App\Models\ModelUser;
use GrahamCampbell\ResultType\Success;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class HorarioTurmaController extends Controller
{   
    private $objSerie;
    private $objHorarioTurma;
    private $objHorario;
    private $objDiaSemana;
    private $objProfessor;
    private $objTurma;
    private $objTurno;
    private $objMateria;
    private $objProfessorHorario;

    public function __construct()
    {   
        $this->objSeguimento = new ModelSeguimento();
        $this->objSerie = new ModelSerie();
        $this->objHoraTurma = new ModelHorarioTurma();
        $this->objDiaSemana = new ModelDiaSemana();
        $this->objHorario = new ModelHorario();
        $this->objSerie = new ModelSerie();
        $this->objTurma = new ModelTurma();
        $this->objTurno = new ModelTurno();
        $this->objProfessor = new ModelProfessor();
        $this->objMateria = new ModelMaterias();
        $this->objProfessorHorario = new ModelProfessorHorario();
    }
    public function index()
    {
        $seguimentos = $this->objSeguimento->all();
        $series =$this->objSerie->all();
        $diasemana =$this->objDiaSemana->all();
        $horarios=$this->objHorario->all();

        $horarioTurmas=$this->objHoraTurma->get();
        $turmas=$this->objTurma->all();
        $turnos=$this->objTurno->all();
        $professores=$this->objProfessor->all();
        $materias=$this->objMateria->all();
        $usuario = Auth::user(); 
        
        return view('turma/index',compact('seguimentos','diasemana','horarios','series','horarioTurmas','turmas','turnos','professores','materias','usuario'));
    }
    public function create()
    {
        $seguimentos = $this->objSeguimento->all();
        $series =$this->objSerie->all();
        $diasemana =$this->objDiaSemana->all();
        $horarios=$this->objHorario->all();
        $horarioTurma=$this->objHoraTurma->all();
        $turmas=$this->objTurma->all();
        $turnos=$this->objTurno->all();
        $professores=$this->objProfessor->all();
        $materias=$this->objMateria->all();
        $usuario = Auth::user();     
        
        return view('turma/create', compact('seguimentos','diasemana','horarios','series','horarioTurma','turmas','turnos','professores','materias','usuario'));
    }
    public function pegaDados(Request $request){
        $dados['success']=false;
        $dados['mensagem']='Os dados não conferem';
        echo json_encode($dados);
        return;
    }
    public function cadastroHorarioProf(Request $request){
        $cad =  $this->objProfessorHorario->create([       			
            'horarioturma_id'=>$request->horarioturma_id,
            'diasemana_id'=>$request->diasemana_id,
            'horario_id'=>$request->horario_id,
            'professor_id'=>$request->professor_id,
            'materia_id'=>$request->materia_id]);
             if($cad){
               return redirect('turma');
        }

    }
  
 
     public function store(Request $request)
     {
      $dados= $request->all();
      $ultimoId=ModelHorarioTurma::create($dados)->id;
      if(count($request->professor_id) > 0)
      {
      foreach($request->professor_id as $horario=>$v){
           $dados2 = array(
              'horarioturma_id'=>$ultimoId,
              'professor_id'=>$request->professor_id[$horario],
              'diasemana_id'=>$request->diasemana_id[$horario],
              'horario_id'=>$request->horario_id[$horario],
              'materia_id'=>$request->materia_id[$horario],
          );
          ModelProfessorHorario::insert($dados2);
      }
    }
    return redirect()->back()->with('sucess','Dados Cadastrados com Sucesso');
    //return $request;
       
     }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function getSeries($segui_id) 
        {        
        $series = DB::table("serie")->where("seguimento_id",$segui_id)->pluck("nm_serie","id");
        return json_encode($series);
        }

    public function retornaProf($uni_id){
        $prof= DB::table("professor")->where("unidade_id",$uni_id)->pluck("nm_professor","id");

        return json_encode($prof);
    }
    public function retornaMat($uni_id){
       $mat= ModelMaterias::get('nm_materia');
       $json = $mat->toJson();
       return $json;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    public function cadprof()
    {
        return view('turma/cad-prof-turma');
    }

}
