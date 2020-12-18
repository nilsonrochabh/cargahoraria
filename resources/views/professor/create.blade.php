@extends('layouts.layout')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
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
  <div class="col-2">
    <label for="matricula" hidden>Matricula</label>
     <input type="number"  min=1 id="matricula" name="matricula"  class="form-control" hidden onchange="funcaoMatricula()"   value="{{$professor->matricula ??''}}">
     <input type="text" id="id" name="id" class="form-control" value=""   hidden>
 </div>
    <div class="form-row mb-2">


    
        <div class="col-7">
        <label for="nome">Nome</label>
            <input type="text" id="nm_professor" name="nm_professor" class="form-control"   value="{{$professor->nm_professor ??''}}" required>
        </div>
        <div class="col">
        
            <input type="text" id="unidade_id" name="unidade_id" class="form-control" value="{{$usuario->unidade_id}}"   hidden>
        </div>
        <div class="col-2">
            <label for="">Carga Horária Vigente</label>
            <input type="text" step="1" min=1 max=60 id="carga_horaria" name="carga_horaria"  class="form-control" value="{{$professor->carga_horaria ??''}}"  required>
        </div>
      
      
    </div>
  
    
        <div class="form-row mb-12">

        
     <div class="col-3">
     <div class="col">

      

        
      @php 
      $num1=$professor->materia1_id;
      $num2=$professor->materia2_id;
      $num3=$professor->materia3_id;
      $num4=$professor->materia4_id;
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
       if ($materia->id == $num4) {
         $mat4 = $materia->nm_materia;
       }
      }
      //dd($mat1)
      
      
     
        @endphp
      
       

 
     <label for="">Disciplina 1</label>
                      <select class="custom-select" id="materia1_id" name="materia1_id">
                      <option value="{{$professor->materia1_id ?? ''}}">{{$mat1 ?? ''}} </option>
                      
                            @foreach($materias as $materia1_id )
                              <option value="{{$materia1_id->id}}">{{$materia1_id->nm_materia}}</option>
                              @endforeach
                            
                      </select> 
                  </div>

    </div>
    <div class="col-3">
     <div class="col">
     <label for="">Disciplina 2</label>
                      <select class="custom-select" id="materia2_id" name="materia2_id">
                  
                        <option value="{{$professor->materia2_id ?? ''}}">{{$mat2 ?? ''}} </option>
                  
                            @foreach($materias as $materia2_id )
                              <option value="{{$materia2_id->id}}">{{$materia2_id->nm_materia}}</option>
                              @endforeach
                            
                      </select> 
                  </div>

    </div>
    <div class="col-3">
     <div class="col">
     <label for="">Disciplina 3</label>
                      <select class="custom-select" id="materia3_id" name="materia3_id">
                        <option value="{{$professor->materia3_id ?? ''}}">{{$mat3 ?? ''}} </option>
                            @foreach($materias as $materia3_id )
                              <option value="{{$materia3_id->id}}">{{$materia3_id->nm_materia}}</option>
                              @endforeach
                            
                      </select> 
                  </div>

<br>
    </div>
    <div class="col-3">
      <div class="col">
      <label for="">Disciplina 4</label>
                       <select class="custom-select" id="materia4_id" name="materia4_id">
                         <option value="{{$professor->materia4_id ?? ''}}">{{$mat4 ?? ''}} </option>
                             @foreach($materias as $materia4_id )
                               <option value="{{$materia4_id->id}}">{{$materia4_id->nm_materia}}</option>
                               @endforeach
                             
                       </select> 
                   </div>
 
 <br>
     </div>
 
    
    
    <!-- Sign up button -->
    <input class="btn btn-info my-4 btn-block"  value="@if(isset($professor))Editar @else Cadastrar @endif"  type="submit">
   
    <hr>

   

</form>
<!-- Default form register -->
</div>



  </form>
    </div>
  </div>
</div>

@section('post-script')


<script >
  $(document).ready(function(){
      $('.add').on('click',function(e){
          e.preventDefault();
          var id = $('#matricula').val();
         
          $.ajax({
                type:"PUT",
                url:"/professor/adddisciplina" +id,
                data:$('#addform').serialize(),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(response){
                    console.log(response);
                    
                },
                erro: function(erro){
                    console.log(error)
                    alert("Error");
                }
            });

         
      });
  });







funcaoMatricula = function(){
    var mat =$('#matricula').val();
    $('#id').val(mat);
    

}





</script>
@endsection
@endsection