
<nav class="custom-color">
	<div class="nav-wrapper">
		<a href="#" class="brand-logo">Presentes Para Já</a>
		<ul id="nav-mobile" class="right hide-on-med-and-down">
			<li><a href="sass.html">Como Funciona</a></li>
        	<?php foreach($categorias as $indice => $valor): ?>
				<li>
					<a href="/<?php echo explode('/', $_SERVER['REQUEST_URI'])[1] ?>/category/<?php echo $valor['Categoria']['id'] ?>/<?php echo $valor['Categoria']['nome'] ?>">
						<?php echo $valor['Categoria']['nome'] ?>
					</a>
				</li>
			<?php endforeach; ?>
			<li><a href="collapsible.html">Monte Sua Cesta</a></li>
			<li><a href="collapsible.html">Contato</a></li>
		</ul>
	</div>
</nav>

<div class="container" style="margin-top: 10px;">

	<div class="row">
		
		<div class="col s12 l6"> 
			<div class="slider">
				<ul class="slides">
					<li>
						<img src="http://lorempixel.com/580/250/nature/1"> <!-- random image -->
						<div class="caption center-align">
							<h3>This is our big Tagline!</h3>
							<h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
						</div>
					</li>
					<li>
						<img src="http://lorempixel.com/580/250/nature/2"> <!-- random image -->
						<div class="caption left-align">
						  	<h3>Left Aligned Caption</h3>
					  		<h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
						</div>
					</li>
					<li>
						<img src="http://lorempixel.com/580/250/nature/3"> <!-- random image -->
						<div class="caption right-align">
					  		<h3>Right Aligned Caption</h3>
					  		<h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
						</div>
					</li>
					<li>
						<img src="http://lorempixel.com/580/250/nature/4"> <!-- random image -->
						<div class="caption center-align">
					  		<h3>This is our big Tagline!</h3>
					  		<h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
						</div>
					</li>
				</ul>
			</div>
		</div>

		<div class="col s12 l6"> 

			<h1 class="title-product"><?php echo $produto['Produto']['nome'] ?></h1>

			<p class="flow-text">R$ <?php echo number_format($produto['Produto']['preco'], '2', ',', '.') ?></p>

			<br>

			<div class="fb-like" data-href="/<?php echo explode('/', $_SERVER['REQUEST_URI'])[1] ?>/product/<?php echo $produto['Produto']['id'] ?>" data-send="true" data-layout="button_count" data-width="250" data-show-faces="false"></div>
			
			<form id="addCart" action="/<?php echo explode('/', $_SERVER['REQUEST_URI'])[1] ?>/addCart" method="post">
			
				<div class="row">
			  		<div class="input-field col s12">
				    	<input type="number" min="0" value="" required name="produto[quantidade]" />
				    	<label class="active" for="number">Quantidade</label>
				    </div>
					<div class="input-field col s12">
					    <select name="produto[variacao]">
		            		<?php foreach ($variacoes as $i => $variacao): ?>
		            			<option value="<?php echo $variacao['Variacao']['id'] ?>"><?php echo $variacao['Variacao']['nome_variacao'] ?></option>
		            		<?php endforeach; ?>
		            	</select>
			    	</div>
			        <input type="hidden" value="<?php echo $produto['Produto']['id'] ?>" name="produto[id]" />
				</div>

				<div class="row" style="text-align: right;margin-top:105px;">
			  		<div class="input-field col s12">

						<?php if ($produto['Produto']['estoque'] > 0): ?>
							<a onclick="$('#addCart').submit();" class="waves-effect waves-light btn custom-color">
								<i class="material-icons right"></i>
								Adicionar Ao Carrinho
							</a>
						<?php else: ?>
							<a class="waves-effect waves-light btn red">
								<i class="material-icons right"></i>
								Indisponivel
							</a>
						<?php endif; ?>

				    </div>
				</div>

			</form>

		</div>

	</div>

	<div class="row">
		
		<div class="col s12">
						
		    <p class="flow-text">
				<?php echo $produto['Produto']['descricao'] ?>
			</p>

		</div>

	</div>

</div>