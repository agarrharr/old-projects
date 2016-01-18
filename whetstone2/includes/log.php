<?php
require_once(LIB_PATH.DS."config.php");

class Log{
	public $lastEntry;
	private $file_name;
	private $new;
	private $type;
	
	function __construct($type){
		$this->type = $type;
		$this->file_name = SITE_ROOT.DS."logs".DS.$this->type.".txt";
		$this->new = file_exists($this->file_name) ? filesize($this->file_name) == 0 ? true : false : true;
	}
	
	public function add_entry($action, $message){
		$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id']: 0;
		$file = fopen($this->file_name, 'a');
		$timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
		$entry = array('timestamp' => $timestamp, 'user_id' => $user_id, 'action' => $action, 'message' => $message);
		$content = json_encode($entry);
		if(!$this->new){
			$content = ", " . $content;
		}else{
			$this->new = false;
		}
		fwrite($file, $content);
		fclose($file);
	}
	
	public function show_log_files(){
		$dir_name = SITE_ROOT.DS."logs";
		if(is_dir($dir_name)){
			if($dir = opendir($dir_name)){
				while($file_name = readdir($dir)){
					if(stripos($file_name, '.') > 0){
						$farray = explode(".", $file_name);
						$file_name = $farray[0];
						echo "<li><a href='logs.php?type=" . $file_name . "'>" . ucfirst($file_name) . " Log File</a></li>";
					}
				}
			}
		}
	}
	
	public function show_log(){
		$entries = json_decode("{\"entries\": [". file_get_contents($this->file_name) . "]}", true);
		//var_dump($entries);
		
		echo "<ul class='log-entries'>";
		for($i=0; $i < count($entries['entries']); $i++){
			echo "<li>" . $entries['entries'][$i]['timestamp'] . "- " . $entries['entries'][$i]['user_id'] . "- " . $entries['entries'][$i]['action'] . "- " . $entries['entries'][$i]['message'] . "</li>";
		}
		echo "</ul>";
	}
	
	public function clear_log(){
		file_put_contents($this->file_name, "");
		$this->new = true;
		$this->add_entry($_SESSION['user_id'], 'Log Cleared', 'log cleared');
		redirect_to('logs.php?type='. $this->type);
	}
}
?>