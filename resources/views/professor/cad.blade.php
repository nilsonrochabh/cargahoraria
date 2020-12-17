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
        <br>
         

      
    </div>
    <div class="form-row mb-12">
        <div class="col-4">
          <label for="">Disciplina 1</label>
          <select class="custom-select" id="materia1_id" name="materia1_id">
          <option value="{{$professor->materia1_id ?? ''}}">{{$mat1 ?? ''}} </option>
          
                @foreach($materias as $materia1_id )
                  <option value="{{$materia1_id->id}}">{{$materia1_id->nm_materia}}</option>
                  @endforeach
                
          </select> 
      </div>


                <div class="col-4">
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
                <div class="col-4">
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

  
    </div>
       
        {{-- <div class="form-row mb-12"> 
                        
            <div class="col-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Adicionar Disciplina
                  </button>
            </div>  --}}
    <hr>

    <input class="btn btn-info my-4 btn-block"  value=" Cadastrar"  type="submit">
</form>
  <!-- Sign up button -->
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Adicionar Disciplina</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <form action="" id="addmateria">
            @csrf
            <input type="text" id="id" name="id" class="form-control" value=""   hidden>

            <thead>
                <tr>
                    <th>Disciplina</th>    
                </tr>
            </thead>
            <tbody>       
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
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </div>
    </div>
</form>
  </div>



<script >
    $(document).ready(function(){
        $('#addmateria').on('click',function(e){
            e.preventDefault();
            $.ajax({
                type:"POST",
                url:"/professor/adddisciplina",
                data:$('#addmateria').serialize(),
                success:function(response){
                    var materia = $("#materia_id").val();
                    console.log(materia);
                    console.log(response);
                   
                    var tr='<tr>'+
                                
                                '<td><a href="#" class="btn btn-danger remove"><i class="glyphicon glyphicon-remove"></i>Remover</a></td>'+
                            '</tr>';
                            $('#tab').append(tr);
                            $('body').on('click','.remove',function(){
                            var last=$('tr').length;
                            if(last==1){
                                alert("you can not remove last row");
                            }
                            else{ 
                                $(this).parent().parent().remove(); 
                               
                                }
                            
                        });
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