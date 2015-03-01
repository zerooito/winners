<?php
	class instituicao{

		function add_instituicao($nome,$email,$senha){
			$qr = BD::conn()->("INSERT INTO table_instituicao (NOME_INSTITUICAO, EMAIL, SENHA) VALUES (?,?,?)")or die('Ocorreu o seguinte erro: '.mysql_error());
			$qr->execute();
		}//fim da função que cadastrar a instituição

	}