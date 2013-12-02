<?php

class Login {
	
	protected $load;
	protected $request;
	protected $response;
	
	function __construct(){
		$this->load = new Load();
		$this->request = new Request(); 
		$this->response = new Response($this->request);
		if(!$this->request->is_valid){
			$this->response->send();
			exit();
		}
	}
	
	function index(){
		$data = json_encode(array('loged_in' => 1));
		$this->response->send($data);
	}
}