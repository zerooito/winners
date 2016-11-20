    
	<div id="index-banner" class="parallax-container">

		<nav>
			<div class="nav-wrapper">
				<a href="#" class="brand-logo">Presentes Para Já teste</a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li>
						<a href="sass.html">Como Funciona</a>
					</li>
                	<?php foreach($categorias as $indice => $valor): ?>
						<li>
							<a href="/<?php echo explode('/', $_SERVER['REQUEST_URI'])[1] ?>/category/<?php echo $valor['Categoria']['id'] ?>/<?php echo $valor['Categoria']['nome'] ?>">
								<?php echo $valor['Categoria']['nome'] ?>
							</a>
						</li>
					<?php endforeach; ?>
					<li>
						<a href="collapsible.html">
							Monte Sua Cesta
						</a>
					</li>
					<li>
						<a href="collapsible.html">
							Contato
						</a>
					</li>
				</ul>
			</div>
		</nav>

	    <div class="section no-pad-bot">
			<div class="container">
				<br>
				<br>
					<h1 class="header center title">
						Presentes Para Já
					</h1>
					<div class="row center">
			  			<h5 class="header col s12 light">
			  				Monte a cesta de presente perfeita
			  			</h5>
					</div>
					<div class="row center">
				  		<a href="http://materializecss.com/getting-started.html" class="btn-large waves-effect waves-light custom-color">
				  			Começar a Montar
				  		</a>
					</div>
				<br>
				<br>
			</div>
	    </div>
	    <div class="parallax">
	    	<img src="https://images.pexels.com/photos/88647/pexels-photo-88647.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="Unsplashed background img 1" style="display: block; transform: translate3d(-50%, 190px, 0px);">
	    </div>
	</div>

	<div class="container">
		
		<div class="row">
	        <?php foreach ($produtos as $indice => $produto): ?> 
				<?php include('produto_item/produto_item.ctp') ?>
	        <?php endforeach; ?>
	    </div>
		
	</div>
