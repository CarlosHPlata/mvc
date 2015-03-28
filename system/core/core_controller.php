<?php 

class core_controller {

	function __construct(){
		
	}

	protected function load_view($viewName, $data=array(), $async = false){
		if (file_exists(APP_BASE."/view/$viewName.php")) {
			$view = new view();
			return $view->load($viewName, $data, $async);
		} else {
			error::showError('la vista '.$viewName.' no puede ser encontrada');
			die();
		}
	}

	protected function load_model($modelName){
		$this->$modelName = new $modelName();
	}

	protected function redirect($url, $permanent = false)
	{
	    if (headers_sent() === false)
	    {
	    	header('Location: ../' . $url, true, ($permanent === true) ? 301 : 302);
	    }

	    exit();
	}
}