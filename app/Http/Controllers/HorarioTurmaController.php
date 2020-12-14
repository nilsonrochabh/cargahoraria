<?php

namespace App\Http\Controllers;

use App\Http\Requests\TurmaRequest;
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
        $diasemana =ModelDiaSemana::orderBy('id', 'asc')->get();
        $horarios=$this->objHorario->all();
        $horarioProfessores=ModelProfessorHorario::get();
        $horarioTurmas=$this->objHoraTurma->get();
        $turmas=$this->objTurma->all();
        $turnos=$this->objTurno->all();
        $professores=$this->objProfessor->all();
        $materias=$this->objMateria->all();
        $usuario = Auth::user(); 
        
        return view('turma/index',compact('seguimentos','diasemana','horarios','series'
                                         ,'horarioTurmas','turmas','turnos','professores','materias','usuario','horarioProfessores'));
    }

    public function horarioProfessores($id){
        $horarioProfessores=ModelProfessorHorario::where('horarioturma_id','=',$id)
                ->orderBy('diasemana_id','asc')
                ->orderBy('horario_id','asc')->get();
        $seguimentos = $this->objSeguimento->all();
        $series =$this->objSerie->all();
      
        $diasemanas =ModelDiaSemana::orderBy('id', 'asc')->get();
        $horarios=$this->objHorario->all();
        $horarioTurmas=ModelHorarioTurma::where('id','=',$id)->get();
        $turmas=$this->objTurma->all();
        $turnos=$this->objTurno->all();
        $professores=$this->objProfessor->all();
        $materias=$this->objMateria->all();
        $usuario = Auth::user(); 
        return view('turma/horario_prof',compact('horarioProfessores' ,'seguimentos','diasemanas','horarios','series'
        ,'horarioTurmas','turmas','turnos','professores','materias','usuario'));
    }
    public function create()
    {
        $seguimentos = $this->objSeguimento->all();
        $series =$this->objSerie->all();
        $diasemana =ModelDiaSemana::orderBy('id', 'asc')->get();
        $horarios=$this->objHorario->all();
        $horarioTurma=$this->objHoraTurma->all();
        $turmas=$this->objTurma->all();
        $turnos=$this->objTurno->all();
        $professores=$this->objProfessor->all();
        $materias=ModelMaterias::get();
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
    return redirect()->route('turma.index')->with('sucess','Dados Cadastrados com Sucesso');
    //return $request;
       
     }
    
  
    public function show($id)
    {
        //
    }
     public function getSeguimento($mat_id) 
     {        
         $segu = DB::table("seguimento")->where("id",$mat_id)->pluck("nm_seguimento","id");
         return json_decode( json_encode($segu), true);
     }
    public function getSeries($segui_id) 
    {        
        $series = DB::table("serie")->where("seguimento_id",$segui_id)->pluck("nm_serie","id");
        return json_encode($series);
    }
    public function getMaterias($segui_id) 
    {        
       $materias1 = DB::table("materia")->where("seguimento_id",$segui_id)->pluck("nm_materia","id");
       return json_encode($materias1);
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
    public function retorna_horarios($id){

        $tudo=DB::table("horarioturmaprofessor")->where("id",$id)->get(); 
        $dadosturma = DB::table("horarioturma")->get();
        return json_encode($tudo,$dadosturma);
     }
     public function retorna_editahorario($id){

        $horarioTurmas=ModelHorarioTurma::all();
        $horarioProfessores=ModelProfessorHorario::all();
        $seguimentos = $this->objSeguimento->all();
        $series =$this->objSerie->all();
        $diasemanas =ModelDiaSemana::orderBy('id', 'asc')->get();
        $horarios=$this->objHorario->all();
        $turmas=$this->objTurma->all();
        $turnos=$this->objTurno->all();
        $professores=$this->objProfessor->all();
        $materias=ModelMaterias::get();
        $usuario = Auth::user();     
        
        return view('turma/cadedit', compact('seguimentos','diasemanas','horarios','series','horarioTurmas','turmas','turnos','professores','materias','usuario','horarioProfessores'));
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $horarioTurma=ModelHorarioTurma::with('relProfessor', 'relDiaSemana','relHorario','relTurno','relSeguimento','relSerie','relTurma','relHorario', 'relProfessorHorario')->find($id);
        $horarioProfessores=ModelProfessorHorario::all();
        $seguimentos = $this->objSeguimento->all();
        $series =$this->objSerie->all();
        $diasemanas =ModelDiaSemana::orderBy('id', 'asc')->get();
        $horarios=$this->objHorario->all();
        $turmas=$this->objTurma->all();
        $turnos=$this->objTurno->all();
        $professores=$this->objProfessor->all();
        $materias=ModelMaterias::get();
        $usuario = Auth::user();     
        
        
        return view('turma/editar', compact('seguimentos','diasemanas','horarios','series','horarioTurma','turmas','turnos','professores','materias','usuario','horarioProfessores'));
    }

  
    public function update(Request $request, $id){    
      
        
    }
  

    public function updatehorario(Request $request){  
        $id = $request->horarioturma_id;
        $cadastro = $this->objProfessorHorario->create([
        'horarioturma_id'=>$request->horarioturma_id,
        'professor_id'=>$request->professor_id,
        'diasemana_id'=>$request->diasemana_id,
        'horario_id'=>$request->horario_id,
        'materia_id'=>$request->materia_id,
        ]);
        if($cadastro){
            return redirect('/turma');
        
       }
    }
    
    
    //return $dados;
    
    public function cadedit(Request $request){

        $horarioTurmas=ModelHorarioTurma::all();
        $horarioProfessores=ModelProfessorHorario::all();
        $seguimentos = $this->objSeguimento->all();
        $series =$this->objSerie->all();
        $diasemanas =ModelDiaSemana::orderBy('id', 'asc')->get();
        $horarios=$this->objHorario->all();
        $turmas=$this->objTurma->all();
        $turnos=$this->objTurno->all();
        $professores=$this->objProfessor->all();
        $materias=ModelMaterias::get();
        $usuario = Auth::user();     
        
        return view('turma/cadedit', compact('seguimentos','diasemanas','horarios','series','horarioTurmas','turmas','turnos','professores','materias','usuario','horarioProfessores'));
    }

   
    public function destroy($id)
    {
        $del = ModelHorarioTurma::destroy($id);
        return($del)?"sim":"não";
    }
    public function cadprof()
    {
        return view('turma/cad-prof-turma');
    }

}
