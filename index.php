<?php

require_once("router.php");

try{ 
	$index = new Router();
	$index->init();
}
catch (Exception $e){
	echo $e->getMessage();
		exit();
}

?>