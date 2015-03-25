<?php 

class muser extends core_model {

	function __construct(){
		parent::__construct();
	}

	function getUsers(){
		//$this->db->where(array('firstName !=' => 'carlos'));
		return $this->db->get('users');
	}

	function insertUser($name, $lastname, $user, $pass){
		$data = array();
		$data['firstName'] = $name;
		$data['lastName'] = $lastname;
		$data['user'] = $user;
		$data['password'] = $pass;
		$this->db->insert('users',$data);
	}

	
}