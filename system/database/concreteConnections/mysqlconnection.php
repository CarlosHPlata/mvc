<?php 

class mysqlconnection extends dbconnection {

	function __construct($hostname, $dbusername, $dbpassword, $dbname) {
		parent::__construct($hostname, $dbusername, $dbpassword, $dbname);
	}

	public function get($table){
		return 'asdasdjakjsdjas';
	}

	public function get_where($table, $arrayWhere){

	}

	public function where($arrayWhere){

	}

	public function select($arraySelect){

	}

	public function update($table, $data){

	}

	public function delete($table){

	}

	public function rawQuery($query){

	}

	public function insert($table, $data){

	}

	protected function getConection(){

	}

	protected function closeConnection(){

	}

}