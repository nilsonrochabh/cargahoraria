@extends('layouts.professor')
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
</style>


<div>

<h1 class="text-center">Lista de Atividades</h1>
<div class="text-center mt-3 mb-4">
  <a href="{{url('atividade/create')}}">
        <button class="btn btn-success">Cadastrar Atividade</button>
      </a>
  

  </div>
</div>
  <div class="clearfix mb-4"></div>
    <table id="atividades" class="table table-striped table-bordered" style="width:100%">
    <thead class="thead-dark">
        <tr>
    
        <th scope="col">Professor</th>
        <th scope="col">Seguimento </th>
        <th scope="col">Série</th>
        <th scope="col">Ação</th>
        </tr>
    </thead>
    <tbody>
      
        @foreach($atividades as $atividade) 
        
        @if($atividade->unidade_id === $usuario->unidade_id)   
        
        @php
       
            
            $professor=$atividade->find($atividade->id)->relProfessor;
            $seguimento=$atividade->find($atividade->id)->relSeguimento;
            $serie=$atividade->find($atividade->id)->relSerie;
            $evento=$atividade->find($atividade->id)->relEvento;
            
        @endphp
            
        
    
        <tr>
           
            </td>
            <td>
            {{$professor->nm_professor}}        
            </td>
                        
            <td>
            {{$seguimento->nm_seguimento}}        
            </td>       
            <td>
            {{$serie->nm_serie}}        
            </td>
        
            <td>
            <a href="{{url("/atividade/$atividade->id")}}">
                <button class="btn btn-dark">Visualizar</button>
                
            </a>
            <a href="{{url("atividade/$atividade->id/edit")}}">
                <button class="btn btn-primary">Editar</button>
                
            </a>
        </td>
        </tr>
        @endif 
        @endforeach
    </tbody>
    </table>
</div>

<script>
   
    
    $('#atividades').dataTable( {
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese-Brasil.json"
            },
            "lengthMenu": [[25, 50, -1], [25, 50, "All"]]
        });
    
 
  
// $(document).ready(function(){
//     $.ajax({
//         url : '/atividade/getUsuario/',
//             type : "GET",
//             dataType : "json",
//             success:function(data)
//             {
//                 console.log(data);
//             }
//     })
// })


</script>
@endsection