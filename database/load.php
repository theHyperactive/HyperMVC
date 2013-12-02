<?php 

class Load {
	
	function __construct(){
		$this->db = Database::connect();
	}
	
	function applications(){
		$select = $this->db->prepare("select * from prijava");
		if($select->execute()){
			while ($r = $select->fetchObject())
				$result[] = $r;	
		}
		return $result;
	}
}