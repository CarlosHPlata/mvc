<?php 

class entity {

	private $attrs_table = array();

	function __construct(){
		$this->get_table_atrrs();
		$this->create_query();
	}

	private function get_table_atrrs(){
		$obj = get_object_vars($this);
		$final = array();
		foreach ($obj as $key => $value) {
			$temp = substr($key, 0, 5);
			if ($temp == "attr_"){
				$varName = substr($key, 5, strlen($key)-1 );
				$final[$varName] = $value;
			}
		}
		$this->attrs_table = $final;
		return $this->attrs_table;
	}

	public function set_table_atrrs($result){
		foreach ($result as $key => $value) {
			$newKey = 'attr_'.$key;
			$this->$newKey = $value;
		}
	}

	/*
		CREATE TABLE MyGuests (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		firstname VARCHAR(30) NOT NULL,
		lastname VARCHAR(30) NOT NULL,
		email VARCHAR(50),
		reg_date TIMESTAMP
		)
	*/

	public function create_query(){
		$query = "CREATE TABLE ".get_class($this)." (";
		$count = 0;

		foreach ($this->get_table_atrrs() as $key => $value) {
			if ($count > 0) $query .= ", ";
			$query .= $key." ";
			if($value == 'id')
				$query .= "INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY";
			else 
				$query .= strtoupper($value);
			$count++;
		}

		$query .= ")";
		echo $query;
	}

}