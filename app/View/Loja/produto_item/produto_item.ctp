<div class="col-sm-3 col-lg-3 col-md-3">
    <div class="thumbnail" style="min-height: 350px;">
        <a href="/<?php echo explode('/', $_SERVER['REQUEST_URI'])[1] ?>/product/<?php echo $produto['Produto']['id'] ?>">
            
            <?php if (isset($produto['Produto']['imagem']) && !empty($produto['Produto']['imagem'])): ?>
                <img src="/uploads/produto/imagens/<?php echo $produto['Produto']['imagem'] ?>" alt="Foto do produto <?php echo $produto['Produto']['nome'] ?>" style="max-height:255px;height: 255px;max-height:255px;">
            <?php else: ?>
                <img src="/images/imagem404.jpg" alt="Foto do produto <?php echo $produto['Produto']['nome'] ?>" style="max-height:255px;height: 255px;max-height:255px;">
            <?php endif; ?>

        </a>
        <div class="caption" style="padding-top:10px;">
            
            <h4 class="pull-right">
            
                <a href="/<?php echo explode('/', $_SERVER['REQUEST_URI'])[1] ?>/product/<?php echo $produto['Produto']['id'] ?>">  <?php echo $produto['Produto']['nome'] ?>                
                </a>
            
            </h4>
            
            <h4 class="pull-right">R$ <?php echo number_format($produto['Produto']['preco'], 2, ',', '.') ?></h4>
        </div>
    </div>
</div>
