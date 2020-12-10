@extends('layouts.paginas')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<main role="main" class="container">

  <div class="container">
    <div class="row">
      <h2>Editar de Horarios Turma</h2>     
         
      <hr />
    </div>
    <div class="col-12  m-auto" >
      @if (isset($errors) && count($errors)>0)
      <div class="alert-danger text-center mt-4 mb-4 p-2" >
        @foreach ($errors->all() as $erro)
        {{$erro}}<br />
            
        @endforeach
      </div>

          
           
      @endif	

      @foreach ($horarioTurmas as $horarioTurma)
          
      @endforeach
      @php
      $horarioprofessor=$horarioTurma->find($horarioTurma->id)->relProfessorHorario;

      $professorNome = $horarioprofessor->relProfessor;
      $materiaNome = $horarioprofessor->relMateria;
      $dia=$horarioprofessor->relDiaSemana;
     
      
      $seguimento=$horarioTurma->find($horarioTurma->id)->relSeguimento;
      $serie=$horarioTurma->find($horarioTurma->id)->relSerie;       
      $turma=$horarioTurma->find($horarioTurma->id)->relTurma;       
      $turno=$horarioTurma->find($horarioTurma->id)->relTurno;       
     
  @endphp   


@foreach($horarioProfessores as $key=>$horarioProf)
@if($horarioTurma->id===$horarioProf->horarioturma_id)
     @php 
      
        $horario_id = $horarioProf->horarioturma_id;
        $professor=$horarioProf->find($horarioProf->id)->relProfessor;
        $materia=$horarioProf->find($horarioProf->id)->relMateria;
        $diasemana=$horarioProf->find($horarioProf->id)->relDiaSemana;
        $horario=$horarioProf->find($horarioProf->id)->relHorario;
        //dd($professor->nm_professor)
        //dd($materia->nm_materia)
 
        @endphp
    @endif
    @endforeach
 <ul class="list-group mt-4">
    <h1>{{($dia->nm_diasemana)}}</h1>
  </ul>
    <div id="">
    <table class="table table-bordered" >  
    <tr>
    <th>Horário</th>
    <th>Professor</th>
    <th>Disciplina</th>
    <th>Ação</th>
    </tr>
    <tbody id="tab5">
    <tr> 
      <td>{{$horario->nm_horario}}</td>
        
    <td>
      <input type="hidden" name="horario_id" value="{{$horario_id}}">
   
    <select class="custom-select" id="professor_id[]" name="professor_id[]" >
                        <option value="0" selected>Professor</option>
                              @foreach($professores as $professor )
                                  @if($professor->unidade_id === $usuario->unidade_id)   
                              <option value="{{$professor->id ?? ''}}">{{$professor->nm_professor ?? ''}}</option>
                               @endif 
                              @endforeach
                      </select>
      </td>  
    <td>
      <select id="materia_id[]" name="materia_id[]" class="form-control"   required="true" > 
        <option value="0"></option> 
      </select>              
      
    <td><button type="button" class="addRow6" name="add" id="add-btn" class="btn btn-success">Adicionar Horário</button></td>  
    </tr>  
    </tbody>
    </table>

    </div>          
   
</div>
@section('post-script')
<script>
    $(document).ready(function(){
        var horarioturma_id = {{$horario_id}};
        console.log(horarioturma_id);
                  jQuery.ajax({
                     url : '/turma/retorna_horarios/' +horarioturma_id ,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {    
                      console.log(data);  

                      }
                  });
               
            
            
    });
</script>
@endsection
@endsection