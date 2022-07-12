<?php

require ROOT . DS . 'app/Vendor/m2brimagem.php';

class BannerController extends AppController {
	
	public function listar_cadastros() {
		$banners = $this->Banner->find('all', 
			array('conditions' => 
				array('ativo' => 1,
					  'usuario_id' => $this->instancia
				)
			)
		);
		
		$this->set('banners', $banners);

		$this->layout = 'wadmin';
	}

	public function adicionar_cadastro() {
		$this->loadModel('CategoriaBanner');

		$this->set('categorias', $this->CategoriaBanner->find('all', 
				array('conditions' => 
					array('ativo' => 1,
						  'usuario_id' => $this->instancia
					)
				)
			)
		);	

		$this->layout = 'wadmin';
	}

	public function editar_cadastro($id) {
		$this->loadModel('CategoriaBanner');
		
		$this->set('categorias', $this->CategoriaBanner->find('all', 
				array('conditions' => 
					array('ativo' => 1,
						  'usuario_id' => $this->instancia
					)
				)
			)
		);	

		$this->set('banner', $this->Banner->find('all', 
				array('conditions' => 
					array('ativo' => 1,
						  'id' => $id
					)
				)
			)[0]
		);

		$this->layout = 'wadmin';
	}

	public function s_editar_cadastro($id) {
		$dados = $this->request->data('dados');

		$image  = $_FILES['imagem'];
		
		if (!empty($image['name'])) {
			$retorno = $this->uploadImage($image);
			
			if (!$retorno['status']) 
				$this->Session->setFlash('Não foi possivel salvar a imagem tente novamente');
			
			$dados['imagem'] = $retorno['nome'];
		}


		$dados['id_usuario'] = $this->instancia;
		$dados['ativo'] = 1;

		$this->Banner->id = $id;
		
		if ($this->Banner->save($dados)) {
			$this->Session->setFlash('Banner editado com sucesso!','default','good');
            return $this->redirect('/banner/listar_cadastros');
		} else {
			$this->Session->setFlash('Ocorreu um erro ao editar o Banner!','default','good');
            return $this->redirect('/banner/listar_cadastros');
		}
	}

	public function s_adicionar_cadastro() {
		$this->loadModel('CategoriaBanner');

		$dados  = $this->request->data('dados');

		$categoriaBanner = $this->CategoriaBanner->find('first', array(
				'conditions' => array(
					'CategoriaBanner.id' => $dados['categoria_banner_id']
				)
			)
		);

		$image  = $_FILES['imagem'];

		$retorno = $this->uploadImage($image, $categoriaBanner);

		if (!$retorno['status']) 
			$this->Session->setFlash('Não foi possivel salvar a imagem tente novamente');

		$dados['src'] = $retorno['nome'];
		$dados['usuario_id'] = $this->instancia;
		$dados['ativo'] = 1;

		if($this->Banner->save($dados)) {
			$this->Session->setFlash('Banner salvo com sucesso!');
            return $this->redirect('/banner/listar_cadastros');
		} else {
			$this->Session->setFlash('Ocorreu um erro ao salva o banner!');
            return $this->redirect('/banner/listar_cadastros');
		}
	}

	public function uploadImage(&$image, $categoriaBanner) {
		$type = substr($image['name'], -4);
		
		$nameImage = uniqid() . md5($image['name']) . '.' . $type;

		$dir = APP . 'webroot/uploads/banner/imagens/';
		
		$returnUpload = move_uploaded_file($image['tmp_name'], $dir . $nameImage);
				
		$oImg = new m2brimagem($dir . $nameImage);
		
		$valida = $oImg->valida();
		
		if ($valida == 'OK') {
			$oImg->redimensiona($categoriaBanner['CategoriaBanner']['width'], $categoriaBanner['CategoriaBanner']['height'], 'crop');
		    $oImg->grava($dir . $nameImage);
		} else {
			die($valida);
		}
		
		if (!$returnUpload)
			return array('nome' => null, 'status' => false);

		return array('nome' => $nameImage, 'status' => true);
	}

	public function excluir_cadastro() {
		$this->layout = 'ajax';

		$id = $this->request->data('id');

		$dados = array ('ativo' => '0');
		$parametros = array ('id' => $id);

		if ($this->Banner->updateAll($dados, $parametros)) {
			echo json_encode(true);
		} else {
			echo json_encode(false);
		}
	}

}