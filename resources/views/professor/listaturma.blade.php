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
    
    </tr>
  </thead>
  <tbody>

      <td>{{$professor->carga_horaria}}</td>
      <td>{{$professor->h_hora}}</td>
      
   
    </tr>
  </tbody>
</table>
    
    <div>
      
        
    </div>

    
    
    

</div>
@endsection