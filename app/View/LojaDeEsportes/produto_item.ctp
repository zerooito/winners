<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
    <div class="single-new-arrival mb-50 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
        <div class="popular-img">
            <?php if (isset($produto['Produto']['imagem']) && !empty($produto['Produto']['imagem'])): ?>
                <img src="/uploads/produto/imagens/<?php echo $produto['Produto']['imagem'] ?>" alt="">
            <?php else: ?>
                <img src="/images/imagem404.jpg" alt="">
            <?php endif; ?>
        </div>
        <div class="popular-caption">
            <h3><a href="/product/<?php echo $produto['Produto']['id'] ?>"><?php echo $produto['Produto']['nome'] ?></a></h3>
            <span>R$ <?php echo number_format($produto['Produto']['preco'], 2, ',', '.') ?></span>
        </div>
    </div>
</div>