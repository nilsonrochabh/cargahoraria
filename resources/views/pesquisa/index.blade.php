@extends('layouts.layout')
@section('content')


    <div class="jumbotron">
    <div class="container">
        
      <h5 class="display-5">Pesquisas</h4>
      
    </div>
  </div>
   <main role="main" class="container">
        <div class="container">
            <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <div class="text-center">
                            <i class="fas fa-user-graduate fa-7x"></i>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="/turma/create" class="btn btn-primary">Pesquisar Aulas por Professores</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <div class="text-center">

                            <i class="fas fa-thumbs-up fa-7x"></i>


                            <div class="card-body">
                                <h5 class="card-title">

                                    <a href="/atividade/create" class="btn btn-primary">Pesquisar Atividades</a>
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