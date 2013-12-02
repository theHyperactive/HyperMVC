<?php 

class Request {
	
	public $http_response_code; 
	public $rest_response_code;
	public $response_code;
	public $response_status;
	public $response_msg;
	public $request_headers;
	public $post_body;
	public $is_json;
	public $required_fields;
	public $is_valid;

	protected $HTTPS_required = FALSE;
	protected $authentication_required = FALSE;
	
	function __construct(){
		$this->request_headers = apache_request_headers();
		$this->get_json_object(file_get_contents('php://input'));

		$this->http_response_code = array(
			200 => 'OK',
			400 => 'Bad Request',
			401 => 'Unauthorized',
			403 => 'Forbidden',
			404 => 'Not Found'
		);

		$this->rest_response_code = array(
			array('HTTP Response' => 400, 'Message' => 'Unknown Error'),
			array('HTTP Response' => 200, 'Message' => 'Success'),
			array('HTTP Response' => 403, 'Message' => 'HTTPS Required'),
			array('HTTP Response' => 401, 'Message' => 'Authentication Required'),
			array('HTTP Response' => 401, 'Message' => 'Authentication Failed'),
			array('HTTP Response' => 404, 'Message' => 'Invalid Request'),
			array('HTTP Response' => 400, 'Message' => 'Invalid Response Format')
		);
		
		$this->init();
		if($this->response_code == 1)
			$this->is_valid = TRUE;
		else 
			$this->is_valid = FALSE;
	}
	
	function init(){
		$this->response_code = 1;
		
		if($this->HTTPS_required && $_SERVER['HTTPS'] != 'on'){
			$this->response_code = 2;
		}
		
		if(!empty($this->request_headers['Content-Type']) && strstr($this->request_headers['Content-Type'], 'application/json') == 'application/json'){
			if($this->is_json)
				$this->response_code = 1;
			else
				$this->response_code = 5;				
		}
		else{
			$this->response_code = 5;
		}

		if($this->authentication_required){
			if($this->is_json){
				if(empty($this->post_body->username) || empty($this->post_body->password)){
					$this->response_code = 3;
				}
				elseif($this->post_body->username != 'user' || $this->post_body->password != 'pass' ){
					$this->response_code = 4;
				}
			}
			else{
				$this->response_code = 5;
			}
		}
		
		if(!empty($this->request_headers['Accept']) && $this->request_headers['Accept'] != '*/*'){
			if(!strstr($this->request_headers['Accept'], 'application/json')){
					$this->response_code = 6;	
			}	
		}	
		
		$this->response_status = $this->rest_response_code[$this->response_code]['HTTP Response'];
		$this->response_msg = $this->rest_response_code[$this->response_code]['Message'];
		$this->set_headers();
	}
	
	protected function set_headers(){
		header('HTTP/1.1 '.$this->response_status.' '.$this->http_response_code[$this->response_status]);
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Credentials: true"); 
    header('Access-Control-Allow-Headers: X-Requested-With');
    header('Access-Control-Allow-Headers: Content-Type');
	}
	
	protected function get_json_object($post_body){
		$this->post_body = json_decode($post_body);
		if(json_last_error() == 0)
			$this->is_json = 1;
		else
			$this->is_json = 0;
	}
	
	function validate_incoming_data(){
		if(!empty($this->required_fields) && $this->is_json){
			foreach($this->required_fields as $required_field){
				if(!empty($required_field))
					$this->response_code = 1;
				else
					$this->response_code = 5;
			}
		}
	}
	
}