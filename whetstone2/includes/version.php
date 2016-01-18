<?php
require_once(LIB_PATH.DS.'database.php');

class Version extends DatabaseObject{
	protected static $table_name = "verses";
	protected static $db_fields = array('version', 'name', 'is_api');
	private static $url = "https://bibles.org/versions.js?language=eng-us";
	public $version;
	public $name;
	public $is_api;
	
	public static function get_versions(){
		if(true){
			return static::get_api_versions();
		}else{
			return static::get_db_versions();
		}
	}
	
	public static function get_db_versions(){
		global $db;
		$sql = "SELECT version, name, copyright, is_api FROM version";
		$versions = $db->query($sql);
		
		echo var_dump($versions);
		foreach($versions as $version){
			if(!empty($version->version)){
				$element_array[] = array('version' => $version->version->version,
					'name' => $version->version->name,
					'copyright' => $version->version->copyright);
				//echo "<br/ ><br/ >" . $version->version->version . "- " . $version->version->name . "- " . $version->version->copyright;
			}
		}
	}
	
	public static function get_api_versions(){
		$json = static::get_response(static::$url);
		$versions = json_decode($json);
		$element_array = array();
		
		foreach($versions->versions as $version){
			if(!empty($version->version)){
				$element_array[] = array('version' => $version->version->version,
					'name' => $version->version->name,
					'copyright' => $version->version->copyright);
				//echo "<br/ ><br/ >" . $version->version->version . "- " . $version->version->name . "- " . $version->version->copyright;
			}elseif(!empty($version->fums)){
				echo $version->fums;
			}
		}
		$json = json_encode($element_array);
		//echo $json;
		return $json;
	}
	
	public static function get_response($url){
		// Set up cURL
		$ch = curl_init();
		// Set the URL
		curl_setopt($ch, CURLOPT_URL, $url);
		// don't verify SSL certificate
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		// Return the contents of the response as a string
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// Follow redirects
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		// Set up authentication
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, BIBLE_API_KEY . ":X");
		
		// Do the request
		$json = curl_exec($ch);
		curl_close($ch);
		
		return $json;
	}
}
?>