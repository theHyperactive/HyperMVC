<?php
class Router{
	
	protected $url;
	protected $controller;
	protected $method;
	protected $args;
	
	function __construct(){
  	$http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
		$this->base_link = $_SERVER['HTTP_HOST'] . '/';
		$this->base_url = $http . '://' . $_SERVER['HTTP_HOST'] . '/';
		$this->root = realpath($_SERVER["DOCUMENT_ROOT"]).'/';
	}
	
	function init(){
		$this->load_configs();	
		$this->get_url();
		$this->set_controller();
		$this->set_method();
		$this->set_args();
		$this->prepare_view_loader();
		$this->prepare_db_connection();
		$this->load_models();
		$this->load_helpers();
		$content = new $this->controller;
		$method = $this->method;
		$content->$method($this->args);
	}
	
	function load_configs(){
		require_once($this->root.'config/load.php');
		require($this->root.'config/paths.php');
		$this->paths = $paths;
		$this->load = $load;	
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
			$this->controller = $this->load['controller'];
		}
		
		$this->file = $this->paths['controllers'].strtolower($this->controller).'.php';
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
	
	function prepare_view_loader(){
		$file = 'view';
		$ext = '.php';
		$path = $this->root.'core/';
		require_once($path.$file.$ext);
	}
	
	function prepare_db_connection(){
		$file = 'database';
		$ext = '.php';
		$path = $this->root.'core/';
		if($this->load['database']){
			require_once($path.$file.$ext);
		}			
	}
	
	function load_models(){
		$models = $this->load['models'];
		$ext = '.php';
		foreach($models as $model){
			require_once($this->paths['models'].$model.$ext);		
		}
	}
	
	function load_helpers(){
		$helpers = $this->load['helpers']; 
		$ext = '.php';
		foreach($helpers as $helper){
			require_once($this->paths['helpers'].$helper.$ext);		
		}
	}
}