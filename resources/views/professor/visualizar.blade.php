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
      $num1=$professor->materia1_id;
      $num2=$professor->materia2_id;
      $num3=$professor->materia3_id;
      //dd($num1);
      foreach ($materias as $key => $materia) {
       while ($materia->id == $num3) {
         dd($materia->nm_materia);
       }
      }
      
      
      
      @endphp
       
     
      <td>  @if($professor->materia1_id == 0 || $professor->materia1_id == null) {{$professor->materia1_id}} @else {{$materias[$num1]->nm_materia}} @endif </td>
      <td>  @if($professor->materia2_id == 0 || $professor->materia2_id == null) {{$professor->materia2_id}} @else {{$materias[$num2]->nm_materia}} @endif </td>
      <td>  @if($professor->materia3_id == 0 || $professor->materia3_id == null) {{$professor->materia3_id}} @else {{$materias[$num3]->nm_materia}} @endif </td>

      <td>  
        
      <a href="{{url("professor/$professor->id/edit")}}"">
                    <button class="btn btn-primary">Editar</button>
                        
                    </a>

    
      </td>
      
    </tr>
  </tbody>
</table>
    
    <div>
      
        
    </div>

    
    
    

</div>
@endsection