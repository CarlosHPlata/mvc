<?php 
class view {

	function load($view, $data, $async){
		if (is_array($data)){
			foreach ($data as $key => $value) {
				$$key = $value;
			}
		}

		if ($async) {
			ob_start();
			include('aplication/view/'.$view.'.php');
			$buffer = ob_get_contents();
			@ob_end_clean();
			return $buffer;
		} else {
			include('aplication/view/'.$view.'.php');
		}
	}

}