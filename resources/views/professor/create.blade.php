@extends('layouts.professor')
@section('content')

<br>

<div class="container">
<div class="text-center">
<h1 class="mb-8">@if(isset($professor))Editar Professor(a) @else Cadastrar Professor(a) @endif </h1>

   <a href="/professor">
<button class="btn btn-success">Voltar</button>
</a> 
</div>


@if(isset($professor))
    <form action="{{url("professor/$professor->id")}}" name="fEdit" id="fEdit" method="post"  >@method('PUT')
    @else
    <form class="text-center border border-light p-5" action="{{url('professor')}}" name="fCad" id="fCad" method="post">
    @endif

  @csrf 

    <div class="form-row mb-2">

        @foreach($professores as  $professor)
            @php
                $materia1_id = $professor->find($professor->id)->relMateria; 
            @endphp
            
        @endforeach

    <div class="col-2">
           <label for="Matricula">Matricula</label>
            <input type="number"  min=1 id="matricula" name="matricula"  class="form-control" onchange="funcaoMatricula()"   value="{{$professor->matricula ??''}}" required>
            <input type="text" id="id" name="id" class="form-control" value=""   hidden>
        </div>
        <div class="col-7">
        <label for="nome">Nome</label>
            <input type="text" id="nm_professor" name="nm_professor" class="form-control"   value="{{$professor->nm_professor ??''}}" required>
        </div>
        <div class="col">
        
            <input type="text" id="unidade_id" name="unidade_id" class="form-control" value="{{$usuario->unidade_id}}"   hidden>
        </div>
        <div class="col-2">
            <label for="">Carga Horária</label>
            <input type="text" step="1" min=1 max=60 id="carga_horaria" name="carga_horaria"  class="form-control" value="{{$professor->carga_horaria ??''}}"  required>
        </div>

           
      
    </div>
    
    
        <div class="form-row mb-12">

        
     <div class="col-4">
     <div class="col">
   
     <label for="">Disciplina 1</label>
                      <select class="custom-select" id="materia1_id" name="materia1_id">
                      <option value="{{$professor->relMateria->id ?? ''}}">Disciplina</option>
                            @foreach($materias as $materia1_id )
                            
                              <option value="{{$materia1_id->id}}">{{$materia1_id->nm_materia}}</option>
                              @endforeach
                            
                      </select> 
                  </div>

    </div>
    <div class="col-4">
     <div class="col">
     <label for="">Disciplina 2</label>
                      <select class="custom-select" id="materia2_id" name="materia2_id">
                  
                      <option value="0">Disciplina</option>
                  
                            @foreach($materias as $materia2_id )
                              <option value="{{$materia2_id->id}}">{{$materia2_id->nm_materia}}</option>
                              @endforeach
                            
                      </select> 
                  </div>

    </div>
    <div class="col-4">
     <div class="col">
     <label for="">Disciplina 3</label>
                      <select class="custom-select" id="materia3_id" name="materia3_id">
                      <option value="0">Disciplina</option>
                            @foreach($materias as $materia3_id )
                              <option value="{{$materia3_id->id}}">{{$materia3_id->nm_materia}}</option>
                              @endforeach
                            
                      </select> 
                  </div>


    </div>
    </div>

    <!-- Sign up button -->
    <input class="btn btn-info my-4 btn-block"  value="@if(isset($professor))Editar @else Cadastrar @endif"  type="submit">
   
    <hr>

   

</form>
<!-- Default form register -->
</div>

<script>
funcaoMatricula = function(){
    var mat =$('#matricula').val();
    $('#id').val(mat);
    

}
$('.custom-select').select2({
    
           placeholder: "Disciplina",
           allowClear: true
          });




</script>

@endsection