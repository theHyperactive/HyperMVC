<?php 

class Get {
	
	protected $load;
	protected $request;
	protected $response;
	
	function __construct(){
		$this->load = new Load();
		$this->request = new Request(); 
		$this->response = new Response($this->request);
	}
	
	function index(){
		if($this->request->is_valid){
			$data = $this->load->applications();
			$this->response->send($data);
		}
		else{
			$this->response->send();
		}
	}
}