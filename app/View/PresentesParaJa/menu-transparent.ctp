
	<nav>
		<div class="nav-wrapper">
			<a href="/" class="brand-logo">Presentes Para Já</a>
			<ul id="nav-mobile" class="right hide-on-med-and-down">
	        	<?php foreach($categorias as $indice => $valor): ?>
					<li>
						<a href="/category/<?php echo $valor['Categoria']['id'] ?>/<?php echo $valor['Categoria']['nome'] ?>">
							<?php echo $valor['Categoria']['nome'] ?>
						</a>
					</li>
				<?php endforeach; ?>
				<li><a href="/monte-sua-cesta-o-presente-perfeito">Monte Sua Cesta</a></li>
				<li><a href="/contato">Contato</a></li>
			</ul>
		</div>
	</nav>
