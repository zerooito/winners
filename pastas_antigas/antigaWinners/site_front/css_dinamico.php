<?php
// Define que o arquivo terá a codificação de saída no formato CSS
// a configuração de estilo do css dinamico é um para todas as paginas
// nem todas as configurações podem ser mudadas apenas cor, tamanho do texto, fonte e etc. para não fuder com o layout
include '../Connections/conexao.php';//chama a configuração de conexão
include '../configs/config.php';//chama as configurações smarty, apesar de não precisar
require '../classes/BD.class.php';//chama a classe de conexão
require '../classes/pagina_home_site.class.php';//chama a classe com os atributos do banco de dados

$pagina_home_site = new pagina_home_site();//declara o obj para a classe

header("Content-type: text/css");//define o documento como css para o intepretador
if($_GET['id']){//verifica se existe get
	$id_usuario = $_GET['id'];//recupera o id passado pelo get
}


$dados_home_site = $pagina_home_site->recuperar_pagina_home($id_usuario);//recuperar os dados pela função da classe
foreach($dados_home_site as $indice => $valor){
	$cor_fundo = $valor['background_color'];//declara o valor da cor de fundo
}

?>

body {
background: <?php echo $cor_fundo;//define a cor de fundo ?>;
}