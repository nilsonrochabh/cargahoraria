
@extends('layouts.professor');
@section('content')

<br/>
<div class="container">
    <div class="text-center">
      <h2>Horarios Turma</h2>   
      <a href="/turma">
        <button class="btn btn-success">Voltar</button>
        </a>    
      <hr />   
    </div>
    @foreach($horarioProfessores as $key=>$horarioProf)
      @endforeach
     
      @method('PUT')
     @php
                    
            $serie=$horarioTurma->find($horarioTurma->id)->relSerie;
            $turno=$horarioTurma->find($horarioTurma->id)->relTurno;
            $turma=$horarioTurma->find($horarioTurma->id)->relTurma;
      @endphp
    <div class="row">
            <div class="form-group col-md-3">
                          
              <label for="seguimento ">Seguimento</label>
                    <select id="seguimento_id" name="seguimento_id" class="form-control" disabled >
                        <option value="{{$horarioTurma->relSeguimento->id}}"> {{$horarioTurma->relSeguimento->nm_seguimento}}</option>                      
                    </select>
                    </div>
                        <div class="form-group col-md-3">
                          <label for="serie">Serie</label>
                    <select id="serie_id" name="serie_id" class="form-control"  disabled> 
                    <option value="{{$horarioTurma->relSerie->id}}">{{$horarioTurma->relSerie->nm_serie}}}</option>
                    </select>
                    </div>
                    <div class="form-group col-md-1">
                      <label for="Turma ">Turma</label>
                      <select id="turma_id" name="turma_id" class="form-control" disabled>
                       <option value="{{$horarioTurma->relTurma->id}}"  >{{$horarioTurma->relTurma->nm_turma}}</option>                          
  
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="Turno ">Turno</label>
                      <select id="turno_id" name="turno_id" class="form-control"  disabled>
                          <option value="{{$horarioTurma->relTurno->id}}}">{{$horarioTurma->relTurno->nm_turno}}</option>  
                          
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
          
            
           
          
        </tr>
    </thead>
    <tbody >
      <form  id="fEdit" >
      {{ csrf_field() }}
              
    @foreach($horarioProfessores as $key=>$horarioProf)
   
    @if($horarioTurma->id===$horarioProf->horarioturma_id)
         @php 
     
            $professor=$horarioProf->find($horarioProf->id)->relProfessor;
            $materia=$horarioProf->find($horarioProf->id)->relMateria;
            $diasemana=$horarioProf->find($horarioProf->id)->relDiaSemana;
            $horario=$horarioProf->find($horarioProf->id)->relHorario;
            //dd($professor->nm_professor)
            //dd($materia->nm_materia)
            @endphp
         <tr> 
          <input type="hidden" name="id" id="id" value="{{$horarioProf->horarioturma_id}}">

      
            <td >  
      
              <select id="diasemana_id[]" name="diasemana_id[]" class="form-control"   required="true" >
              <option value="{{$diasemana->id}}"> {{$diasemana->nm_diasemana}}</option>
                @foreach($diasemanas as $dia )
                <option value="{{$dia->id}}">{{$dia->nm_diasemana}}</option>
                @endforeach
            </select>
            </td> 
            <td>   
               <select id="horario_id[]" name="horario_id[]" class="form-control"   required="true" >
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
                  @foreach($professores as $professor)@if($professor->unidade_id === $usuario->unidade_id)
                      <option value="{{$professor->id }}">{{$professor->nm_professor}}</option>@endif 
                  @endforeach
                </select> 
                
               </td>
               
             
              </tr> 
             
    </tbody>
    
    @endif
    
    @endforeach   

</table >
<a >
 
</a>
 <input class="btn btn-info mb-4 " style="width: 100%;"  value= "Editar" type="submit" >
</form>  
</div>
</div>  


@section('post-script')

<script>


  $("#fEdit").on('submit',function(e){
    e.preventDefault();
    var id = $("#id").val();
    var dados = $('#fEdit').serialize();
    // var diasemana_id = $('select[name="diasemana_id[]"]').val();
    // var horario_id = $('select[name="horario_id[]"]').val();
    // var materia_id = $('select[name="materia_id[]"]').val();
    // var professor_id = $('select[name="professor_id[]"]').val();
    
    //var dados = 'id'+id+'horario_id&amp;'+horario_id+'diasemana_id&amp;'+diasemana_id+'materia_id&amp;'+materia_id+'professor_id&amp;'+professor_id;
    $.ajax({
        type:'PUT',
   
        url:'/turma/atualizahorario/'+id,
        data:dados,
       success:function(response){
         
         console.log(response);
         location.reload();
       },
       error:function(error){
         console.log(error);
       }
    });


  })
</script>
<script>






    $(document).ready(function(){
      jQuery('select[name="seguimento_id"]').on('change',function(){
               segui_id = jQuery(this).val();
               if(segui_id)
               {
                  jQuery.ajax({
                     url : '/turma/getMaterias/' +segui_id,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {    
                      
                        jQuery.each(data, function(key,value){
                         
                        $('select[id="materia_id[]"]').append('<option value="'+ key +'">'+ value +'</option>');
                      
                        });
                        mat.push(data);  

                      }
                  });
               }
               else
               {
                  $('select[id="materia_id[]"]').empty();
               }
            
            });
            
            
    });

    </script> 
   

@endsection

@endsection