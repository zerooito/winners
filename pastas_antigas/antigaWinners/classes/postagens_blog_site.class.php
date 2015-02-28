<?php
 	require 'funcoes_diversas.class.php';
	class postagens_blog_site extends funcoes_diversas{
		private $Id_postagem;
		private $Titulo_postagem;
		private $Data_postagem;
		private $Texto_postagem;
		private $Id_usuario;

		function cadastrar_postagens_site($id_usuario){

		}

		function recuperar_posts_blog_site($id_usuario){
			$this->Id_usuario = $id_usuario;

			$qr = "SELECT * FROM postagens_blog_site WHERE id_usuario = ? ORDER BY data_postagem DESC LIMIT 0,5";
			$stmt = BD::conn()->prepare($qr);
			$stmt->execute(array($this->Id_usuario));

			return $stmt->fetchAll();
		}

		function contar_posts_blog_site($id_usuario){
			$this->Id_usuario = $id_usuario;

			$qr = "SELECT * FROM postagens_blog_site WHERE id_usuario = ?";
			$stmt = BD::conn()->prepare($qr);
			$stmt->execute(array($this->Id_usuario));

			return $stmt->rowCount();
		}
	}