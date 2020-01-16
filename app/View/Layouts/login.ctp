<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Winners - Login</title>

  <!-- Custom fonts for this template-->
  <link href="/sb-admin-2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="/sb-admin-2/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Seja bem vindo!</h1>
                  </div>
                  <form <?php if ($admin) { echo 'action="/admin/processar_login"'; } else { echo 'action="/usuario/processar_login"'; }?> class="user" method="post">
                    <div class="form-group">
                      <input type="email" name="dados[email]" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Digite seu e-mail...">
                    </div>
                    <div class="form-group">
                      <input type="password" name="dados[senha]" class="form-control form-control-user" placeholder="Digite sua senha">
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="/recuperar-senha">Esqueceu a senha?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="/cadastre-se">Crie sua conta!</a>
                  </div>
                </div>
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
