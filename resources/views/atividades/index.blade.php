@extends('layouts.layout')
@section('content')


<div>
<h1>Lista de Professores</h1>
<form class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Buscar" aria-label="Buscar">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
          </form>
    <table class="table">
    <thead class="thead-dark">
        <tr>
        <th scope="col">Matricula</th>
        <th scope="col">Nome</th>
        <th scope="col">Disponibilidade</th>
        <th scope="col">Carga Horária</th>
        <th scope="col">Unidade</th>
        <th scope="col">Ação</th>
        </tr>
    </thead>
    <tbody>
        @foreach($professores as $professor)

        @php
            $unidade=$professor->find($professor->id)->relUnidade;
        @endphp
        <option value="{{$professor->id}}"></option>
                
        <tr>
        <th scope="row">{{$professor->matricula}}</th>
        <td>{{$professor->nm_professor}}</td>
        <td>{{$professor->disponibilidade}}</td>
        <td>{{$professor->carga_horaria}}</td>
        <td>{{$unidade->nm_unidade}}</td>
        <td>
            <a href="{{url("atividade/$professor->id")}}">
                <button class="btn btn-dark">Vizualizar</button>
                
            </a>

            <a href="">
                <button class="btn btn-primary">Editar</button>
                
            </a>
        </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
@endsection