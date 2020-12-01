@extends('layouts.layout')
@section('content')

<br>

<div class="container">


  <form class="text-center border border-light p-5" action="{{url('professor')}}" name="fCad" id="fCad" method="post">
  @csrf 
    <p class="h4 mb-8">Cadastro de Professor</p>

    <div class="form-row mb-2">

    <div class="col-2">
           <label for="Matricula">Matricula</label>
            <input type="number"  min=1 id="matricula" name="matricula"  class="form-control" onchange="funcaoMatricula()"  required>
            <input type="text" id="id" name="id" class="form-control" value=""   hidden>
        </div>
        <div class="col-10">
        <label for="nome">Nome</label>
            <input type="text" id="nm_professor" name="nm_professor" class="form-control"   required>
        </div>
        <div class="col">
        
            <input type="text" id="unidade_id" name="unidade_id" class="form-control" value="{{$usuario->unidade_id}}"   hidden>
        </div>
      
    </div>
    
    
        <div class="form-row mb-12">

            <div class="col-2">
                <label for="">Carga Horária</label>
                <input type="time" min=1 max=60 id="carga_horaria" name="carga_horaria"  class="form-control"  required>
            </div>

                

     <div class="col-3">
     <div class="col">
     
     <label for="">Disciplina 1</label>
                      <select class="custom-select" id="materia1_id" name="materia1_id">
                      <option value="0">Disciplina</option>
                            @foreach($materias as $materia )
                              <option value="{{$materia->id}}">{{$materia->nm_materia}}</option>
                              @endforeach
                            
                      </select> 
                  </div>

    </div>
    <div class="col-3">
     <div class="col">
     <label for="">Disciplina 2</label>
                      <select class="custom-select" id="materia2_id" name="materia2_id">
                  
                      <option value="0">Disciplina</option>
                  
                            @foreach($materias as $materia )
                              <option value="{{$materia->id}}">{{$materia->nm_materia}}</option>
                              @endforeach
                            
                      </select> 
                  </div>

    </div>
    <div class="col-3">
     <div class="col">
     <label for="">Disciplina 3</label>
                      <select class="custom-select" id="materia3_id" name="materia3_id">
                      <option value="0">Disciplina</option>
                            @foreach($materias as $materia )
                              <option value="{{$materia->id}}">{{$materia->nm_materia}}</option>
                              @endforeach
                            
                      </select> 
                  </div>


    </div>
    </div>

    <!-- Sign up button -->
    <button class="btn btn-info my-4 btn-block" type="submit">Cadastrar</button>

    <hr>

   

</form>
<!-- Default form register -->
</div>

<script>
funcaoMatricula = function(){
    var mat =$('#matricula').val();
    $('#id').val(mat);
    

}



</script>

@endsection