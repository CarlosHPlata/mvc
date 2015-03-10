<?php 

class muser extends core_model {

	function __construct(){
		parent::__construct();
	}

	function getUsers(){
		return $this->db->get();
	}

	function insertUser($name, $lastname, $user, $pass){
		$data = array();
		$data[] = $name;
		$data[] = $lastname;
		$data[] = $user;
		$data[] = $pass;
		$this->db->insert($data);
	}

	
}