@extends('layouts.professor');
@section('content')

<br>

<div class="container">
<div class="text-center">
 <h1 class="mb-8">@if(isset($professor))Enturmar Professor @else Cadastrar Professor(a) @endif </h1> 


   <a href="/professor">
<button class="btn btn-success">Voltar</button>
</a> 
</div>


@if(isset($professor))
    <form action="{{url("professor/professorturma")}}" name="fEdit" id="fEdit" method="post" >
    @else
    <form class="text-center border border-light p-5" action="{{url('professor/professorturma')}}" name="fCad" id="fCad" method="post">
    @endif

  @csrf 
    <div class="form-row mb-4">
        <div class="col-2">
             <label for="Matricula">Matricula</label>
                <input type="number"  min=1 id="matricula" name="matricula"  class="form-control" onchange="funcaoMatricula()"   value="{{$professor->matricula ??''}}" disabled="">
        <input type="text" id="professor_id" name="professor_id" class="form-control" value="{{$professor->id}}"   hidden>
        </div>
        <div class="col-7">
            <label for="nome">Nome</label>
                <input type="text" id="nm_professor" name="nm_professor" class="form-control"   value="{{$professor->nm_professor ??''}}" disabled="">
        </div>
      
        <div class="col">
        
                <input type="text" id="unidade_id" name="unidade_id" class="form-control" value="{{$usuario->unidade_id}}"   hidden>
        </div>
      
    </div>
    
    @php 
     
    $num1=$professor->materia1_id;
    $num2=$professor->materia2_id;
    $num3=$professor->materia3_id;
    //dd($num1);
    foreach ($materias as $key => $materia) {
       
     if ($materia->id == $num3) {
         $seg_id = $materia->seguimento_id;
         $mat3 = $materia;
         
     }
     if ($materia->id == $num2) {
        $seg_id = $materia->seguimento_id;
        $mat2 = $materia;         
        
     }
     if ($materia->id == $num1) {
        $seg_id = $materia->seguimento_id;
       $mat1 = $materia;
       
     }
     
    }    
    @endphp    
  <div class="form-row mb-4">
            <div class="col-3">
                <div class="md-form">
                    <label for="">Disciplina</label>
                    <select class="custom-select" id="materia_id" name="materia_id">
                         <option value="0"> </option> 
                    <option value="{{$professor->materia1_id ?? '' }}" dado="{{$mat1->seguimento_id}}">{{$mat1->nm_materia ?? ''}}  </option>
                        <option value="{{$professor->materia2_id ?? ''}}" dado="{{$mat2->seguimento_id}}">{{$mat2->nm_materia ?? ''}} </option>
                        <option value="{{$professor->materia3_id ?? ''}}" dado="{{$mat3->seguimento_id}}">{{$mat3->nm_materia ?? ''}} </option>

                    </select> 
                </div>
            </div>
            <div class="col-3">
                <div class="md-form">
                    <label for="">Seguimento</label>
                    <select class="custom-select" id="seguimento_id" name="seguimento_id">
                        <option value=""> </option>
                    </select> 
                </div>
            </div>
           
            <div class="col-3">
                <div class="md-form">
                    <label for="">Série</label>
                    <select class="custom-select" id="serie_id" name="serie_id">
                        <option value=""> </option>
                    </select> 
                </div>
            </div>
            
        </div>
        <div class="form-row mb-4">
            <div class="col">
                <div class="md-form">
                    <label for="">Dia Semana</label>
                    <select class="custom-select" id="diasemana_id" name="diasemana_id">
                    <option value="0">Dia Semana</option> 
                    @foreach($diasemana as $dia )
                        <option value="{{$dia->id}}">{{$dia->nm_diasemana}}</option>
                    @endforeach  
                    </select> 
                
                </div>
            </div>
            <div class="col">
                <!-- Last name -->
                <div class="md-form">
                    <label for="">Turma</label>
                    <select class="custom-select" id="turma_id" name="turma_id">
                      <option value="0">Turma</option>
                          @foreach($turmas as $turma )
                            <option value="{{$turma->id}}">{{$turma->nm_turma}}</option>
                            @endforeach   
                    </select> 
                </div>
            
            </div>       
            <div class="md-form">
                <label for="">Turno</label>
                <select class="custom-select" id="turno_id" name="turno_id">
            
                <option value="0">Turno</option>
                      @foreach($turno as $tur )
                        <option value="{{$tur->id}}">{{$tur->nm_turno}}</option>
                        @endforeach
                      
                </select> 
            </div>
        <input type="hidden" name="usuario_id" id="usuario_id" value="{{$usuario->id}}">
            
        </div>

    <!-- Sign up button -->
    <input class="btn btn-info my-4 btn-block"  value="Cadastrar" type="submit">
   
    <hr>


    
</form>
@section('post-script')



<script>



funcaoMatricula = function(){
    var mat =$('#matricula').val();
    $('#id').val(mat);
    

}

jQuery(document).ready(function (){    
   jQuery('select[name="materia_id"]').on('change',function(){
         var mat_id = $(this).find(':selected').attr('dado');
                 //console.log('valor', mat_id);
                    
              //console.info(mat_id);             
               if(mat_id)
               {
                  jQuery.ajax({
                     url : '/turma/getSeguimento/' +mat_id,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        //console.log(data);
                        jQuery('select[name="seguimento_id"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="seguimento_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="seguimento_id"]').empty();
               }
            });

});
jQuery(document).ready(function (){    
   jQuery('select[name="seguimento_id"]').on('click',function(){
               var segui_id = jQuery(this).val();
               console.log("aqui "+ segui_id);
               if(segui_id)
               {
                  jQuery.ajax({
                     url : '/turma/getSeries/' +segui_id,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="serie_id"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="serie_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="serie_id"]').empty();
               }
            });

});



</script>
@endsection
@endsection