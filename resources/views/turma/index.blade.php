
@extends('layouts.paginas');
@section('content')
<br/>

<main role="main" class="container">
  <div class="container">
    <div class="row">
      <h2>Cadastro de Horarios Turma</h2>      
      <hr />
    </div>
    @foreach($horarioTurmas as $horarioturma)   
    
        @php
        
            
            $seguimento=$horarioturma->find($horarioturma->id)->relSeguimento;
            $serie=$horarioturma->find($horarioturma->id)->relSerie;
            $turno=$horarioturma->find($horarioturma->id)->relTurno;
            $turma=$horarioturma->find($horarioturma->id)->relTurma;
        
        @endphp


    <div class="row">
            <div class="form-group col-md-3">
                    <select id="segui" name="segui" class="form-control" disabled>
                        <option >{{$seguimento->nm_seguimento}}</option>                
                            
                    </select>
                    
                    </div>
                        <div class="form-group col-md-3">
                         
                    <select id="serie1" name="serie1" class="form-control" disabled> 
                    <option selected>{{$serie->nm_serie}}</option>

                    </select>
                    </div>
                    <div class="form-group col-md-3">
                      <select id="turma_id" name="turma_id" class="form-control" disabled>
                       <option selected>{{$turma->nm_turma}}</option>
                          
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <select id="turno_id" name="turno_id" class="form-control" disabled>
                          <option selected>{{$turno->nm_turno}}</option>
                          
                      </select>
                    </div>
                    <button type="submit" class="btn btn-secondary">Voltar na Turma</button>
    </div>
    <br />
@endforeach          
    <div class="col-12  m-auto" >
  
   
   
    </div>
  </div>  



@section('post-script')

<script>
  var i = 0;
$("#add-btn").click(function(){
++i;
$("#dynamicAddRemove").append('<tr><td><input type="text" name="moreFields['+i+'][professor_id]"placeholder="Professor" class="form-control" /></td><td> <select class="custom-select" name="moreFields['+i+'][disciplina_id]"require><option >Disciplina</option><option value="">oi </option></select></td><td><button type="button" class="btn btn-danger remove-tr">Remover</button></td></tr>');
});
$(document).on('click', '.remove-tr', function(){  
$(this).parents('tr').remove();
});  

$(function(){
$('form[name="fCadturma"]').submit(function(event){
  event.preventDefault();
  $.ajax({
    url:"{{url('turma/cadastroHorarioProf')}}",
    type:"post",
    data:$(this).serialize(),
    dataType:"json",
    success:function(response){
      console.log(data);

      if(response.success === true){
        //redirecionar
           window.location.href="{{url('turma')}}";
      }
      else{
        console.log('erro '+response.menssagem)
      }
    }
  });
  
  
});
});
    jQuery(document).ready(function ()
    {
            jQuery('select[name="segui"]').on('change',function(){
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
    });





    $("#nr_filhos").change(function () {
      


      let num = $(this).val();
      if (num != "") {
        $("#boxTbodyAlunoSerie").html("");
        for (let i = 1; i <= num; i++) {


          $("#boxTbodyAlunoSerie").append(
            "<tr><td width='50%'><select name='seriePreinscricao" +
                              "' class='form-control serieInsc' >" +"<option value="+professor+">"+professor+"</option>"+
                              
                                      
              i +
              
              "' class='form-control alunoInsc' /></td><td width='50%'><select name='seriePreinscricao" +
               
              i +
             
              "' class='form-control serieInsc' > " +"<option value="+professor+">"+professor+"</option>"+
              
              "</select></td></tr"
          );
        }
        $("#tabelaAlunosSerie").show();
        $("#btEnviar").prop("disabled", false);
      } else {
        $("#tabelaAlunosSerie").hide();
        $("#btEnviar").prop("disabled", true);
      }
  
    });
  





</script>


@endsection

@endsection

