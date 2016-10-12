<div class="col-sm-3 col-lg-3 col-md-3">
    <div class="thumbnail"   style="min-height: 430px;">
        <a href="/<?php echo explode('/', $_SERVER['REQUEST_URI'])[1] ?>/product/<?php echo $produto['Produto']['id'] ?>">
            <img src="/uploads/produto/imagens/<?php echo $produto['Produto']['imagem'] ?>" alt="Foto do produto <?php echo $produto['Produto']['nome'] ?>" width="100" height="60">
        </a>
        <div class="caption">
            <h4 class="pull-right">R$ <?php echo number_format($produto['Produto']['preco'], 2, ',', '.') ?></h4>
            <h4><a href="/<?php echo explode('/', $_SERVER['REQUEST_URI'])[1] ?>/product/<?php echo $produto['Produto']['id'] ?>"><?php echo $produto['Produto']['nome'] ?></a>
            </h4>
            <p><?php echo substr($produto['Produto']['descricao'], 0, 50) . '...' ?></p>
        </div>
        <div class="ratings">
            <form action="/<?php echo explode('/', $_SERVER['REQUEST_URI'])[1] ?>/addCart" method="post">
                <input type="hidden" value="<?php echo $produto['Produto']['id'] ?>" name="produto[id]" />
                <?php if ($produto['Produto']['estoque'] <= 0) { ?>
                    <button disabled="" type="submit" style="margin-top: -60px;" type="button" class="btn btn-default">Sem Estoque</button>
                <?php } else { ?>
                    <button onclick="window.location.href='/<?php echo explode('/', $_SERVER['REQUEST_URI'])[1] ?>/product/<?php echo $produto['Produto']['id'] ?>'" style="margin-top: -60px;" type="button" class="btn btn-info">Mais informações</button>
                <?php } ?>
            </form>
        </div>
    </div>
</div>
