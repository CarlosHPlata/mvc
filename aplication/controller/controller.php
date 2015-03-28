<?php 
class controller extends core_controller {

	function __construct() {
		parent::__construct();
   }

	function action(){
		$this->load_view('view');
	}

}