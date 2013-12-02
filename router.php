<?php
class Router{
	
	protected $url;
	protected $controller;
	protected $method;
	protected $args;
	
	function init(){
		$this->get_url();	
		$this->set_controller();
		$this->set_method();
		$this->set_args();
		$this->load_models();
		$this->load_helpers();
		$content = new $this->controller;
		$method = $this->method;
		$content->$method($this->args);
	}
	
	function get_url(){
  	$requestURI = explode('/', $_SERVER['REQUEST_URI']);
    $scriptName = explode('/',$_SERVER['SCRIPT_NAME']);
      for($i= 0;$i < sizeof($scriptName);$i++){
          if ($requestURI[$i] == $scriptName[$i]){
          	unset($requestURI[$i]);
          }
      }
    $this->url = array_values($requestURI); 
    $this->urlsize = count($this->url);
  }

	function set_controller(){
		if(!empty($this->url[0])){
			 $this->controller = $this->url[0];
		}
		else{
			$this->controller = 'get';
		}
		$this->file = 'controllers/'.strtolower($this->controller).'.php';
		require_once($this->file);
	}
	
	function set_method(){
		if(!empty($this->url[1]))
			$this->method = $this->url[1];
		else
			$this->method = 'index';
	}
	
	function set_args(){
		if (!empty($this->url[2])){
			$this->args = $this->url[2];
		}
		else{
			$this->args = NULL;
		}
		
		if ($this->urlsize >= 3){
			$this->args = array();
			for ($i=2; $i<$this->urlsize; $i++){
				$this->args[] = $this->url[$i];
			}
		}
		else{
			$this->args = NULL;
		}		
	}
	
	function load_models(){
		$models = array('database', 'save', 'load');
		$location = 'database/';
		$ext = '.php';
		foreach($models as $model){
			require_once($location.$model.$ext);		
		}
	}
	
	function load_helpers(){
		$helpers = array('response', 'request');
		$location = 'helpers/';
		$ext = '.php';
		foreach($helpers as $helper){
			require_once($location.$helper.$ext);		
		}
	}
	
}