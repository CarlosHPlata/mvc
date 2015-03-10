<?php 

abstract class dbconnection {

	private $SELECTDEFAULT = '*';
	private $WHEREDEFAULT  = '';

	function __construct($dbhostname, $dbusername, $dbpassword, $dbname){
		

		$this->dbhostname	= $dbhostname;
		$this->dbusername	= $dbusername;
		$this->dbpassword	= $dbpassword;
		$this->dbname		= $dbname;

		$this->selectQuery = $this->SELECTDEFAULT;
		$this->whereQuery = $this->WHEREDEFAULT;
		$this->tableName = '';
	}

	public abstract function get();

	public abstract function get_where();

	public abstract function where();

	public abstract function select();

	public abstract function update();

	public abstract function delete();

	public abstract function rawQuery();

	protected abstract function getConection();

	protected abstract function closeConnection();
}