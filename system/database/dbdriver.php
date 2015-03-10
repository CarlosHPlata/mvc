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
				$this->dbfactory = new csvfactory($database);
				break;
			default:
				echo 404;
				break;
		}
	}

	function getDB(){
		return $this->dbfactory->getDbConnection();
	}
}