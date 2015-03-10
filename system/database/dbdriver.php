<?php 

class dbdriver{
	
	function __construct() {
		$config = config::getInstance();
		$database = $config->getDBConfig();

		switch ($database['dbdriver']) {
			case 'mysql':
				$this->dbfactory = new mysqlfactory($database);
				break;
			case 'csv':
				echo "csv";
				break;
			default:
				# code...
				break;
		}
	}

	function getDB(){
		return $this->dbfactory->getDbConnection();
	}
}