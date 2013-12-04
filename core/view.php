<?php

class View {

	function __construct(){
		$root = realpath($_SERVER["DOCUMENT_ROOT"]).'/';
		require($root.'config/paths.php');
		$this->path = $root.$paths['views']; 
		$this->ext = '.php';
		
	}
	
	function load($file, $data = null){
		$this->partial('header');
		$this->partial($file, $data);
		$this->partial('footer');		
	}
	
	function partial($file, $data = null){
		if($data != null){
			extract($data);	
		}
		include($this->path.$file.$this->ext);
	}
}