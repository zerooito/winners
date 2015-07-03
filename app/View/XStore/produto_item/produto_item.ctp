<div class="col-sm-4 col-lg-4 col-md-4">
    <div class="thumbnail"   style="min-height: 430px;">
        <img src="/uploads/produto/imagens/<?php echo $produto['Produto']['imagem'] ?>" alt="Foto do produto <?php echo $produto['Produto']['nome'] ?>" width="100" height="60">
        <div class="caption">
            <h4 class="pull-right">R$ 94.99</h4>
            <h4><a href="#"><?php echo $produto['Produto']['nome'] ?></a>
            </h4>
            <p><?php echo $produto['Produto']['descricao'] ?></p>
        </div>
        <div class="ratings">
            <form action="/addCart" method="post">
                <input type="hidden" value="<?php echo $produto['Produto']['id'] ?>" name="produto[id]" />
                <?php if ($produto['Produto']['estoque'] <= 0) { ?>
                    <button disabled="" type="submit" style="margin-top: -60px;" type="button" class="btn btn-default">Sem Estoque</button>
                <?php } else { ?>
                    <button type="submit" style="margin-top: -60px;" type="button" class="btn btn-info">Comprar</button>
                <?php } ?>
            </form>
        </div>
    </div>
</div>
