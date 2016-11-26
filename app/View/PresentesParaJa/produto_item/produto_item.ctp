
<div class="col s6 m4 l4">
	<div class="card">
		<div class="card-image">

            <?php if (isset($produto['Produto']['imagem']) && !empty($produto['Produto']['imagem'])): ?>
				<img src="/uploads/produto/imagens/<?php echo $produto['Produto']['imagem'] ?>" style="max-height:255px;height: 255px;max-height:255px;">
            <?php else: ?>
                <img src="/images/imagem404.jpg" alt="Foto do produto <?php echo $produto['Produto']['nome'] ?>" style="max-height:255px;height: 255px;max-height:255px;">
            <?php endif; ?>

		</div>
		<div class="card-content">
			<p><?php echo $produto['Produto']['nome'] ?></p>
			<br>
			<p>R$ <?php echo number_format($produto['Produto']['preco'], 2, ',', '.') ?></p>
		</div>
		<div class="card-action">
			<a href="/<?php echo explode('/', $_SERVER['REQUEST_URI'])[1] ?>/product/<?php echo $produto['Produto']['id'] ?>">Ver Mais</a>
		</div>
	</div>
</div>
