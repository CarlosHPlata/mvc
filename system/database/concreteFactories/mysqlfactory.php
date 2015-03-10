<?php 

class mysqlfactory extends dbfactory {

	function __construct($database){
		parent::__construct($database);
	}

	public function getDbConnection(){
		return new mysqlconnection($this->database['dbhostname'], $this->database['dbusername'], $this->database['password'], $this->database['dbname']);
	}
}