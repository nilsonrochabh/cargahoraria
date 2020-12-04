@extends('layouts.layout')
@section('content')



<div class="text-center">
<h1 > {{$professor->nm_professor}}</h1>
   <a href="/professor">
<button class="btn btn-success">Voltar</button>
</a> 
</div>
<div>
        <!-- <p>Professor : <span class="font-weight-bold">{{$professor->nm_professor}}</span> </p> -->
    <table class="table">
  <thead>
    <tr>
      <th scope="col">Matricula</th>
      <th scope="col">Carga Horária</th>
      <th scope="col">Histórico de Horas</th>
      <th scope="col">Disciplina 1</th>
      <th scope="col">Disciplina 2</th>
      <th scope="col">Disciplina 3</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">{{$professor->matricula}}</th>
      <td>{{$professor->carga_horaria}}</td>
      <td>{{$professor->h_hora}}</td>
      @php
       
       dd($materias[0]->nm_materia);    
      @endphp
      

      <td>{{$professor->materia1_id}}</td>
      <td>{{$professor->materia2_id}}</td>
      <td>{{$professor->materia3_id}}</td>
      <td>
     
      <a href="{{url("professor/$professor->id/edit")}}"">
                    <button class="btn btn-primary">Editar</button>
                        
                    </a>

      <a href="{{url("professor/$professor->id/edit")}}">
                        <button class="btn btn-danger">Excluir</button>
                        
                    </a>
      </td>
      
    </tr>
  </tbody>
</table>
    
    <div>
      
        
    </div>

    
    
    

</div>
@endsection