@extends('layouts.layout')
@section('content')



<div class="mt-3 mb-4">
  <a href="{{url('atividade')}}">
        <button class="btn btn-success">Voltar</button>
      </a>
<div class="text-center">
<h1 >Atividade {{$atividade->id}}</h1>

</div>
<div>

    @php
        $professor=$atividade->find($atividade->id)->relProfessor;
        $seguimento=$atividade->find($atividade->id)->relSeguimento;
        $serie=$atividade->find($atividade->id)->relSerie;       
        $evento=$atividade->find($atividade->id)->relEvento;       
 
       
    @endphp   
  
    
    <p>Professor : <span class="font-weight-bold">{{$professor->nm_professor}}</span> </p>
    <p>Seguimento : <span class="font-weight-bold">{{$seguimento->nm_seguimento}}</span> </p>
    <p>Série : <span class="font-weight-bold">{{$serie->nm_serie}}</span> </p>
    <p>Hora  : <span class="font-weight-bold">{{$atividade->hora}}</span> </p>
    <p>Evento  : <span class="font-weight-bold">{{$evento->nm_evento}}</span> </p>
    <p>Justificativa  : <span class="font-weight-bold">{{$atividade->justificativa}}</span> </p>
    
    <div>
        <a href="">
            <button class="btn btn-danger">Excluir Atividade </button>
        </a>
        
    </div>

    
    
    

</div>

@endsection