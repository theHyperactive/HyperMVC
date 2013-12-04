<?php

class Welcome {

	function __construct(){
		$this->view = new View();
		$this->model_eg = new Model_eg();
	}
	
	function index(){
		$this->view->load('index');
	}
	
	function load_view($type){
		$data['title'] = 'View loaded!';
		$data['people'] = $this->model_eg->select_data();
		$this->view->load('db_test', $data);
	}
}

?>