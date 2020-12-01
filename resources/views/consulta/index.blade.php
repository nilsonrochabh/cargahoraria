@extends('layouts/layout')
@section('content')

<div class="jumbotron">
    <div class="container">
       
        <h2 id="unidade">{{$usuario->nm_unidade}}</h2>
        
      <h5 class="display-5">Consultas</h4>
      
    </div>
  </div>
<main role="main" class="container">
        <div class="container">
            <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <div class="text-center">
                            <i class="	fas fa-user-graduate fa-7x"></i>
                            <div class="card-body">
                                <h5 class="card-title">

                                    <a href="/professor" class="btn btn-primary">Consultar Professor</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                  <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <div class="text-center">
                            <i class="	fa fa-info-circle fa-7x"></i>


                            <div class="card-body">
                                <h5 class="card-title">

                                    <a href="" class="btn btn-primary">Consulta de Horários Turmas</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <div class="text-center">
                           <i class="fas fa-address-card fa-7x"></i>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="/atividade" class="btn btn-primary">Consulta de Atividades</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

        </div>
        <!-- /container -->

    </main>
@endsection