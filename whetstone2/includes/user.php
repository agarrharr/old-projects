<?php
require_once(LIB_PATH.DS.'database.php');

class User extends DatabaseObject{
	protected static $table_name = "user";
	protected static $db_fields = array('id', 'type', 'fname', 'lname', 'email', 'phone', 'version', 'weekly', 'monthly', 'yearly', 'hashed_pass', 'fb_access_token');
	public $id;
	public $type;
	public $fname;
	public $lname;
	public $email;
	public $phone;
	public $version;
	public $weekly;
	public $monthly;
	public $yearly;
	protected $hashed_pass;
	protected $fb_access_token;
	
	/*function __construct(){
		if(isset($_SESSION['user_id'])){
			echo $_SESSION['user_id'];
			$user = User::find_by_id($_SESSION['user_id']);
		}else{
			//$user = User::find_by_id(0);
		}
	}*/
	
	public function get_login_link(){
		if(isset($this->id)){
			return $this->email . "- <a href='".URL_ROOT.DS."public_html".DS."login".DS."logout.php'>Log out</a>";
		}else{
			return "<a href='".URL_ROOT.DS."public_html".DS."login".DS."login.php'>Log in</a>";
		}
	}
	
	public function get_full_name(){
		if (isset($this->fname) && isset($this->lname)){
			return $this->fname . " " . $this->lname;
		}else{
			return "";
		}
	}
	
	public static function find_by_session(){
		$id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
		return User::find_by_id($id);
	}
	
	public static function authenticate($email="", $password=""){
		global $db;
		$email = Database::escape_value(trim($email));
		$password = Database::escape_value(trim($password));
		$hashed_pass = sha1($password);
		
		$sql = "SELECT * FROM ". static::$table_name . " ";
		$sql .= "WHERE email='{$email}' ";
		$sql .= "AND hashed_pass='{$hashed_pass}' ";
		$sql .= "LIMIT 1";
		
		$result_array = self::find_by_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public function update_password($password){
		$this->hashed_pass = sha1($password);
	}
}
?>