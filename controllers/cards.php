<?php 

class Cards {
	
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
		$data = array(
			array(
				'id' => '1',
				'cardName' => 'Kartica 1',
				'remainingAmount' => '300,00',
				'currency' => 'HRK'
			),
			array(
				'id' => '1',
				'cardName' => 'Kartica 2',
				'remainingAmount' => '123,00',
				'currency' => 'HRK'
			),
			array(
				'id' => '1',
				'cardName' => 'Kartica 3',
				'remainingAmount' => '100456,00',
				'currency' => 'HRK'
			)
		);
		$this->response->send($data);
	}
	
	function details(){
		$data = array(
			'id' => '1',
			'cardName' => 'Kartica 1',
			'remainingAmount' => '100,00',
			'startingAmount' => '1230,00',
			'monthlyCosts' => '230,00',
			'currency' => 'HRK',
		);
		$this->response->send($data);		
	}
	
	function new_card(){
		if(!empty($this->request->post_body))
			$this->response->send(array('status' => 'ok'));
		else
			$this->response->send(array('status' => 'prazan post body, nesto moras poslat u post body'));			
	}
	
	function new_card_request(){
		if(!empty($this->request->post_body))
			$this->response->send(array('status' => 'ok'));
		else
			$this->response->send(array('status' => 'prazan post body, nesto moras poslat u post body'));			
	}
	
	function supplement(){
		if(!empty($this->request->post_body))
			$this->response->send(array('status' => 'ok'));
		else
			$this->response->send(array('status' => 'prazan post body, nesto moras poslat u post body'));
	}	
}