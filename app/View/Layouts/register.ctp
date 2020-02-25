<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Winners - Cadastre-se</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="/sb-admin-2/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Cadastre-se!</h1>
              </div>
              <form action="/usuario/novo_usuario" role="form" id="form-login" method="post" class="user">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="Primeiro nome" name="dados[nome1]">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Segundo nome" name="dados[nome2]">
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="inputPhone" placeholder="Digite seu telefone 11 9 9876-5432" name="dados[telefone]">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="E-mail" name="dados[email]">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Digite a senha" name="dados[senha]">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Confirme a senha" name="dados[senha_repeat]">
                  </div>
                </div>
                <button class="btn btn-primary btn-user btn-block">
                  Cadastrar
                </button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="/recuperar-senha">Esqueceu a senha?</a>
              </div>
              <div class="text-center">
                <a class="small" href="/home/login">Já tem uma conta? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="/sb-admin-2/vendor/jquery/jquery.min.js"></script>
  <script src="/sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/sb-admin-2/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/sb-admin-2/js/sb-admin-2.min.js"></script>

</body>

</html>
