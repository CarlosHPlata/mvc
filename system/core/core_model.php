<?php  

class core_model{

	function __construct(){
		$dbdriver = new dbdriver();
		$this->db = $dbdriver->getDB();
	}

}