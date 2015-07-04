<div class="container-fluid">
    <div class="content-wrapper">	
		<div class="item-container">	
			<div class="container" style="padding-top: 15px;">	
				<div class="col-md-5">
					<div class="product col-md-3 service-image-left">
						<center>
							<img id="item-display" src="/uploads/produto/imagens/<?php echo $produto['Produto']['imagem'] ?>" alt="" data-zoom-image="/uploads/produto/imagens/<?php echo $produto['Produto']['imagem'] ?>"></img>
						</center>
					</div>
				</div>
					
				<div class="col-md-7">
					<div class="product-title"><?php echo $produto['Produto']['nome'] ?></div>
					<hr>
					<div class="product-price">R$ <?php echo number_format($produto['Produto']['preco'], '2', ',', '.') ?></div>
					<?php if ($produto['Produto']['estoque'] > 0): ?>						
						<div class="product-stock">Em Estoque</div>
					<?php else: ?>
						<div class="product-stock-off">Sem Estoque</div>
					<?php endif; ?>
					<hr>
					<div class="btn-group cart">
			            <form action="/addCart" method="post">
			                <input type="hidden" value="<?php echo $produto['Produto']['id'] ?>" name="produto[id]" />
							<?php if ($produto['Produto']['estoque'] > 0): ?>
							<button type="submit" class="btn btn-success">
								Comprar 
							</button>
							<?php else: ?>
							<button disabled type="submit" class="btn btn-success">
								Indisponivel 
							</button>
							<?php endif; ?>
						</form>
					</div>
				</div>
			</div> 
		</div>
		<div class="container-fluid">		
			<div class="col-md-12 product-info">
				<ul id="myTab" class="nav nav-tabs nav_tabs">
					
					<li class="active"><a href="#service-one" data-toggle="tab">Descrição</a></li>
					
				</ul>
				<div id="myTabContent" class="tab-content">
					<div class="tab-pane fade in active" id="service-one">
					 
						<section class="container product-info">
							<?php echo $produto['Produto']['descricao'] ?>
						</section>
									  
					</div>
				</div>
				<hr>
			</div>
		</div>
	</div>
</div>


<script src="/app/webroot/xstore/js/jquery-1.8.3.min.js"></script>
<script src='/app/webroot/xstore/js/jquery.elevatezoom.js'></script>

<script type="text/javascript">
	$("#item-display").elevateZoom(); 
</script>