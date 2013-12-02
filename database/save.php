<?php 

class Save {
	
	function __construct(){
		$this->db = Database::connect();
	}
	
	function application($post_data){
		$data = array(
			'ime' 					 => $post_data->ime,
			'prezime' 			 => $post_data->prezime,
			'datum_rodenja'  => $post_data->datum_rodenja,
			'staz' 					 => $post_data->staz,
			'strucna_sprema' => $post_data->strucna_sprema 
		);
		
		$insert = $this->db->prepare("
			insert into 
				prijava 
			set
				ime = :ime, 
				prezime = :prezime, 
				datum_rodenja = :datum_rodenja, 
				staz = :staz, 
				strucna_sprema = :strucna_sprema, 
				datum_prijave = NOW()
		");
		$insert->execute($data);	
	}
}