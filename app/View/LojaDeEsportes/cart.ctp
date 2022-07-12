
<!-- Bootstrap Core CSS -->
<link href="/shopdefault/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="/shopdefault/css/shop-homepage.css" rel="stylesheet">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<br>

<div class="container">
	<div class="row form-group">
        <div class="col-xs-12">
            <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                <li class="active"><a href="#step-1">
                    <h4 class="list-group-item-heading">Passo 1</h4>
                    <p class="list-group-item-text text-white">Carrinho</p>
                </a></li>
                <li class="disabled"><a href="#step-2">
                    <h4 class="list-group-item-heading">Passo 2</h4>
                    <p class="list-group-item-text text-white">Identificação</p>
                </a></li>
            </ul>
        </div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">
						<div class="row">
							<div class="col-xs-6">
								<h5><span class="glyphicon glyphicon-shopping-cart"></span> Carrinho</h5>
							</div>
							<div class="col-xs-6">
								<a href="/" class="btn btn-primary btn-sm btn-block">
									<span class="glyphicon glyphicon-share-alt"></span> Continue comprando
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-body">
					<?php foreach($products as $indice => $product): ?>
					<div class="row">
						<div class="col-xs-2"><img class="img-responsive" src="/uploads/produto/imagens/<?php echo $product['Produto']['imagem'] ?>" alt="Foto do produto <?php echo $product['Produto']['nome'] ?>">
						</div>
						<div class="col-xs-4">
							<h4 class="product-name"><strong><?php echo $product['Produto']['nome'] ?></strong></h4>
						</div>
						<div class="col-xs-6">
							<div class="col-xs-6 text-right">
								<h6><strong>R$ <?php echo number_format($product['Produto']['preco'], 2, ',', '.') ?> <span class="text-muted">x</span></strong></h6>
							</div>
							<div class="col-xs-4">
								<input type="text" class="form-control input-sm" value="<?php echo $product['Produto']['quantidade'] ?>">
							</div>
							<div class="col-xs-2">
								<button onclick="window.location.href = '/removeProductCart/<?php echo $product['Produto']['id'] ?>';" type="button" class="btn btn-link btn-xs">
									<span class="glyphicon glyphicon-trash"> </span>
								</button>
							</div>
						</div>
					</div>
					<hr>
					<?php endforeach; ?>
				</div>
				<div class="panel-footer">
					<div class="row text-center">
						<div class="col-xs-9">
							<h4 class="text-right">Total <strong>R$ <?php echo number_format($total, 2, ',', '.') ?></strong></h4>
						</div>
						<div class="col-xs-3">
							<button onclick="window.location.href = '/checkout'" type="button" class="btn btn-success btn-block">
								Continuar
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- jQuery -->
<script src="/shopdefault/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/shopdefault/js/bootstrap.min.js"></script>