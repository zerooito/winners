<?php
	error_reporting(1);
	include 'Connections/conexao.php';
	include 'configs/config.php';
	require 'classes/BD.class.php';

	$ponteiro =  fopen("emails.txt", "r");

	while(!feof($ponteiro)){
		$linha = fgets($ponteiro, 4096);

		//echo $linha.'</br>';
								/*Assunto*/    /* msg */
		$qr = mysql_query("SELECT * FROM lista_email WHERE email = '$linha'") or die(mysql_error());
		if(mysql_num_rows($qr) >= 1){
			echo 'Email: '.$linha.', já estava cadastrado, Querie: '.$qr."</br>";
		}else{
			$qr = mysql_query("INSERT INTO lista_email (email) VALUES ('$linha')")or die(mysql_error());
			if($qr){
				echo 'Sucesso email: '.$linha.', Cadastrado, Querie: '.$qr."</br>";
			}else{
				echo 'Erro email: '.$linha.', Não cadastrado, Querie: '.$qr."</br>";
			}
		}
	}

	fclose($ponteiro);