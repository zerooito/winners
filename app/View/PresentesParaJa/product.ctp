<?php require('menu.ctp'); ?>
<div class="container" style="margin-top: 10px;">

	<div class="row">
		
		<div class="col s12 l6"> 
			<div class="slider">
				<ul class="slides">
					<li>
						<img src="/uploads/produto/imagens/<?php echo $produto['Produto']['imagem']; ?>">
					</li>
				</ul>
			</div>
		</div>

		<div class="col s12 l6"> 

			<h1 class="title-product"><?php echo $produto['Produto']['nome'] ?></h1>

			<p class="flow-text">R$ <?php echo number_format($produto['Produto']['preco'], '2', ',', '.') ?></p>

			<br>

			<div class="fb-like" data-href="/product/<?php echo $produto['Produto']['id'] ?>" data-send="true" data-layout="button_count" data-width="250" data-show-faces="false"></div>
			
			<form id="addCart" action="/addCart" method="post">
			
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

<script type="text/javascript">
	
    $(document).ready(function(){
    	$('.slider').slider({full_width: true});
    });

</script>