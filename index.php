<?php

require_once("core/router.php");

try{ 
	$index = new Router();
	$index->init();
}
catch (Exception $e){
	echo $e->getMessage();
		exit();
}

?>