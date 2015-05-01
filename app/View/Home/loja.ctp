<!DOCTYPE html>
<html>
<head>
	<title><?php echo $resposta->nome ?></title>
</head>
<body>
	<h1><?php echo $resposta->nome ?></h1>
	<a href="/home/adicionar_carrinho/<?php echo $resposta->id ?>"><?php echo $resposta->nome ?></a>
	<h3>Preço: </h3>
	<h4><?php echo $resposta->preco ?></h4>
	<h6>Categoria: <?php echo $resposta->idCategoria ?></h6>
	<form action="/home/adicionar_carrinho" method="post">
		<input type="hidden" name="carrinho[id_produto]" value="<?php echo $resposta->id ?>" />
		<input type="hidden" name="carrinho[preco]" value="<?php echo $resposta->preco ?>" />

		<input type="submit" />
	</form>
</body>
</html>