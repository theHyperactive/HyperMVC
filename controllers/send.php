<?php 

class Send {

	protected $save;
	protected $request;
	protected $response;

	function __construct(){
		$this->save = new Save();
		$this->request = new Request();
		$this->response = new Response($this->request);
	}
	
	function index($args){
		$this->request->required_fields = array('datum_rodenja', 'staz', 'datum_prijave', 'ime', 'strucna_sprema', 'prezime');
		if($this->request->is_valid){
			$this->save->application($this->request->post_body);
		}		
		$this->response->send();
	}	
}