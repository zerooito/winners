<?php
class WAdminController extends AppController{
	function index(){
		$this->layout = 'wadmin';

	}

	function paginas(){
		$this->layout = 'wadmin';

	}

	function atualizar_dados_home(){
		$this->layout = 'ajax';
		$this->loadModel('Pagina_home_siteModel');

		$title_home	= $this->request->data['title_home'];
		$description_home = $this->request->data['description_home'];
		$keywords_home = $this->request->data['keywords_home'];
		$empresa_home = $this->request->data['empresa_home'];
		$id_usuario = $this->request->data['id_usuario'];


	}
}