
<div class="row">
  <div class="col-md-8">

  </div>
  <div class="col-md-4">

  </div>
</div>


    <div id="login" class="login">
    <div class="panel panel-primary">
      <div class="panel-heading">Faça seu Login</div>
      <div class="panel-body">
        <form action="index.php" method="post">
            <label>Email: </label><input class="form-control" data-role="input-control" type="text" name="login[login_email]" id="login_email" placeholder="Digite seu email" required />
            <label>Senha: </label><input class="form-control" data-role="input-control" type="password" name="login[login_senha]" id="login_senha" placeholder="Digite sua senha" required />
            <a href="#">Esqueceu sua senha ?</a><br>
            <button type="button" class="btn btn-primary" id="logar">Logar</button>
        </form>
      </div>
    </div>
    </div>

    <div id="formulario" class="cadastro">
    <div class="panel panel-primary">
      <div class="panel-heading">Faça seu Cadastro</div>
        <div class="panel-body">
           <form action="cliente/cadastrar"  method="post" id="cadastrar">
              <label>Nome: </label><input class="form-control" id="nome_cadastro" data-role="input-control" type="text" name="cadastro[nome]" placeholder="Digite seu nome" required />
              <label>Email: </label><input class="form-control" id="email_cadastro" data-role="input-control" type="text" name="cadastro[email]" placeholder="Digite seu email" required />
              <label>Senha: </label><input class="form-control" id="senha_cadastro" data-role="input-control" type="password" name="cadastro[senha]" placeholder="Digite sua senha" required />
              <label>CPF: </label><input class="form-control" id="cpf_cadastro" data-role="input-control" type="text" name="cadastro[cpf]" placeholder="Digite sua senha" required />
              <br>
              <button type="button" class="btn btn-primary" id="enviar">Cadastrar</button>
            </form>
        </div>
    </div>
    </div>