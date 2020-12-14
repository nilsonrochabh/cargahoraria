@extends('layouts.layout')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<br>

<div class="container">
<div class="text-center">
<h1 class="mb-8">Cadastrar Professor(a)  </h1>

   <a href="/professor">
<button class="btn btn-success">Voltar</button>
</a> 
</div>





<form class="text-center border border-light p-5" action="{{url('professor')}}" name="fCad" id="fCad" method="post">
 @csrf 
    <div class="form-row mb-2">
    <div class="col-2">
           <label for="Matricula">Matricula</label>
            <input type="number"  min=1 id="matricula" name="matricula"  class="form-control" onchange="funcaoMatricula()"   value="{{$professor->matricula ??''}}" required>
            <input type="text" id="id" name="id" class="form-control" value=""   hidden>
        </div>
        <div class="col-7">
        <label for="nome">Nome</label>
            <input type="text" id="nm_professor" name="nm_professor" class="form-control"   value="" required>
        </div>
        <div class="col">
        
            <input type="text" id="unidade_id" name="unidade_id" class="form-control" value="{{$usuario->unidade_id}}"   hidden>
        </div>
        <div class="col-2">
            <label for="">Carga Horária Vigente</label>
            <input type="text" step="1" min=1 max=60 id="carga_horaria" name="carga_horaria"  class="form-control" value=""  required>
        </div>

           

      
    </div>
       
        <div class="form-row mb-12">             
        
            <div class="col-3">
                <table class="table table-bordered" >
                
                     <thead>
                         <tr>
                             <th>Disciplina 1</th>    
                         </tr>
                     </thead>
                     <tbody >       
                             <td >  
                               <select id="materia_id" name="materia_id" class="form-control"   required="true" >
                               <option value="0"> </option>
                                 @foreach($materias as $materia )
                                 <option value="{{$materia->id}}">{{$materia->nm_materia}}</option>
                                 @endforeach
                             </select>
                             </td> 
                            <tr id="tr">
                       </tr>
                      
                     </tbody>
                 </table >
                </div>
                <div class="col-3">
                    <table class="table table-bordered" >
                
                        <thead>
                            <tr>
                                <th>Disciplina 2</th>    
                            </tr>
                        </thead>
                        <tbody >       
                                <td >  
                                  <select id="materia_id" name="materia_id" class="form-control"   required="true" >
                                  <option value="0"> </option>
                                    @foreach($materias as $materia )
                                    <option value="{{$materia->id}}">{{$materia->nm_materia}}</option>
                                    @endforeach
                                </select>
                                </td> 
                               <tr id="tr">
                          </tr>
                         
                        </tbody>
                    </table >
                    </div>
                    <div class="col-3">
                        <table class="table table-bordered" >
                
                            <thead>
                                <tr>
                                    <th>Disciplina 3</th>    
                                </tr>
                            </thead>
                            <tbody >       
                                    <td >  
                                      <select id="materia_id" name="materia_id" class="form-control"   required="true" >
                                      <option value="0"> </option>
                                        @foreach($materias as $materia )
                                        <option value="{{$materia->id}}">{{$materia->nm_materia}}</option>
                                        @endforeach
                                    </select>
                                    </td> 
                                   <tr id="tr">
                              </tr>
                             
                            </tbody>
                        </table >
                        </div>                         
          </div>
   
        </div>

    </div>


  
    <hr>

    <input class="btn btn-info my-4 btn-block"  value=" Cadastrar"  type="submit">
</form>
  <!-- Sign up button -->
</div>


<script >
    $(document).ready(function(){
        $('#addDisciplina').on('click',function(e){
            e.preventDefault();
            var id = $("#id").val();
            console.log(id)
            $.ajax({
                type:"POST",
                url:"/professor/adddisciplina",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:$('#addform').serialize(),
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

</script>


<script>
funcaoMatricula = function(){
    var mat =$('#matricula').val();
    $('#id').val(mat);
    

}



</script>

@endsection