<?php 

class mysqlconnection extends dbconnection {

	private $SELECTDEFAULT = '*';
	private $WHEREDEFAULT  = '';

	function __construct($hostname, $dbusername, $dbpassword, $dbname) {
		parent::__construct($hostname, $dbusername, $dbpassword, $dbname);
		$this->resetData();
	}

	public function get($tableName){
		$this->tableName = $tableName;
		$query = 'SELECT '.$this->selectQuery.' FROM '.$this->tableName;
		if ($this->whereQuery != '') $query .= $this->whereQuery;
	}

	public function get_where($tableName, $arrayWhere){
		$this->where($arrayWhere);
		$this->get($tableName);
	}

	public function where($whereArray){
		$query =' WHERE ';
		if (is_array($whereArray)){
			$count = 0;
			foreach ($whereArray as $key => $value) {
				if ($count > 0) $query .= ' AND ';
				$query .= ' '.$key.' = '.$value;
				$count++;
			}
			$this->whereQuery = $query;
		} else return false;
	}

	public function select($arraySelect){
		if (is_array($arraySelect)){
			$count = 0;
			$query = '';
			foreach ($arraySelect as $key => $value) {
				if ($count > 0) $query .= ', ';
				$query .= $value;
				$count++;
			}
			$this->selectQuery = $query;
		}

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

	private function executeQuery($query){
		echo $query;
	}

	private function resetData(){
		$this->selectQuery = $this->SELECTDEFAULT;
		$this->whereQuery = $this->WHEREDEFAULT;
		$this->tableName = '';
	}

}