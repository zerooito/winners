<div class="col-md-3 d-flex">
    <div class="product ftco-animate">

        <?php if (isset($produto['Produto']['imagem']) && !empty($produto['Produto']['imagem'])): ?>
            <div class="img d-flex align-items-center justify-content-center" style="background-image: url(/uploads/produto/imagens/<?php echo $produto['Produto']['imagem'] ?>);">
        <?php else: ?>
            <div class="img d-flex align-items-center justify-content-center" style="background-image: url(/images/imagem404.jpg);">
        <?php endif; ?>
            <div class="desc">
                <p class="meta-prod d-flex">
                    <a href="/product/<?php echo $produto['Produto']['id'] ?>" class="d-flex align-items-center justify-content-center"><span class="flaticon-visibility"></span></a>
                </p>
            </div>
        </div>
        <div class="card-content">
			<p></p>
			<br>
			<p></p>
		</div>
		<div class="card-action">
			<a href="/product/<?php echo $produto['Produto']['id'] ?>">Ver Mais</a>
		</div>
        <div class="text text-center">
            <h2><?php echo $produto['Produto']['nome'] ?></h2>
            <span class="price">R$ <?php echo number_format($produto['Produto']['preco'], 2, ',', '.') ?></span>
        </div>
    </div>
</div>