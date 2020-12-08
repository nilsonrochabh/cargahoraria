@extends('layouts.professor');
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<style>
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>'

<div>
<h1></h1>


<h1 class="text-center" >Lista de Professores</h1>
  <div class="text-center mt-3 mb-4">
  <a href="{{url('professor/cad')}}">
        <button class="btn btn-success">Cadastrar Professor</button>
      </a>


  </div>
</div>


    <table id="professores" class="table table-striped table-bordered" style="width:100%">
    <thead class="thead-dark">
        <tr>
        <th scope="col">Matricula</th>
        <th scope="col">Nome</th>
       
        <th scope="col">Carga Horária</th>
         <th scope="col">Ação</th>
        </tr>
    </thead>
    <tbody>
        @foreach($professores as $professor)

         @php
            $unidade=$professor->find($professor->id)->relUnidade;
            @endphp 
          @if($professor->unidade_id === $usuario->unidade_id)  
                <!-- <option value="{{$professor->id}}"></option>         -->
                <tr>
                <th scope="row">{{$professor->matricula}}</th>
                <td>{{$professor->nm_professor}}</td>
                
                <td>{{$professor->carga_horaria}}</td>
                <td>
                    <a href="{{url("professor/$professor->id")}}">
                        <button class="btn btn-dark">Vizualizar</button>
                    <a href="{{url("professor/$professor->id/enturmar")}}">
                        <button class="btn btn-warning">Enturmar</button>
                        
                    </a>
                </td>
                </tr>
            @endif
        @endforeach
    </tbody>
    </table>
</div>


<script>

$(document).ready(function() {
    
    $('#professores').dataTable(
         {responsive: true,
            "language": {                
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese-Brasil.json",
               
            },
            "lengthMenu": [[25, 50, -1], [25, 50, "All"]]
           

        });
    });


</script>
@endsection