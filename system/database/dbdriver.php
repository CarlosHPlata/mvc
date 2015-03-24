<?php 

class dbdriver{
	
	function __construct() {
		$config = config::getInstance();
		$database = $config->getDBConfig();

		if (isset($database['dbdriver'])){
			switch ($database['dbdriver']) {
				case 'mysql':
					$this->dbfactory = new mysqlfactory($database);
					break;
				case 'csv':
					$this->dbfactory = new csvfactory($database);
					break;
				default:
					error::showError('El dbdriver que intenta cargar no esta configurado en el framework');
					die();
					break;
			} 
		} else {
			error::showError('La configuración de la base de datos parece no ser correcta');
			die();
		}
	}

	function getDB(){
		return $this->dbfactory->getDbConnection();
	}
}