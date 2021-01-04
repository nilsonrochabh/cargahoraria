
@extends('layouts.layout');
@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<br/>

<main role="main" class="container">
  <div class="container">
    <div class="text-center">
      <h2>Turma Cadastradas </h2>      
    
      <a href="/turma/create">
        <button class="btn btn-success">Cadastrar Turma</button>
        </a> 
    </div>
    <hr />
    <table class="table" id="turmas">
      <thead class="thead-dark">
        <tr>
      
          <th scope="col">Seguimento </th>
          <th scope="col">Série</th>
          <th scope="col">Turma</th>
          <th scope="col">Turno</th>
          
         
          <th scope="col"></th>
        </tr>
      </thead>
      
      @foreach($horarioTurmas as $horarioturma)   
      @if($horarioturma->unidade_id === $usuario->unidade_id)
      @php
          $id=$horarioturma->id;      
          $seguimento=$horarioturma->find($horarioturma->id)->relSeguimento;
          $serie=$horarioturma->find($horarioturma->id)->relSerie;
          $turno=$horarioturma->find($horarioturma->id)->relTurno;
          $turma=$horarioturma->find($horarioturma->id)->relTurma;

      @endphp
  
      
    <tbody>
    
        <tr>
      
          <td>{{$seguimento->nm_seguimento}}</td>
          <td>{{$serie->nm_serie}}</td>
          <td>{{$turma->nm_turma}}</td>
          <th scope="row">{{$turno->nm_turno}}</th>
             
         
          <td>
            <a href="/turma/horario_prof/{{$horarioturma->id}}">
              <button class="btn btn-primary">Visualizar Turma</button>
              
          </a>
          <a href=  "{{url("/turma/$horarioturma->id")}}" class="j-del">
            <button class="btn btn-danger"> Excluir</button></a>
          
            </td>
        </tr>
        @endif
        @endforeach 
      </tbody>
    </table>

    


        
    <div class="col-12  m-auto" >   
    </div>
  </div>  



<script src="">
   $(document).ready(function() {
  $('#turmas').dataTable( {
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese-Brasil.json"
            },
            "lengthMenu": [[25, 50, -1], [25, 50, "Todos"]]
        });
    });
</script>


@endsection

