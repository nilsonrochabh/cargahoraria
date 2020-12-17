<!doctype html>
<html lang="pt_br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{url('assets/img/favicon.ico')}}">

    <title>Sistema Carga Horária</title>


    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/sign-in/signin.css" rel="stylesheet">
    <link rel="stylesheet" href="css/theme.style.min.css">
</head>

<body class="text-center">
    <form class="form-signin" method="post" action="{{route('pages.login.do')}}">
    @csrf 
        <img class="mb-4" src="{{url('assets/img/logo.png')}}" alt="Logo" width="100" height="100">

        @if($errors->all())
            @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <h1 class="h3 mb-3 font-weight-normal">Infome os Dados</h1>
        <div class="form-group">
            <label for="exampleInputEmail1">Escolha sua unidade</label>
            <select class="form-control" id="unidade" name="unidade" required="">
                <option value=""></option>
                                      <optgroup label="DF">  
                                    <option value="59">Escola Salesiana São Domingos Sávio</option>
                                     </optgroup> 
                                      <optgroup label="ES">
                                     <option value="5">Colégio Salesiano Jardim Camburi</option>
                                     <option value="22">Colégio Salesiano Nossa Senhora da Vitória</option>
                                     </optgroup> 
                                      <optgroup label="GO">
                                     <option value="15">Ateneu Salesiano Dom Bosco</option>
                                     </optgroup> 
                                    <optgroup label="MG">
                                     <option value="24">Colégio Salesiano de Belo Horizonte</option>
                                    <option value="44">Colégio Salesiano Dom Bosco</option>
                                    </optgroup> 
                                    <optgroup label="RJ">
                                    <option value="38">Colégio Salesiano de Rocha Miranda</option>
                                    <option value="11">Colegio Salesiano Região Oceânica</option>
                                    <option value="20">Colégio Salesiano Santa Rosa</option>
                                    <option value="10">Colégio Salesiano Jacarezinho</option>
                                    <option value="12">Instituto Dom Bosco</option>
                                    <option value="44">Instituto São José</option>
                                    </optgroup> 
                                  </select>
        </div>
        <div class="form-group">
            <label for="inputEmail" class="sr-only">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required autofocus>
        </div>
        <div class="form-group">
            <label for="password" class="sr-only">Senha</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Senha" required>

        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
        <p class="mt-5 mb-3 text-muted">Copyright © 2021 - Todos os direitos reservados.</p>
    </form>
</body>

</html>