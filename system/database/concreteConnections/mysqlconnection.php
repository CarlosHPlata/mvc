<?php 

class mysqlconnection extends dbconnection {

	function __construct($hostname, $dbusername, $dbpassword, $dbname) {
		parent::__construct($hostname, $dbusername, $dbpassword, $dbname);
	}

	public function get(){
		return 'asdasdjakjsdjas';
	}

	public function get_where(){

	}

	public function where(){

	}

	public function select(){

	}

	public function update(){

	}

	public function delete(){

	}

	public function rawQuery(){

	}

	protected function getConection(){

	}

	protected function closeConnection(){

	}

}