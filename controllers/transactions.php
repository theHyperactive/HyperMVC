<?php 

class Transactions {
	
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
				'transactionName' => 'Transakcija 1',
				'category' => 'kategorija 1',
				'amount' => '1234,00',
				'timestamp' => strtotime(date('c')),
				'points' => '20'
			),
			
			array(
				'transactionName' => 'Transakcija 2',
				'category' => 'kategorija 2',
				'amount' => '4321,00',
				'timestamp' => strtotime(date('c')),
				'points' => '2'
			),
			
			array(
				'transactionName' => 'Transakcija 3',
				'category' => 'kategorija 1',
				'amount' => '134,00',
				'timestamp' => strtotime(date('c')),
				'points' => '200'
			)
		); 	
		$this->response->send($data);
	}
	
	function details(){
		$data = array(
			'transactionName' => 'Transakcija 3',
			'location' => 'Dućan 1',
			'category' => 'kategorija 1',
			'amount' => '134,00',
			'points' => '200'
		);
		$this->response->send($data);
	}
	
	function new_transaction(){
		if(!empty($this->request->post_body))
			$this->response->send(array('status' => 'ok'));
		else
			$this->response->send(array('status' => 'prazan post body, nesto moras poslat u post body'));
	}
	
	function transfer(){
		if(!empty($this->request->post_body))
			$this->response->send(array('status' => 'ok'));
		else
			$this->response->send(array('status' => 'prazan post body, nesto moras poslat u post body'));
	}
	
	function import_csv(){}
}