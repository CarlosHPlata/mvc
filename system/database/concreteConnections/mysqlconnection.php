<?php 

class mysqlconnection extends dbconnection {

	private $SELECTDEFAULT = '*';
	private $WHEREDEFAULT  = '';

	function __construct($hostname, $dbusername, $dbpassword, $dbname) {
		parent::__construct($hostname, $dbusername, $dbpassword, $dbname);
		$this->resetData();
		$this->getConection();
	}

	public function get($tableName){
		$rows = array();
		$this->tableName = $tableName;
		$query = 'SELECT '.$this->selectQuery.' FROM '.$this->tableName;
		if ($this->whereQuery != '') $query .= $this->whereQuery;

		$consulta = $this->connection->prepare($query);

		if (!$consulta) {
			$this->resetData();
			error::showError("Error en la sentencia insert: <br> $query");
			die();
		} else {
			$consulta->execute();
			$this->resetData();
			return $consulta->fetchAll();
		}

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
				$query .= ' '.$key.' ';
				if (ctype_alpha( substr($key, -1) ) || ctype_digit( substr($key, -1) )) $query .= '= ';
				$query .= (is_string($value))? '"'.$value.'"' : $value;
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
		//UPDATE `mvc`.`users` SET `lastName` = 'asad' WHERE `users`.`id` = 1;
		$quey = 'UPDATE '.$table.' SET ';
		$count = 0;
		foreach ($data as $key => $value) {
			if ($count > 0) $query .= ', ';
			$query .= $key.' = ';
			$quey  .= (is_string($value))? '"'.$value.'"' : $value;
			$count++;
		}
		if ($this->whereQuery != '') $query .= ' '.$this->whereQuery;

		$consulta = $this->connection->prepare($query);

		if (!$consulta) {
			$this->resetData();
			error::showError("Error en la sentencia insert: <br> $query");
			die();
		} else {
			$consulta->execute();
			$this->resetData();
			return true;
		}
	}

	public function update_where($table, $data, $arrayWhere){
		$this->where($arrayWhere);
		$this->update($table, $data);
	}

	public function delete($table){
		//DELETE FROM `mvc`.`users` WHERE `users`.`id` = 5
		$query = "DELETE FROM ".$table.' ';
		if ($this->whereQuery != '') $query .= ' '.$this->whereQuery;

		$consulta = $this->connection->prepare($query);

		if (!$consulta) {
			$this->resetData();
			error::showError("Error en la sentencia insert: <br> $query");
			die();
		} else {
			$consulta->execute();
			$this->resetData();
			return true;
		}
	}

	public function delete_where($table, $arrayWhere){
		$this->where($arrayWhere);
		$this->delete($table);
	}

	public function rawQuery($query){
		$consulta = $this->connection->prepare($query);

		if (!$consulta) {
			$this->resetData();
			error::showError("Error en la sentencia insert: <br> $query");
			die();
		} else {
			$consulta->execute();
			$this->resetData();
			return $consulta;
		}
	}

	public function insert($table, $data){
		$query = 'INSERT INTO '.$table;
		$colums = ' (';
		$values = ') VALUES (';
		$count = 0;
		foreach ($data as $key => $value) {
			if ($count > 0){
				$colums .= ", ";
				$values .= ", ";
			}
			$colums .= $key;
			$values .= (is_string($value))? '"'.$value.'"' : $value;
		 	$count++;
		}
		$values .= ")";
		
		$query .= $colums . $values; 

		$consulta = $this->connection->prepare($query);
		if (!$consulta) {
			error::showError("Error en la sentencia insert: <br> $query");
			die();
		} else {
			$consulta->execute();
			$lastId = $this->connection->lastInsertId();
			$this->resetData();
			return $lastId;
		}
	}

	protected function getConection(){
		try{
			$this->connection = new PDO('mysql:host='.$this->dbhostname.';dbname='.$this->dbname, $this->dbusername, $this->dbpassword);
		} catch (PDOException $e){
			error::showError('No se ha podido cargar la base de datos <br>'.$e->getMessage());
		}
	}

	protected function closeConnection(){
		return 0;
	}

	private function executeQuery($query){
		$consulta = $this->connection->prepare($query);

		if (!$consulta) {
			$this->resetData();
			error::showError("Error en la sentencia insert: <br> $query");
			die();
		} else {
			$consulta->execute();
			$this->resetData();
			return $consulta;
		}
	}

	private function resetData(){
		$this->selectQuery = $this->SELECTDEFAULT;
		$this->whereQuery = $this->WHEREDEFAULT;
		$this->tableName = '';
	}

}