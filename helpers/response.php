<?php

class Response {
	
	public $request;
	public $valid;
	
	protected $response_data;
	
	function __construct($request_obj){
		$this->request = $request_obj;
		$this->init();
	}
	
	function init(){
		if($this->request->response_code == 2){
			$this->send_json_body();
			exit();
		}
	}
	
	function send($response_data = null){
		$this->send_json_body($response_data);
	}
	
	protected function send_json_body($response_data){
		$json_response = array(
			'code' => $this->request->response_code,
			'status' => $this->request->response_status,
			'message' => $this->request->response_msg,		
		);
		$json_response['data'] = $response_data;
		echo json_encode($json_response);
	}	
}