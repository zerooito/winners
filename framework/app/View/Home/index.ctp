
    <div id="sucesso">
        <div class="alert">Aviso</div>
        <div class="conteudo_alert"></div>
        <span id="ok">Ok, Entedi !</span>
    </div>


    <div class="tcycle">
            <img src= <?php '"'.$this->Html->image('1.png').'"'; ?> >
            <img src="<?php $this->Html->image('4.jpg'); ?>">
    </div>

    <div id="login" class="login">
    <form action="index.php" method="post">
        <label>Email: </label><input class="input-control text" data-role="input-control" type="text" name="login_email" placeholder="Digite seu email" required />
        <label>Senha: </label><input class="input-control text" data-role="input-control" type="password" name="login_senha" placeholder="Digite sua senha" required /><br/><br/>
        <span class="large" id="logar">Login</span>
    </form>
    </div>

    <div id="formulario" class="cadastro">
    <h3>{$h1}</h3>
    <form action="index.php"  method="post">
        <label>Nome: </label><input class="input-control text" data-role="input-control" type="text" name="nome" placeholder="Digite seu nome" required />
        <label>Email: </label><input class="input-control text" data-role="input-control" type="text" name="email" placeholder="Digite seu email" required />
        <label>Senha: </label><input class="input-control text" data-role="input-control" type="password" name="senha" placeholder="Digite sua senha" required />
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
        <span class="large" id="enviar">Cadastrar</span>
    </form>
    </div>

    <div id="conteudo">
        <h1>Sistemas Winners</h1>
        <p>Os sistemas da winners são os melhores por diversos motivos, a facilidade para o usuario, o suporte integrado 24 horas, e os melhores desenvolvedores que você irá ver está aqui, fazendo de tudo para que você obtenha o maior grau de experiencia, em cada um de nossos sistemas, então corra e faça um orçamento.</p>
    </div>

    <div id="menu2">
        <ul>
            <li><img src="<?php $this->Html->image('chat.png'); ?>" width="200" height="200"></li>
            <li><img src="<?php $this->Html->image('equipe.jpg'); ?>" width="200" height="200"></li>
            <li><img src="<?php $this->Html->image('orcamento.png'); ?>" width="200" height="200"></li>
        </ul>
    </div>