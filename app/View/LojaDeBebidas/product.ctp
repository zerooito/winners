
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 ftco-animate">
                <?php if (isset($produto['Produto']['imagem']) && !empty($produto['Produto']['imagem'])): ?>
                    <a href="/uploads/produto/imagens/<?php echo $produto['Produto']['imagem'] ?>" class="image-popup prod-img-bg"><img src="/uploads/produto/imagens/<?php echo $produto['Produto']['imagem'] ?>" class="img-fluid" alt=""></a>
                <?php else: ?>
                    <a href="/images/imagem404.jpg" class="image-popup prod-img-bg"><img src="/images/imagem404.jpg" class="img-fluid" alt=""></a>
                <?php endif; ?>
            </div>
            <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                <h3><?php echo $produto['Produto']['nome']; ?></h3>
                <?php if ($produto['Produto']['preco_promocional'] < $produto['Produto']['preco']): ?>
                <p class="price"><span>R$ <?php echo number_format($produto['Produto']['preco_promocional'], 2, ',', '.'); ?></span></p>
                <?php else: ?>
                <p class="price"><span>R$ <?php  echo number_format($produto['Produto']['preco'], 2, ',', '.'); ?></span></p>
                <?php endif; ?>
                <p><?php echo $produto['Produto']['descricao']; ?></p>
                <div class="w-100"></div>
            </div>
        </div>
    </div>
</section>
