@extends('layouts.layout');
@section('content')
<main role="main" class="container">
  <div class="container">
  <div class="mt-3 mb-4">
    <div class="text-center">
    
    
    <h1 class="text-center" >@if(isset($atividade))Editar Atividade Extra Classe @else Cadastrar Atividade Extra Classe @endif</h1>
      
    <a href="{{url('atividade')}}">
      <button class="btn btn-success">Voltar</button>
    </a>

      <hr />
  

  </div>
  </div>
    <div class="col-12  m-auto" >
    
    @if(isset($atividade))
    <form action="{{url("atividade/$atividade->id")}}" name="fEdit" id="fEdit" method="post"  >@method('PUT')
    @else
      <form action="{{url('atividade')}}" name="fCad" id="fCad" method="post" >
    @endif

        @csrf   
      <!-- {{$usuario->unidade_id}} -->
        
                <div class="row">
                        <div class="form-group col-md-4">
                             <select id="professor_id" name="professor_id" class="form-control"  required > 
                             <option value="{{$atividade->relProfessor->id ?? ''}}">{{$atividade->relProfessor->nm_professor ?? 'Professor(a)'}}</option>
                            @foreach($professores as $professor)    
                                @if($professor->unidade_id === $usuario->unidade_id)   

                                <option value="{{$professor->id ?? ''}}">{{$professor->nm_professor ?? ''}}</option>
                              @endif    
                            @endforeach
                        </select>                  

                    </div>
                    <div class="form-group col-md-3">
                    <select id="segui" name="segui" class="form-control" >
                    <option value="{{$atividade->relSeguimento->id ?? ''}}">{{$atividade->relSeguimento->nm_seguimento ?? 'Seguimento'}}</option>
                        @foreach($seguimentos as $seguimento)
                            <option value="{{$seguimento->id}}">{{$seguimento->nm_seguimento}}</option>
                            @endforeach    
                    </select>
                    
                    </div>
                        <div class="form-group col-md-3">

                    <select id="serie1" name="serie1" class="form-control"> 

                        <option value="{{$atividade->relSerie->id ?? '9051'}}">{{$atividade->relSerie->nm_serie ?? '9051 - Fixo'}}</option>
                    </select>
                    
                    </div>
         
                    <div class="form-group col-md-10">
                      <select id="evento_id" name="evento_id" class="form-control" required >
                      <option value="{{$atividade->relEvento->id ?? ''}}">{{$atividade->relEvento->nm_evento ?? 'Evento'}}</option>

                            @foreach($eventos as $evento)
                              @if($evento->unidade_id === $usuario->unidade_id)
                                <option value="{{$evento->id}}">{{$evento->nm_evento}}</option>
                                @endif
                            @endforeach 
                            </select>
                    </div>
                    </div>
                    <div class="form-group col-md-3">
                         <label for="historico">Histórico Hora</label>
                         <input type="text" name="historico" id="historico" value="{{$atividade->historico ??''}}" disabled>

                         <label for="hora">Horas</label>
                         <input type="number" min="1" max="66" name="hora" id="hora" value="{{$atividade->hora ??''}}">

                         <input type="text" name="unidade_id" id="unidade_id" value="{{$usuario->unidade_id}}" hidden>
                         
                    </div>
         
                        <br>
                    
                    <div class="form-group col-md-10 ">
                    <textarea id="justificativa" name="justificativa"  placeholder="Justificativa..." class="md-textarea form-control" rows="4"   required >{{$atividade->justificativa ?? ''}}</textarea>
                    </div>
                </div>
                
                <input class="btn btn-info my-4 btn-block"  value="@if(isset($atividade))Editar @else Cadastrar @endif"  type="submit">
              </div>
        </form>

@section('post-script')

<script type="text/javascript">
   $("#professor_id").select2({
           placeholder: "Professor",
           allowClear: true
          });
  $("#evento_id").select2({
                    placeholder: "Evento",
                    allowClear: true
                    });

jQuery(document).ready(function ()
    {
    });
    jQuery(document).ready(function ()
    {         jQuery('select[name="segui"]').on('change',function(){
               var segui_id = jQuery(this).val();
               if(segui_id)
               {
                  jQuery.ajax({
                     url : '/turma/getSeries/' +segui_id,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="serie1"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="serie1"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="serie1"]').empty();
               }
            });



 

    jQuery('select[name="professor_id"]').on('change',function(){        
        var prof_id = jQuery(this).val();
        console.log(prof_id);
        if(prof_id)
         {
            jQuery.ajax({
               url : '/atividade/getHora/' +prof_id,
               type : "GET",
               dataType : "json",
               success:function(data)
               {
                  console.log(data);
                jQuery('input[name="historico"]').empty();
                    jQuery.each(data, function(key,value){
                       $('input[name="historico"]').val(value.h_hora);
                    });
                }
            });
         }
       
     });
    });




    </script>


@endsection
@endsection