<?php 
class user extends core_controller {

	function __construct() {
       $this->data['css'] = array('public/bootstrap/css/bootstrap.min.css', 'public/css/login.css' );
   }

	function action(){
		$this->data['content'] = $this->load_view('loginForm', array(), true);
		//$this->load_view('templates/template', $this->data);
		$this->load_model('muser');
		$this->muser->db->select(array('nombre', 'contrasena'));
		$this->muser->db->where(array('id'=>'1'));
		echo $this->muser->db->get('user');
	}

	function enter(){
		if (isset($_POST['username']) && isset($_POST['password'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];

			$this->load_model('user');
			$user = new user('', '', $username, $password);
			if ($user->autenticate()){
				echo 'yeeeees';
			} else {
				echo 'asdasdas';
			}
		} else {
			$this->redirect('login');
		}
	}

	function logout($uno, $dos){
		echo $uno.' y '.$dos;
	}

}