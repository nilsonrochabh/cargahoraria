
@extends('layouts.professor');
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<br/>

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
      


    <div class="row">
            <div class="form-group col-md-3">
                    <select id="segui" name="segui" class="form-control" disabled>
                        <option >{{$seguimento->nm_seguimento}}</option>                  
                    </select>
                    </div>
                        <div class="form-group col-md-3">
                    <select id="serie1" name="serie1" class="form-control" disabled> 
                    <option selected>{{$serie->nm_serie}}</option>
                    </select>
                    </div>
                    <div class="form-group col-md-3">
                      <select id="turma_id" name="turma_id" class="form-control" disabled>
                       <option selected>{{$turma->nm_turma}}</option>                          
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <select id="turno_id" name="turno_id" class="form-control" disabled>
                          <option selected>{{$turno->nm_turno}}</option>                          
                      </select>
                    </div>
            
    </div>
    <br />


@endforeach          
    <div class="col-12  m-auto" >   
 

<table class="table table-bordered" id="prof">
    <thead>
        <tr>
            <th>Horário </th>
            <th>Dia da semana</th>
            <th>Professor</th>
            <th>Matéria</th>    
        </tr>
    </thead>
    <tbody>
    @foreach($horarioProfessores as $key=>$horarioProf)
         @php 
            $professor=$horarioProf->find($horarioProf->id)->relProfessor;
            $materia=$horarioProf->find($horarioProf->id)->relMateria;
            $diasemana=$horarioProf->find($horarioProf->id)->relDiaSemana;
            $horario=$horarioProf->find($horarioProf->id)->relHorario;
            //dd($professor->nm_professor)
            //dd($materia->nm_materia)
            @endphp
         <tr> 
            <td> {{$horario->nm_horario}}  </td> 
            <td> {{$diasemana->nm_diasemana}}  </td> 
             <td>{{$professor->nm_professor}}</td> 
             <td>{{$materia->nm_materia}}  </td> 
          
         </tr> 
       
    @endforeach
    </tbody>
   
</table>
</div>
</div>  


<script src="">
$('#prof').dataTable( {
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese-Brasil.json"
            },
            "lengthMenu": [[25, 50, -1], [25, 50, "All"]]
        });
    });
</script>
@endsection