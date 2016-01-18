<?php
require_once(LIB_PATH.DS.'log.php');

class Session{
	private $message;
	private $user_id;
	private $admin = false;
	private $logged_in = false;
	
	function __construct(){
		session_start();
		$this->check_message();
		$this->check_login();
		/*if($this->logged_in){
			//actions to take right away if user is logged in
		}else{
			//actions to take right away if user is not logged in
		}*/
		
	}
	
	public function set_message($msg=""){
		$_SESSION['message'] = $msg;
		$this->message = $msg;
	}
	
	public function output_message(){
		//TODO: change css and and use jquery to make this disappear after a few seconds
		echo $this->message;
		$_SESSION['message'] = "";
		$this->message = "";
	}
	
	public function get_id(){
		if(isset($this->user_id)){
			return $this->user_id;
		}else{
			return 0;
		}
	}
	
	public function set_last_page(){
		if(!isset($_SESSION['current_page']) || $_SESSION['current_page'] != Session::current_page_url()){
			$current_page = isset($_SESSION['current_page']) ? $_SESSION['current_page'] : "";
			$_SESSION['last_page'] = $current_page;
			$_SESSION['current_page'] = Session::current_page_url();
			$log = new Log('navigation');
			$log->add_entry('Page Change', $_SESSION['current_page'] . "- " . $_SESSION['last_page'] );
		}
	}
	
	public function protected_content(){
		if($this->admin){
			return content();
		}else{
			$session->set_message("You must be an admin to view this page: Click <a href='javascript: history.go(-1)'>here</a> to return to the previous page.");
			$session->output_message();
		}
	}
	
	public function is_logged_in(){
		return $this->logged_in;
	}
	
	public function login($user){
		if($user){
			$this->user_id = $_SESSION['user_id'] = $user->id;
			$this->admin = $_SESSION['admin'] = ($user->type == 1) ? true : false;
			$this->logged_in = true;
			$log = new Log('login');
			$log->add_entry('Login', 'success');
		}
	}
	
	public function logout(){
		$log = new Log('login');
		$log->add_entry('Logout', 'success');
		unset($_SESSION['user_id']);
		$this->check_login();
	}
	
	private function check_login(){
		if(isset($_SESSION['user_id'])){
			$this->user_id = $_SESSION['user_id'];
			$this->admin = $_SESSION['admin'];
			$this->logged_in = true;
			return true;
		}else{
			unset($this->user_id);
			unset($this->admin);
			$this->logged_in = false;
			return false;
		}
	}
	
	private function check_message(){
		if(isset($_SESSION['message'])){
			$this->message = $_SESSION['message'];
		}else{
			$this->message = "";
			unset($_SESSION['message']);
		}
	}

	private static function current_page_url(){
		$pageURL = 'http';
		if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if($_SERVER["SERVER_PORT"] != "80"){
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		}else{
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
}
?>