
@extends('layouts.professor');
@section('content')
<br/>
<div class="container">
    <div class="text-center">
      <h2>Horarios Turma</h2>   
      <a href="/turma/">
        <button class="btn btn-success">Voltar</button>
        </a>    
      <hr />   
    </div>
       @php
                    
            $seguimento=$horarioTurma->find($horarioTurma->id)->relSeguimento;
            $serie=$horarioTurma->find($horarioTurma->id)->relSerie;
            $turno=$horarioTurma->find($horarioTurma->id)->relTurno;
            $turma=$horarioTurma->find($horarioTurma->id)->relTurma;
      
      @endphp


    <div class="row">
            <div class="form-group col-md-3">
              <label for="seguimento ">Seguimento</label>
                    <select id="segui" name="segui" class="form-control" >
                      
                        <option >{{$seguimento->nm_seguimento}}</option>  
                        @foreach($seguimentos as $seguimento)
                        
                        <option value="{{$seguimento->id}}">{{$seguimento->nm_seguimento}}</option>
                        @endforeach                   
                    </select>
                    </div>
                        <div class="form-group col-md-3">
                          <label for="serie ">Serie</label>
                    <select id="serie1" name="serie1" class="form-control" > 
                    <option selected>{{$serie->nm_serie}}</option>
                    </select>
                    </div>
                    <div class="form-group col-md-1">
                      <label for="Turma ">Turma</label>
                      <select id="turma_id" name="turma_id" class="form-control" >
                       <option selected>{{$turma->nm_turma}}</option>                          
                       @foreach($turmas as $turma)
                          
                         <option value="{{$turma->id}}">{{$turma->nm_turma}}</option>
                      @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="Turno ">Turno</label>
                      <select id="turno_id" name="turno_id" class="form-control" >
                          <option selected>{{$turno->nm_turno}}</option>  
                          @foreach($turnos as $turno )
                          <option value="{{$turno->id}}">{{$turno->nm_turno}}</option>
                          @endforeach                        
                      </select>
                    </div>
            
    </div>
    <br />      
    <div class="col-12  m-auto" >   
<table class="table table-bordered" id="prof">
    <thead>
        <tr>
            <th>Dia da semana</th>
            <th>Horário </th>
            <th>Matéria</th>    
            <th>Professor</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody >
    @foreach($horarioProfessores as $key=>$horarioProf)
    @if($horarioTurma->id===$horarioProf->horarioturma_id)
         @php 
        //  dd($horarioProf);
         
            $professor=$horarioProf->find($horarioProf->id)->relProfessor;
            $materia=$horarioProf->find($horarioProf->id)->relMateria;
            $diasemana=$horarioProf->find($horarioProf->id)->relDiaSemana;
            $horario=$horarioProf->find($horarioProf->id)->relHorario;
            //dd($professor->nm_professor)
            //dd($materia->nm_materia)
            @endphp
         <tr> 
            <td  >  
              <select id="diasemana_id" name="diasenama_id" class="form-control"   required="true" >
              <option value="{{$diasemana->id}}"> {{$diasemana->nm_diasemana}}</option>
                @foreach($diasemanas as $dia )
                <option value="{{$dia->id}}">{{$dia->nm_diasemana}}</option>
                @endforeach
            </select>
            </td> 
            <td>   
               <select id="horario_id" name="horario_id" class="form-control"   required="true" >
                 <option value="{{$horario->id}}"> {{$horario->nm_horario }} </option>
                  @foreach($horarios as $horario )
                 <option value="{{$horario->id}}">{{$horario->nm_horario}}</option>
                 @endforeach
               </select>
            </td>       
             <td>
              <select id="materia_id[]" name="materia_id[]" class="form-control"   required="true" >
                <option value="{{$materia->id}}"> {{$materia->nm_materia}} </option>
                 @foreach($materias as $mat )
                <option value="{{$mat->id}}">{{$mat->nm_materia}}</option>
                @endforeach
              </select>
               
               </td> 
             <td>
              <select id="professor_id[]" name="professor_id[]" class="form-control"   required="true" >
                <option value="{{$professor->id}}"> {{$professor->nm_professor}} </option>
                 @foreach($professores as $prof )
                   <option value="{{$prof->id}}">{{$prof->nm_professor}}</option>
                @endforeach
              </select> 
              
             </td>
             <td> 
              <a href="/turma/{{$horarioProf->id}}/cadedit">
              
              <button type="button" class="addRow6"  name="add" id="add-btn" class="btn btn-success">Adicionar Horário</button></td> 
              </a>
             @endif
            
             @endforeach
             
         </tr > 
     
    </tbody>
   
</table >

</div>
</div>  
    

@section('post-script')
<script>
var i=0;  
	//add more categories drop down js
  i=i+1;
  console.log(i);
  $('#add-btn').on('click',function(e){
			e.preventDefault();
      var template = '<tr>'+
                          '<td>'+i+'º Horário</td>'+
                          '<td><select class="custom-select" id="professor_id[]" name="professor_id[]" ><option value="0">Professor</option>@foreach($professores as $professor)@if($professor->unidade_id === $usuario->unidade_id)<option value="{{$professor->id }}">{{$professor->nm_professor}}</option>@endif @endforeach</select></td>'+
                          '<td><select id="materia_id[]" name="materia_id[]" class="custom-select" ><option value="0"></option> </select> </td>'+
                          '<td><a href="#" class="btn btn-danger remove" id="remover"><i class="glyphicon glyphicon-remove"></i>Remover</a></td>'+
                          
                  '</tr>';
             //append before
			$('.tr').after(template);
		});
		//remove categories js
		$(document).on('click', '.btn-remove-cat', function(e){
			e.preventDefault();
			$(this).parent('.form-group').remove();
		});



    </script> 
@endsection

@endsection