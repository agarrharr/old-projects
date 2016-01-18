<?php
require_once(LIB_PATH.DS."config.php");

$database = new Database();
$db =& $database;

class Database{
	private $connection;
	public $lastQuery;
	private static $magic_quotes_active;
	private static $real_escape_string_exists;
	
	function __construct(){
		$this->open_Connection();
		$this->magic_quotes_active = get_magic_quotes_gpc();
		$this->realEscapeStringExists = function_exists("mysql_real_escape_string");
	}
	
	public function open_connection(){
		$this->connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
		if(!$this->connection){
			die("Database connection failed: " . mysql_error());
		}else{
			$db_select = mysql_select_db(DB_NAME, $this->connection);
			if(!$db_select){
				die("Database selection failed: " . mysql_error());
			}
		}
	}
	
	public function close_connection(){
		if(isset($this->connection)){
			mysql_close($this->connection);
			unset($this->connection);
		}
	}
	
	public function query_debug($sql){
		query($sql, 1);
	}
	
	public function query($sql, $debug=DEBUG){
		$this->lastQuery = $sql;
		$result = mysql_query($sql, $this->connection);
		$this->confirm_query($result, $debug);
		return $result;
	}
	
	private function confirm_query($result, $debug=DEBUG){
		if(!$result){
			$output = "Database query failed: " . mysql_error() . "<br/><br/>";
			if($debug){ $output .= "Last query: " . $this->lastQuery;}
			$log = new Log('query');
			$log->add_entry("Query Failed", $output);
			die($output);
		}
	}
	
	public static function escape_value($value){
		if(self::$real_escape_string_exists){
			if(self::$magic_quotes_active){ $value = stripslashes($value); }
			$value = mysql_real_escape_string($value);
		}else{
			if(! self::$magic_quotes_active){ $value = addslashes($value); }
		}
		return $value;
	}
	
	public static function fetch_array($result_set){
		return mysql_fetch_array($result_set);	
	}
	
	public static function num_rows($result_set){
	 return mysql_num_rows($result_set);	
	}
	
	public function insert_id(){
	 return mysql_insert_id($this->connection);
	}
	
	public function affected_rows(){
	 return mysql_affected_rows($this->connection);	
	}
}
?>