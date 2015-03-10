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

	public abstract function update($entitie, $data);

	public abstract function delete($entitie);

	public abstract function rawQuery($query);

	public abstract function insert($entitie, $data);

	protected abstract function getConection();

	protected abstract function closeConnection();
}