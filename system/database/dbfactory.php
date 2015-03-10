<?php 
abstract class dbfactory {

	function __construct($database){
		$this->database = $database;
	}

	public abstract function getDbConnection();
}