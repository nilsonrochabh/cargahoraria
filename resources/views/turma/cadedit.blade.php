@extends('layouts.paginas')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<main role="main" class="container">

  <div class="container">
    <div class="text-center">
      <h2>Editar Turma</h2>     
        
          <a href="/turma/">
            <button class="btn btn-success">Voltar</button>
            </a>    
          <hr />   
        </div>
        <div class="row">
            @foreach ($horarioTurmas as $hturma)
           
            @php
                    
                $seguimento=$hturma->find($hturma->id)->relSeguimento;
                $serie=$hturma->find($hturma->id)->relSerie;
                $turno=$hturma->find($hturma->id)->relTurno;
                $turma=$hturma->find($hturma->id)->relTurma;
      
            @endphp
     
     @endforeach
                <div class="form-group col-md-3">
                  <label for="seguimento ">Seguimento</label>
                        <select id="segui" name="segui" class="form-control" >  
                            
                        <option value="{{$seguimento->id}}">{{$seguimento->nm_seguimento}}</option>            
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
                            <option value="{{$turma->id}}">{{$turma->nm_turma}}</option>
                          </select>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="Turno ">Turno</label>
                
                          <select id="turno_id" name="turno_id" class="form-control" >
                            <option selected>{{$turno->nm_turno}}</option>                 
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
       
             <tr> 
                <td>  
                  <select id="diasemana_id" name="diasenama_id[]" class="form-control"   required="true" >
                 
                </select>
                </td> 
                <td>   
                   <select id="horario_id" name="horario_id[]" class="form-control"   required="true" >
                     
                   </select>
                </td>       
                 <td>
                  <select id="materia_id[]" name="materia_id[]" class="form-control"   required="true" >
                   
                  </select>
                   
                   </td> 
                 <td>
                  <select id="professor_id[]" name="professor_id[]" class="form-control"   required="true" >
                    
                  </select> 
                  
                 </td>
                 <td> 
                  
                  
                  <button type="button" class="addRow6"  name="add" id="add-btn" class="btn btn-success">Adicionar Horário</button></td> 
                  </a>
                 
                
               
                 
             </tr > 
         
        </tbody>
       
    </table >
    
    </div>
    </div>  
        



@section('post-script')
<script>
    $(document).ready(function(){
        var url_atual = ""; 
        console.log(url_atual);
                  jQuery.ajax({
                     url : '/turma/retorna_horarios/' +horarioturma_id ,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {    
                        var professor_id = function(object) {
                             return object.id
                                    };

                        console.log(data.map(professor_id));

                      }
                  });
               
            
            
    });
</script>
@endsection
@endsection