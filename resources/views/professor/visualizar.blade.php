@extends('layouts.layout')
@section('content')



<div class="text-center">
<h1 > {{$professor->nm_professor}}</h1>
   <a href="/professor">
<button class="btn btn-success">Voltar</button>
</a> 
</div>
<div>

    <table class="table">
  <thead>

    <tr>
      <th scope="col">Matricula</th>
      <th scope="col">Carga Horária Vigente</th>
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
      $num1=$professor->materia1_id;
      $num2=$professor->materia2_id;
      $num3=$professor->materia3_id;
      //dd($num1);
      foreach ($materias as $key => $materia) {
       if ($materia->id == $num3) {
         $mat3 = $materia->nm_materia;
       }
       if ($materia->id == $num2) {
         $mat2 = $materia->nm_materia;
       }
       if ($materia->id == $num1) {
         $mat1 = $materia->nm_materia;
       }
      }
      //dd($mat1)
      
      
      @endphp
       
     
      <td> {{$mat1}} </td>
      <td>{{$mat2}}</td>
      <td>{{$mat3}}</td>

      <td>  
        
      <a href="{{url("professor/$professor->id/edit")}}"">
                    <button class="btn btn-primary">Editar</button>
                 

                   
      </td>
      
    </tr>
  </tbody>
</table>
    
    <div>
      
        
    </div>

    
    
    

</div>
@endsection