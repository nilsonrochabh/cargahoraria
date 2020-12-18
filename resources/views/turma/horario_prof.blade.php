
@extends('layouts.layout');
@section('content')



<div class="container">
    <div class="text-center">
      <h2>Horarios Turma</h2>   
      <a href="/turma/">
        <button class="btn btn-success">Voltar</button>
        </a>    
      <hr />
      
    
    </div>
  
    @foreach($horarioTurmas as $horarioturma)   
    
        @php
                    
            $seguimento=$horarioturma->find($horarioturma->id)->relSeguimento;
            $serie=$horarioturma->find($horarioturma->id)->relSerie;
            $turno=$horarioturma->find($horarioturma->id)->relTurno;
            $turma=$horarioturma->find($horarioturma->id)->relTurma;
        
        @endphp
      
      @csrf

    <div class="row">
            <div class="form-group col-md-3">
                    <select id="segui" name="segui" class="form-control" disabled>
                        <option >{{$seguimento->nm_seguimento}}</option>                  
                    </select>
                    </div>
                        <div class="form-group col-md-2">
                    <select id="serie1" name="serie1" class="form-control" disabled> 
                    <option selected>{{$serie->nm_serie}}</option>
                    </select>
                    </div>
                    <div class="form-group col-md-1">
                      <select id="turma_id" name="turma_id" class="form-control" disabled>
                       <option selected>{{$turma->nm_turma}}</option>                          
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <select id="turno_id" name="turno_id" class="form-control" disabled>
                          <option selected>{{$turno->nm_turno}}</option>                          
                      </select>
                    </div>
                    <div class="form-group col-md-1">
                         <a href="{{url("turma/$horarioturma->id/edit")}}">
                            <button type="button"  class="btn btn-primary" > Editar</button></a> 
                     </div>
                     <div class="form-group col-md-1">
                        <a href=  "{{url("/turma/$horarioturma->id")}}" class="j-del">
                            <button class="btn btn-danger"> Excluir</button></a>
                     </div>
                     <div class="form-group col-md-1">

                        <a >
                            <button  type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">Adicionar Horário</button>
                          </a>
                     </div>
            
    </div>
    <br />


@endforeach          
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
   
    <tbody>
   
     
      
       
      
    
    @foreach($horarioProfessores as $horarioProf)
         @php 
            $professor=$horarioProf->find($horarioProf->id)->relProfessor;
            $materia=$horarioProf->find($horarioProf->id)->relMateria;
            $diasemana=$horarioProf->find($horarioProf->id)->relDiaSemana;
            
            $horario=$horarioProf->find($horarioProf->id)->relHorario;
            //dd($horarioProf);
            //dd($materia->nm_materia);
          
           
          @endphp
         <tr id="tr"> 
          <input type="hidden" >
            <td>{{$diasemana->nm_diasemana }} </td> 
             <td>{{$horario->nm_horario}}  </td>       
             <td>{{$materia->nm_materia }}</td> 
             <td>{{$professor->nm_professor }}</td> 
          
          


         </tr> 
         
         
        
         @endforeach    
         
    </tbody>
   
</table>
</div>
</div>  




  <!-- Modal -->
  <div class="modal fade bd-example-modal-xl" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Adicionar Horario</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered" id="prof">
               <form id="addform">   
                   @csrf  
                <thead>
                    <tr>
                        <th>Dia da semana</th>
                        <th>Horário </th>
                        <th>Matéria</th>    
                        <th>Professor</th>
                       
                      
                    </tr>
                </thead>
                <tbody >
               
                @if($horarioProf->horarioturma_id===$horarioProf->horarioturma_id)
                     @php 
                    //  dd($horarioProf);
                        $professor=$horarioProf->find($horarioProf->id)->relProfessor;
                        $materia=$horarioProf->find($horarioProf->id)->relMateria;
                        $diasemana=$horarioProf->find($horarioProf->id)->relDiaSemana;
                        $horario=$horarioProf->find($horarioProf->id)->relHorario;
                        //dd($professor->nm_professor)
                        //dd($materia->nm_materia)
                        @endphp
                        <input type="hidden" name="horarioturma_id" value="{{$horarioProf->horarioturma_id}}">
                     <tr > 
                        <td >  
                          <select id="diasemana_id[]" name="diasemana_id" class="form-control"   required="true" >
                          <option value="0"> </option>
                            @foreach($diasemanas as $dia )
                            <option value="{{$dia->id}}">{{$dia->nm_diasemana}}</option>
                            @endforeach
                        </select>
                        </td> 
                        <td>   
                           
                           <select id="horario_id[]" name="horario_id" class="form-control"   required="true" >
                             <option value="0">  </option>
                              @foreach($horarios as $horario )
                             <option value="{{$horario->id}}">{{$horario->nm_horario}}</option>
                             @endforeach
                           </select>
                        </td>    
                        
                         <td>
                          <select id="materia_id[]" name="materia_id" class="form-control"   required="true" >
                            <option value="0"> </option>
                             @foreach($materias as $mat )
                            <option value="{{$mat->id}}">{{$mat->nm_materia}}</option>
                            @endforeach
                          </select>
                           
                           </td> 
                           <td>
                            <select id="professor_id[]" name="professor_id" class="form-control"   required="true" >
                              
                              <option value="0"> </option>
                              @foreach($professores as $professor)@if($professor->unidade_id === $usuario->unidade_id)
                                  <option value="{{$professor->id }}">{{$professor->nm_professor}}</option>@endif 
                              @endforeach
                            </select> 
                            
                           </td>
                     
                        
                        
                       @endif
                       
                       <tr id="tr">
                      
                      
                  </tr>
                  </tr>
                 
                </tbody>
               
            </table >
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>
      </div>
    </div>
  </div>









  
@section('post-script')


 
<script >
   $(document).ready(function(){

    $('.editar').on('click',function(e){
      e.preventDefault();
      var id = $('#id').val();
      console.log(id);
    });
  });


 
    $(document).ready(function(){
        $('#addform').on('submit',function(e){
            e.preventDefault();

            $.ajax({
                type:"POST",
                url:"/turma/addhorario",
                data:$('#addform').serialize(),
                success:function(response){
                    console.log(response);
                    $('#exampleModal .close').click();
                    
                    alert("Horário adicionado");
                    location.reload();
                
                },
                erro: function(erro){
                    console.log(error)
                    alert("Error");
                }
            });
        });
    });

</script>


@endsection

@endsection