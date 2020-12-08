@extends('layouts.professor');
@section('content')

<br>

<div class="container">
<div class="text-center">
 <h1 class="mb-8">@if(isset($professor))Enturmar Professor @else Cadastrar Professor(a) @endif </h1> 


   <a href="/professor">
<button class="btn btn-success">Voltar</button>
</a> 
</div>


@if(isset($professor))
    <form action="{{url("professor/$professor->id")}}" name="fEdit" id="fEdit" method="post"  >@method('PUT')
    @else
    <form class="text-center border border-light p-5" action="{{url('professor')}}" name="fCad" id="fCad" method="post">
    @endif

  @csrf 
    <div class="form-row mb-4">
        <div class="col-2">
             <label for="Matricula">Matricula</label>
                <input type="number"  min=1 id="matricula" name="matricula"  class="form-control" onchange="funcaoMatricula()"   value="{{$professor->matricula ??''}}" required>
                <input type="text" id="id" name="id" class="form-control" value=""   hidden>
        </div>
        <div class="col-7">
            <label for="nome">Nome</label>
                <input type="text" id="nm_professor" name="nm_professor" class="form-control"   value="{{$professor->nm_professor ??''}}" required>
        </div>
         <div class="col-3">
                <label for="">Carga Horária</label>
                <input type="text" step="1" min=1 max=60 id="carga_horaria" name="carga_horaria"  class="form-control" value="{{$professor->carga_horaria ??''}}"  required>
         </div>
        <div class="col">
        
                <input type="text" id="unidade_id" name="unidade_id" class="form-control" value="{{$usuario->unidade_id}}"   hidden>
        </div>
      
    </div>
    
    @php
    
         $num1=$professor->materia1_id;
         $num2=$professor->materia2_id;
         $num3=$professor->materia3_id;
        
         
      $disciplinas[] = [$materias[$num1]->{"id"}.' '.$materias[$num1]->{"nm_materia"},$materias[$num2], $materias[$num3]];
    
  
    
     
  @endphp
    
    
  <div class="form-row mb-4">
            <div class="col-3">
                <div class="md-form">
                    <label for="">Disciplina</label>
                    <select class="custom-select" id="materia_id" name="materia_id">
                        <option {{$professor->materia1_id == 0 || $professor->materia1_id == null}} value="{{$professor->materia1_id ?? ''}}">{{$materias[$num1]->nm_materia ?? ''}} </option>
                        <option {{$professor->materia2_id == 0 || $professor->materia2_id == null}} value="{{$professor->materia1_id ?? ''}}">{{$materias[$num2]->nm_materia ?? ''}} </option>
                        <option {{$professor->materia3_id == 0 || $professor->materia3_id == null}} value="{{$professor->materia1_id ?? ''}}">{{$materias[$num3]->nm_materia ?? ''}} </option>                                          
                    </select> 
                </div>
            </div>
            <div class="col">
                <!-- Last name -->
                <div class="md-form">
                    <label for="">Seguimento</label>
                    <select class="custom-select" id="seguimento_id" name="seguimento_id" disabled>
                
                    <option value="0">Seguimento</option>                
                          
                    </select> 
                </div>
            
            </div>       
            <div class="md-form">
           
                <label for="">Série</label>
                <select class="custom-select" id="materia2_id" name="materia2_id" disabled>
            
                <option value="0">Série</option>  
                      
                </select> 
        
            </div>
            
        </div>
        <div class="form-row mb-4">
            <div class="col">
                <div class="md-form">
                    <label for="">Dia Semana</label>
                    <select class="custom-select" id="" name="">
                    <option value="{{$professor->relDiaSemana->id ?? ''}}">Dia Semana</option> 
                    @foreach($diasemana as $dia )
                        <option value="{{$dia->id}}">{{$dia->nm_diasemana}}</option>
                    @endforeach  
                    </select> 
                  
                </div>
            </div>
            <div class="col">
                <!-- Last name -->
                <div class="md-form">
                    <label for="">Turma</label>
                    <select class="custom-select" id="turma_id" name="turma_id">
                      <option value="0">Turma</option>
                          @foreach($turmas as $turma )
                            <option value="{{$turma->id}}">{{$turma->nm_turma}}</option>
                            @endforeach   
                    </select> 
                </div>
            
            </div>       
            <div class="md-form">
                <label for="">Turno</label>
                <select class="custom-select" id="turno_id" name="turno_id">
            
                <option value="0">Turno</option>
                      @foreach($turno as $tur )
                        <option value="{{$tur->id}}">{{$tur->nm_turno}}</option>
                        @endforeach
                      
                </select> 
            </div>
            
        </div>

    <!-- Sign up button -->
    <input class="btn btn-info my-4 btn-block"  value="Cadastrar" type="submit">
   
    <hr>



</form>
@section('post-script')

<script>
funcaoMatricula = function(){
    var mat =$('#matricula').val();
    $('#id').val(mat);
    

}



</script>
@endsection
@endsection