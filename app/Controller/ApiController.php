<?php

class ApiController extends AppController {

	public function beforeFilter(){
		return true;
   	}

	public function noticeOfTheTheft() {
	    // no view to render
	    $this->autoRender = false;
	    $this->response->type('json');
	    
	    if ($this->request->is('get')) {
	    	$this->listNoticesOfTheTheft();
	    } else if ($this->request->is('post')) {
	    	// $this->saveNoticeOfTheTheft('');
	    	echo 'post';
	    } else if ($this->request->is('put')) {
	    	echo 'put';
	    } else if ($this->request->is('delete')) {
	    	echo 'delete';
	    }

	}

	public function listNoticesOfTheTheft() {
	    $json = json_encode(
	    	array(
	    		'message'=>'GET request not allowed!'
	    	)
	    );

	    $this->response->body($json);

	}

	public function loginNoticeOfTheTheft() {
	    $this->autoRender = false;
	    $this->response->type('json');

		if (!$this->request->is('post')) {
			$json = json_encode(array('message' => 'Você não tem permissão'));
		}

		$this->response->body($json);
	}

}