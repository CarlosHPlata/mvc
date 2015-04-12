<?php 
class app {

	function __construct($config, $database) {
       $this->config = $config;
       $this->database = $database;
       $configClass = config::getInstance();
       $configClass->setBaseConfig($config);
       $configClass->setDBConfig($database);
   }


	function run(){

		$request    	= trim(@$_SERVER['PATH_INFO'], '/');
		$uriSegments 	= explode('/', $request);

		foreach ($uriSegments as $key => $value) {
			if ($value == $this->config['app_name']){
				$uriSegments = array_slice($uriSegments, $key+1);
				break;
			}
		}

		$controller = isset($uriSegments[0])? $uriSegments[0] : false;
		$function 	= isset($uriSegments[1])? $uriSegments[1] : false;
		$variables  = isset($uriSegments[2])? array_slice($uriSegments, 2) : false;

		$this->load_controller($controller, $function, $variables);
	}


	function load_controller($controller_name, $function, $variables) {
		if ($controller_name && $controller_name != ''){

			if (class_exists($controller_name, true)) {
			    $controller = new $controller_name();

			    if ($function){
			    	if (method_exists($controller, $function) && is_callable(array($controller, $function))){
			    		call_user_func_array(array($controller, $function), $variables? $variables : array());
			    	} else {
			    		error::showError('No se puede localizar la url solicitada');
			    		die();
			    	} 
			    } else {
			    	$controller->action();
			    }
			} else {
				error::showError('No se puede localizar la url solicitada');
			    die();
			} 

		} else {
			$controller = new $this->config['default_controller']();
			$controller->action();
		}
	}


}
