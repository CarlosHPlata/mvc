<?php 

abstract class dbconnection {

	function __construct($dbhostname, $dbusername, $dbpassword, $dbname){
		

		$this->dbhostname	= $dbhostname;
		$this->dbusername	= $dbusername;
		$this->dbpassword	= $dbpassword;
		$this->dbname		= $dbname;
	}

	public abstract function get($entitie);

	public abstract function get_where($entitie, $arrayWhere);

	public abstract function where($arrayWhere);

	public abstract function select($arraySelect);

	public abstract function update();

	public abstract function delete();

	public abstract function rawQuery();

	protected abstract function getConection();

	protected abstract function closeConnection();
}