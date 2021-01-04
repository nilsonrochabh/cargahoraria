
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
      <div class="alert alert-success d-none mensagemBox" role="alert">
      
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
        @method('PUT')  
        @csrf      
        @if(isset($horarioProfessor))
               
         <tr>
            <td >       
                 <select id="diasemana_id" name="diasemana_id" class="form-control"   required="true" >
                 
                  <option value="{{$horarioProfessor->relDiasemana->id}}"> {{$horarioProfessor->relDiasemana->nm_diasemana}}</option>
                  @foreach($diasemanas as $dia )
                      <option value="{{$dia->id}}"> {{$dia->nm_diasemana}}</option>
                      @endforeach
            </select>
            </td> 
            <td>   
               <select id="horario_id" name="horario_id" class="form-control"   required="true" >
                <option value="{{$horarioProfessor->relHorario->id}}"> {{$horarioProfessor->relHorario->nm_horario}}</option>

                  @foreach($horarios as $horario )
                 <option value="{{$horario->id}}">{{$horario->nm_horario}}</option>
                 @endforeach
               </select>
            </td>    
            
             <td>
              {{-- <input type="hidden" value="{{$horarioProf->id}}"> --}}
              <select id="materia_id" name="materia_id" class="form-control"   required="true"  >
                <option value="{{$horarioProfessor->relMateria->id}}"> {{$horarioProfessor->relMateria->nm_materia}}</option>

                @foreach($materias as $mat )
                <option value="{{$mat->id}}">{{$mat->nm_materia}}</option>
                
                <option value="{{$mat->id}}">{{$mat->nm_materia}}</option>
                @endforeach
              </select>
               </td> 
               <td>
                <select id="professor_id" name="professor_id" class="form-control"   required="true" >
                  
                  <option value="{{$horarioProfessor->relProfessor->id}}"> {{$horarioProfessor->relProfessor->nm_professor}}</option>
                  @foreach($professores as $professor)@if($professor->unidade_id === $usuario->unidade_id)
                      <option value="{{$professor->id }}">{{$professor->nm_professor}}</option>@endif 
                  @endforeach
                </select> 
                
               </td>
               
            
          
           @endif
            
         
          </tr>
         
       
    </tbody>
    
  
    
  </table >
  <a >             
    <button class="btn btn-info mb-4 button" data-info="{{$horarioProfessor->id}}"  type="submit" > Editar </button>
    </a> 
    
</form> 



</div>
</div>  

@section('post-script')
<script>
  var Professor = new Array();

$("select[name='professor_id[]']").each(function(){
     Professor.push($(this).val());
     console.log(Professor);
  });
 $('.button').click(function(e) {
   e.preventDefault();
  var id = $(this).attr("data-info");
  console.log(id);
    var dados = $('#fEdit').serialize();
    console.log(dados);
    $.ajax({
        type:'PUT',
        url:'/turma/atualizahorario/'+id,
        data:dados,
       success:function(response){
         console.log(id);
         console.log(response);
         //location.reload();
         $('.mensagemBox').removeClass('d-none').html('Horário editado com sucesso!');
         window.location.href="{{url("turma/horario_prof/$horarioProfessor->horarioturma_id")}}";
        
       },
       error:function(error){
         console.log(error);
       }
       
    });
    console.log(id);
  }); 



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