<?php 

class Model_eg {
	
	protected $db;
	
	function __construct(){
		$this->db = Database::connect();
	}
	
	function select_data(){
		echo "select data";
		$select = $this->db->prepare("select * from some_table");
		if($select->execute()){
			while ($r = $select->fetchObject())
				$result[] = $r;	
		}
		return $result;
	}
	
	function insert_data($post_data){
		$data = array(
			'first_name' => $post_data->first_name,
			'last_name'  => $post_data->last_name,
			'birthday'   => $post_data->birthday,
		);
		
		$insert = $this->db->prepare("
			insert into 
				some_table 
			set
				first_name = :first_name, 
				last_name  = :last_name, 
				birthday 	 = :birthday
		");
		
		$insert->execute($data);	
	}
}