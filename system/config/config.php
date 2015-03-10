<?php 

class config {
	private static $instance = null;

	private function __construct(){}

	public static function getInstance(){
		if (static::$instance ==  null ){
			static::$instance = new config();
		}
		return static::$instance;
	}

	public function setBaseConfig($config){
		$this->congig = $config;
	}

	public function setDBConfig($database){
		$this->dbconfig = $database;
	}

	public function getBaseConfig(){
		return $this->congig;
	}

	public function getDBConfig(){
		return $this->dbconfig;
	}
}