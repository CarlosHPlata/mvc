<?php 
class prueba extends entity{

	public $attr_id = "id";
	public $attr_name = "varchar(45)";
	public $attr_password = "text";
	public $attr_date = "date";

	function __construct(){
		parent::__construct();
	}
}