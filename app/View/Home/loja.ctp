<!DOCTYPE html>
<html>
<head>
	<title><?php echo $resposta->nome ?></title>
</head>
<body>
	<h1><?php echo $resposta->nome ?></h1>
	<a href="/produto/<?php echo $resposta->id ?>"><?php echo $resposta->nome ?></a>
	<h3>Preço: </h3>
	<h4><?php echo $resposta->preco ?></h4>
	<h6>Categoria: <?php echo $resposta->idCategoria ?></h6>
</body>
</html>