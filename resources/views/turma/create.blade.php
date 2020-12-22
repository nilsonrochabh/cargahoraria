@extends('layouts.paginas')
@section('content')



<meta name="csrf-token" content="{{ csrf_token() }}">

  <div class="container">
    <div class="row">
      <h2>Cadastro de Horarios Turma</h2>     
         
      <hr />
    </div>
    <div class="col-12  m-auto" >
      @if (isset($errors) && count($errors)>0)
      <div class="alert-danger text-center mt-4 mb-4 p-2" >
        @foreach ($errors->all() as $erro)
        {{$erro}}<br />
            
        @endforeach
      </div>

          
          
      @endif	
      <span class='msg-erro msg-nome'></span>
        <form name="fCad" id="fCad" method="post" action="{{url('turma')}}" onsubmit=" return valida_form() " >
        {{csrf_field()}}
            <div class="row">
       
            <div class="form-group col-md-3">
              <label for="Seguimento ">Seguimento</label>
                    <select id="seguimento_id" name="seguimento_id" class="form-control"   >
                      <option value=""></option>
                        @foreach($seguimentos as $seguimento)
                        
                            <option value="{{$seguimento->id}}">{{$seguimento->nm_seguimento}}</option>
                            @endforeach                             
                            
                    </select>
                    
                    </div>
                    
                    <div class="form-group col-md-3">
                      <label for="Seguimento ">Serie</label>
                    <select id="serie_id" name="serie_id" class="form-control"   required> 
                      
                    </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="Turma">Turma</label>
                      <select id="turma_id"  name="turma_id" class="form-control"   required="true">
                        <option value=""></option>
                          @foreach($turmas as $turma)
                          
                              <option value="{{$turma->id}}">{{$turma->nm_turma}}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-2" require>
                      <label for="Turno ">Turno</label>
                      <select id="turno_id" name="turno_id" class="form-control"   required="true" >
                        <option value=""></option>
                          @foreach($turnos as $turno )
                          <option value="{{$turno->id}}">{{$turno->nm_turno}}</option>
                          @endforeach
                      </select>
                    </div>
    </div>
    <hr>
    <input type="hidden" name="unidade_id" value="{{$usuario->unidade_id}}">       
            
    <!-- fazer o comparativo para saber usuario-->
    <input type="hidden" name="usuario_id" value="{{$usuario->id}}">              
    <div class="col-lg-12">
       <ul class="nav-timeline nav nav-pills" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link Mudarestado " id="segunda-tab" data-toggle="tab"    href="#segunda" role="tab">Segunda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="terca-tab" data-toggle="tab"    href="#terca" role="tab">Terça</a>
            </li>
           <li class="nav-item">
                <a class="nav-link" id="quarta-tab" data-toggle="tab"    href="#quarta" role="tab">Quarta</a>
              </li>
                
            <li class="nav-item">
                <a class="nav-link" id="quinta-tab" data-toggle="tab"   href="#quinta" role="tab">Quinta</a>
              </li>
                
            <li class="nav-item">
                <a class="nav-link" id="sexta-tab" data-toggle="tab"   href="#sexta" role="tab">Sexta</a>
              </li>
          </ul>          
    </div>
        <div class="tab-content" id="myTabContent">

         <div class="tab-pane fade" id="segunda" role="tabpanel" aria-labelledby="segunda-tab" >
            <ul class="list-group mt-4">
                <h2>Segunda</h2>
                </ul>       
                <table class="table table-bordered" >  
                <tr>
                <th>Horário</th>
                <th>Professor</th>
                <th>Disciplina</th>
                <th>Ação</th>
                </tr>
                <tbody id="tab1">
                <tr>
              <td>1ª Horário</td>
                <td>
                   <input type="hidden" name="diasemana_id[]" id="diasemana_id[]" value="{{$diasemana[0]->id}}">
                   <input type="hidden" name="horario_id[]" id="horario_id[]" value="{{$horarios[0]->id}}">

                <select class="custom-select" id="professor_id[]" name="professor_id[]" >
                                    <option value="0"></option>
                                          @foreach($professores as $professor )
                                       
                                          @if($professor->unidade_id === $usuario->unidade_id)   

                                          <option value="{{$professor->id ?? ''}}">{{$professor->nm_professor ?? ''}}</option>
                                           @endif 
                                          @endforeach
                                  </select>
                  </td>  
                <td>
                  <select id="materia_id[]" name="materia_id[]" class="form-control" required="true" > <option value=""></option> </select>                    
                <td><button type="button" class="addRow1" name="add" id="add-btn" class="btn btn-success">Adicionar Horário</button></td>  
                </tr>  
                </tbody>
                </table>
          </div>        

          <div class="tab-pane fade terca" id="terca" role="tabpanel" aria-labelledby="terca-tab">
            <ul class="list-group mt-4">
              <h1>TERÇA</h1>
              </ul>  
               <table class="table table-bordered" >  
                <tr>
                <th>Horário</th>
                <th>Professor</th>
                <th>Disciplina</th>
                <th>Ação</th>
                </tr>
                <tbody id="tab2" >
                <tr> 
                  <td>1ª Horário</td>
                   <input type="hidden" name="diasemana_id[]" id="diasemana_id[]" value="{{$diasemana[1]->id}}">
                   <input type="hidden" name="horario_id[]" id="horario_id[]" value="{{$horarios[0]->id}}">
                <td>
                <select class="custom-select" id="professor_id[]" name="professor_id[]"  data-required="true" >
                                    <option value="0"></option>
                           
                                          @foreach($professores as $professor )
                                         
                                          @if($professor->unidade_id === $usuario->unidade_id)   

                                          <option value="{{$professor->id ?? ''}}">{{$professor->nm_professor ?? ''}}</option>
                                           @endif 
                                          @endforeach
                                  </select>
                  </td>  
                <td>
                  <select id="materia_id[]" name="materia_id[]" class="form-control"   data-required="true" > 
                    <option value="0" ></option>
                  </select>                    
                  
                <td><button type="button" class="addRow2" name="add" id="add-btn" class="btn btn-success">Adicionar Horário</button></td>  
                </tr>  
                </tbody>
                </table>
          </div>

        <div class="tab-pane fade" id="quarta" role="tabpanel" aria-labelledby="quarta-tab">
              <ul class="list-group mt-4">
              <h1>Quarta</h1>
              </ul>

               <table class="table table-bordered" >  
                <tr>
                  <th>Horário</th>
                <th>Professor</th>
                <th>Disciplina</th>
                <th>Ação</th>
                </tr>
                <tbody id="tab3" >
                <tr> 
                  <td>1ª Horário</td>
                   <input type="hidden" name="diasemana_id[]" id="diasemana_id[]" value="{{$diasemana[2]->id}}">
                   <input type="hidden" name="horario_id[]" id="horario_id[]" value="{{$horarios[0]->id}}">
                <td>
                <select class="custom-select" id="professor_id[]" name="professor_id[]" >
                                    <option value="0" ></option>
                                          @foreach($professores as $professor )
                                         
                                          @if($professor->unidade_id === $usuario->unidade_id)   

                                          <option value="{{$professor->id ?? ''}}">{{$professor->nm_professor ?? ''}}</option>
                                           @endif 
                                          @endforeach
                                  </select>
                  </td>  
                <td>
                  <select id="materia_id[]" name="materia_id[]" class="form-control"   required="true" > 
                    <option value="0"></option> 
                  </select>      
                <td><button type="button" class="addRow3" name="add" id="add-btn" class="btn btn-success">Adicionar Horário</button></td>  
                </tr>  
                </tbody>
                </table>

         
         
              
                  
        </div>

          <div class="tab-pane fade" id="quinta" role="tabpanel" aria-labelledby="quinta-tab">
              <ul class="list-group mt-4">
              <h1>Quinta</h1>
              </ul>


               <table class="table table-bordered" >  
                <tr>
                  <th>Horário</th>
                <th>Professor</th>
                <th>Disciplina</th>
                <th>Ação</th>
                </tr>
                <tbody id="tab4" >
                <tr> 
                  <td>1ª Horário</td>
                   <input type="hidden" name="diasemana_id[]" id="diasemana_id[]" value="{{$diasemana[3]->id}}">
                   <input type="hidden" name="horario_id[]" id="horario_id[]" value="{{$horarios[0]->id}}">
                <td>
                <select class="custom-select" id="profquinta" name="professor_id[]" >
                                    <option value="0"></option>
                                          @foreach($professores as $professor )
                                        
                                          @if($professor->unidade_id === $usuario->unidade_id)   

                                          <option value="{{$professor->id ?? ''}}">{{$professor->nm_professor ?? ''}}</option>
                                           @endif 
                                          @endforeach
                                  </select>
                  </td>  
                <td>
                  <select id="materia_id[]" name="materia_id[]" class="form-control"   required="true" > 
                    <option value="0"></option> 
                  </select>              
                  
                <td><button type="button" class="addRow4" name="add" id="add-btn" class="btn btn-success">Adicionar Horário</button></td>  
                </tr>  
                </tbody>
                </table>

          </div>

          
        <div class="tab-pane fade" id="sexta" role="tabpanel" aria-labelledby="sexta-tab">
              <ul class="list-group mt-4">
                <h1>Sexta</h1>
              </ul>
                <div id="">
                <table class="table table-bordered" >  
                <tr>
                  <th>Horário</th>
                <th>Professor</th>
                <th>Disciplina</th>
                <th>Ação</th>
                </tr>
                <tbody id="tab5">
                <tr> 
                  <td>1ª Horário</td>
                
                <td>
                <input type="hidden" name="diasemana_id[]" id="diasemana_id[]" value="{{$diasemana[4]->id}}">
                   <input type="hidden" name="horario_id[]" id="horario_id[]" value="{{$horarios[0]->id}}">
                <select class="custom-select" id="professorsexta_id[]" name="professor_id[]" >
                                    <option value="0"></option>
                                          @foreach($professores as $professor )
                                              @if($professor->unidade_id === $usuario->unidade_id)   
                                          <option value="{{$professor->id ?? ''}}">{{$professor->nm_professor ?? ''}}</option>
                                           @endif 
                                          @endforeach
                                  </select>
                  </td>  
                <td>
                  <select id="materiasexta_id[]" name="materia_id[]" class="form-control"   required="true" > 
                    <option value="0"></option> 
                  </select>              
                  
                <td><button type="button" class="addRow6" name="add" id="add-btn" class="btn btn-success">Adicionar Horário</button></td>  
                </tr>  
                </tbody>
                </table>

                </div>          
               
            </div>
        </div>

        <br>

 </div>  
     <div id="minhaDiv">
        <button type="submit" class="btn btn-primary"  id="button1" >Cadastrar Horários </button>
    </div>       
    </form>
    <hr> 
    </div>  
</main>


@section('post-script')



<script>



  
 


$('#seguimento_id').on('click',function(){
  var prof = $(('select[name="materia_id[]"]')).val();
  if(prof == 0 ){
    
    $('#button1').css('display','none');
  }  
});
 var prof = $('select[id="materiasexta_id[]"]').on('change', function(){
        let valor = $(this).val();
        console.log("Valor Escolhido foi: "+valor);
        $('#button1').css('display','block');
     
        });
       

  

var segui_id = 0
var mat =[];



 jQuery(document).ready(function (){    
   jQuery('select[name="seguimento_id"]').on('change',function(){
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



   





               



var diaSemana ={{$diasemana[1]->id}};
var i={{$horarios[0]->id}};''



$('#segunda-tab').on('click',function(){  
  

  console.log(segui_id);

   


  diaSemana=1;
  i=1;
$('.addRow1').on('click',function(){
          addRow();
 }); 
function addRow()
{
  i=i+1;
  console.log(i);
   var tr='<tr>'+
   '<td>'+i+'º Horário</td>'+
   '<td><select class="custom-select" id="professor_id[]" name="professor_id[]" ><option value="0">Professor</option>@foreach($professores as $professor)@if($professor->unidade_id === $usuario->unidade_id)<option value="{{$professor->id }}">{{$professor->nm_professor}}</option>@endif @endforeach</select></td>'+
   '<td><select class="custom-select" id="materia_id[]" name="materia_id[]" ><option value="0">Disciplina</option> @foreach($materias as $materia )<option value="{{$materia->id }}">{{$materia->nm_materia}}</option>@endforeach</select></td>'+
   '<td><a href="#" class="btn btn-danger remove" id="remover"><i class="glyphicon glyphicon-remove"></i>Remover</a></td>'+
   ' <input type="hidden" name="diasemana_id[]" id="diasemana_id[]" value="'+diaSemana+'">'+
   '  <input type="hidden" name="horario_id[]" id="horario_id[]" value="'+(i)+'">'+
   '</tr>';
    $('#tab1').append(tr);
   console.log('dia da semana '+diaSemana+' Horário'+ i);    
   console.log(i);
    };
    $('body').on('click','.remove',function(){
     var last=$('tr').length;
      if(last==1){
       alert("you can not remove last row");
      }
      else{ 
       $(this).parent().parent().remove(); 
      if(i<1){
      i++;
      }else{
     i=i-1;
                                                      }
                                                    }
                                              });
                                              console.log('dia da semana' +diaSemana+' Horário'+ i);

                                            
                                              
                                              

                                          }); 

                                     
   


 $('#terca-tab').on('click',function(){
  
    diaSemana=2;
    i=1;  
 
    $('.addRow2').on('click',function(){
        addRow();
    }); 
    function addRow()
    {
        i=i+1;
        console.log(i);
        var tr='<tr>'+
          '<td>'+i+'º Horário</td>'+
          '<td>  <select class="custom-select" id="professor_id[]" name="professor_id[]" ><option value="0"></option>@foreach($professores as $professor)@if($professor->unidade_id === $usuario->unidade_id)<option value="{{$professor->id }}">{{$professor->nm_professor}}</option>@endif @endforeach</select></td>'+ 
          '<td><select class="custom-select" id="materia_id[]" name="materia_id[]" ><option value="0">Disciplina</option> @foreach($materias as $materia )<option value="{{$materia->id }}">{{$materia->nm_materia}}</option>@endforeach</select></td>'+          '<td><a href="#" class="btn btn-danger remove"><i class="glyphicon glyphicon-remove"></i>Remover</a></td>'+
          ' <input type="hidden" name="diasemana_id[]" id="diasemana_id[]" value="'+diaSemana+'">'+
          '  <input type="hidden" name="horario_id[]" id="horario_id[]" value="'+(i)+'">'+
        '</tr>';
        $('#tab2').append(tr);
        console.log('dia da semana '+diaSemana+' Horário'+ i);    
        console.log(i);
      
    };
    $('body').on('click','.remove',function(){
        var last=$('tr').length;
        if(last==1){
            alert("you can not remove last row");
        }
        else{ 
             $(this).parent().parent().remove(); 
             if(i<1){
               i++;
             }else{
              i=i-1;
             }
          }
    });
    console.log('dia da semana' +diaSemana+' Horário'+ i);
    
 })

 $('#quarta-tab').on('click',function(){
    diaSemana=3;
    i=1;
    $('.addRow3').on('click',function(){
        addRow();
    }); 
    function addRow()
    {
        i=i+1;
        console.log(i);
        var tr='<tr>'+
          '<td>'+i+'º Horário</td>'+
          '<td>  <select class="custom-select" id="professor_id[]" name="professor_id[]" ><option value="0">Professor</option>@foreach($professores as $professor)@if($professor->unidade_id === $usuario->unidade_id)<option value="{{$professor->id }}">{{$professor->nm_professor}}</option>@endif @endforeach</select></td>'+        
          '<td>  <select class="custom-select" id="materia_id[]" name="materia_id[]" ><option value="0">Disciplina</option>@foreach($materias as $materia )<option value="{{$materia->id}}">{{$materia->nm_materia}}</option>@endforeach</select></td>'+
        '<td><a href="#" class="btn btn-danger remove"><i class="glyphicon glyphicon-remove"></i>Remover</a></td>'+
         '<input type="hidden" name="diasemana_id[]" id="diasemana_id[]" value="'+diaSemana+'">'+
         '<input type="hidden" name="horario_id[]" id="horario_id[]" value="'+(i)+'">'+
        '</tr>';
        $('#tab3').append(tr);
        console.log('dia da semana '+diaSemana+' Horário'+ i);    
        console.log(i);
      
    };
    $('body').on('click','.remove',function(){
        var last=$('tr').length;
        if(last==1){
            alert("you can not remove last row");
        }
        else{ 
             $(this).parent().parent().remove(); 
             if(i<1){
               i++;
             }else{
              i=i-1;
             }
          }
    });
    console.log('dia da semana' +diaSemana+' Horário'+ i);
    

 })
 
 $('#quinta-tab').on('click',function(){
    diaSemana=4;
    i=1;
    console.log(diaSemana+'-'+ i);
    $('.addRow4').on('click',function(){
        addRow();
    }); 
    function addRow()
    {
        i=i+1;
        console.log(i);
        var tr='<tr>'+
          '<td>'+i+'º Horário</td>'+
          '<td>  <select class="custom-select" id="professor_id[]" name="professor_id[]" ><option value="0">Professor</option>@foreach($professores as $professor)@if($professor->unidade_id === $usuario->unidade_id)<option value="{{$professor->id }}">{{$professor->nm_professor}}</option>@endif @endforeach</select></td>'+        
          '<td>  <select class="custom-select" id="materia_id[]" name="materia_id[]" ><option value="0">Disciplina</option>@foreach($materias as $materia )<option value="{{$materia->id}}">{{$materia->nm_materia}}</option>@endforeach</select></td>'+
        '<td><a href="#" class="btn btn-danger remove"><i class="glyphicon glyphicon-remove"></i>Remover</a></td>'+
         '<input type="hidden" name="diasemana_id[]" id="diasemana_id[]" value="'+diaSemana+'">'+
         '<input type="hidden" name="horario_id[]" id="horario_id[]" value="'+(i)+'">'+
        '</tr>';
        $('#tab4').append(tr);
        console.log('dia da semana '+diaSemana+' Horário'+ i);    
      
    };
    $('body').on('click','.remove',function(){
        var last=$('tr').length;
        if(last==1){
            alert("you can not remove last row");
        }
        else{ 
             $(this).parent().parent().remove(); 
             if(i<1){
               i++;
             }else{
              i=i-1;
             }
          }
    });
    console.log('dia da semana' +diaSemana+' Horário'+ i);
    

   

 })

 $('#sexta-tab').on('click',function(){
    diaSemana=5;
    i=1;
    
    $('.addRow6').on('click',function(){
        addRow();
    }); 
    function addRow()
    {
  
        i=i+1;
        console.log(i);
        var tr='<tr>'+
          '<td>'+i+'º Horário</td>'+
       
          '<td>  <select class="custom-select" id="professor_id[]" name="professor_id[]" ><option value="0">Professor</option>@foreach($professores as $professor)@if($professor->unidade_id === $usuario->unidade_id)<option value="{{$professor->id }}">{{$professor->nm_professor}}</option>@endif @endforeach</select></td>'+        
          '<td>  <select class="custom-select" id="materia_id[]" name="materia_id[]" ><option value="0">Disciplina</option>@foreach($materias as $materia )<option value="{{$materia->id}}">{{$materia->nm_materia}}</option>@endforeach</select></td>'+

        '<td><a href="#" class="btn btn-danger remove"><i class="glyphicon glyphicon-remove"></i>Remover</a></td>'+
          ' <input type="hidden" name="diasemana_id[]" id="diasemana_id[]" value="'+diaSemana+'">'+
          '  <input type="hidden" name="horario_id[]" id="horario_id[]" value="'+(i)+'">'+
        '</tr>';
    
        $('#tab5').append(tr);
        console.log('dia da semana '+diaSemana+' Horário'+ i);
        

       
      
       console.log(i);
      
    };
    $('body').on('click','.remove',function(){
        var last=$('tab5 tr').length;
        if(last==1){
            alert("you can not remove last row");
        }
        else{
            
             $(this).parent().parent().remove(); 
             if(i<1){
               i++;
             }else{
               i=i-1;
             }
          }
    
    });
    console.log('dia da semana' +diaSemana+' Horário'+ i);


 })
    



  



 
</script>

<script>

  $(document).ready(function(){
      jQuery('select[name="seguimento_id"]').on('change',function(){
               segui_id = jQuery(this).val();
               if(segui_id)
               {
                  jQuery.ajax({
                     url : '/turma/getMaterias/' +segui_id,
                     type : "GET",
                     dataType : "json",
                     enctype: 'multipart/form-data',
                     success:function(data)
                     {    
                      
                        jQuery.each(data, function(key,value){
                         
                        $('select[name="materia_id[]"]').append('<option value="'+ key +'">'+ value +'</option>');
                      
                        });
                        mat.push(data);  

                      }
                  });
               }
               else
               {
                  $('select[id="materia_id[]"]').empty();
               }
            
            });
            
            
    });

</script>

@endsection

@endsection
