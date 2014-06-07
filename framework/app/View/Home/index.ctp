
    <div id="sucesso">
        <div class="alert">Aviso</div>
        <div class="conteudo_alert"></div>
        <span id="ok">Ok, Entedi !</span>
    </div>

<div class="row">
  <div class="col-md-8">
    <div class="tcycle">
            <?php echo $this->Html->link(
                    $this->Html->image('1.png', array('alt' => 'Suporte Winners', 'border' => '0', 'width' => '800', 'height' => '450')),
                    '',
                    array('target' => '_blank', 'escape' => false)
                );
            ?>
            <?php echo $this->Html->link(
                    $this->Html->image('2.jpg', array('alt' => 'Suporte Winners', 'border' => '0', 'width' => '800', 'height' => '450')),
                    '',
                    array('target' => '_blank', 'escape' => false)
                );
            ?>
    </div>
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
            <label>Senha: </label><input class="form-control" data-role="input-control" type="password" name="login[login_senha]" id="login_senha" placeholder="Digite sua senha" required /><br/><br/>
            <button type="button" class="btn btn-primary" id="logar">Cadastrar</button>
        </form>
      </div>
    </div>
    </div>

    <div id="formulario" class="cadastro">
    <div class="panel panel-primary">
      <div class="panel-heading">Faça seu Cadastro</div>
        <div class="panel-body">
                 <form action="index.php"  method="post">
                    <label>Nome: </label><input class="form-control" data-role="input-control" type="text" name="nome" placeholder="Digite seu nome" required />
                    <label>Email: </label><input class="form-control" data-role="input-control" type="text" name="email" placeholder="Digite seu email" required />
                    <label>Senha: </label><input class="form-control" data-role="input-control" type="password" name="senha" placeholder="Digite sua senha" required />
                    <label>Escolha seus produtos</label>
                    <div class="input-control checkbox">
                        <label>
                            <input type="checkbox" name="ead" id="ead" value="1" />
                            <span class="check"></span>
                            EAD
                        </label>
                    </div>
                    <div class="input-control checkbox">
                        <label>
                            <input type="checkbox" name="erp" id="erp" value="1" />
                            <span class="check"></span>
                            ERP
                        </label>
                    </div>
                    <div class="input-control checkbox">
                        <label>
                            <input type="checkbox" name="site" id="site" value="1" />
                            <span class="check"></span>
                            Site Pronto
                        </label>
                    </div>
                    <button type="button" class="btn btn-primary" id="enviar">Cadastrar</button>
                  </form>
        </div>
    </div>
    </div>

    <div id="conteudo">
        <div class="jumbotron">
        <h1>Sistemas Winners</h1>
        <p>Os sistemas da winners são os melhores por diversos motivos, a facilidade para o usuario, o suporte integrado 24 horas, e os melhores desenvolvedores que você irá ver está aqui, fazendo de tudo para que você obtenha o maior grau de experiencia, em cada um de nossos sistemas, então corra e faça um orçamento.</p>
          <p><a class="btn btn-primary btn-lg" role="button">Learn more</a></p>
        </div>
    </div>
