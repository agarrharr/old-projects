<?php
require_once(LIB_PATH.DS.'database.php');

class DatabaseObject{
	static protected $table_name;
	
	protected function sanitized_attributes(){
		global $db;
		$clean_attributes = array();
		foreach($this->attributes() as $key=>$value){
			$clean_attributes[$key] = Database::escape_value($value);
		}
		return $clean_attributes;
	}
	
	protected function attributes(){
		//return array of attribute keys and their values
		$attributes = array();
		foreach(static::$db_fields as $field){
			$attributes[$field] = $this->$field;
		}
		return $attributes;
	}
	
	public function save(){
		return isset($this->id) ? $this->update() : $this->create();
	}
	
	private function create(){
		global $db;
		$attributes = $this->sanitized_attributes();
		$sql = "INSERT INTO " . static::$table_name . " (";
		$sql .= join(", ", array_keys($attributes));
		$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
		if($db->query($sql)){
			$this->id = $db->insert_id();
			return true;
		}else{
			return false;
		}
	}
	
	private function update(){
		global $db;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key=>$value){
			$attribute_pairs[] = $key . "='" . $value . "'";
		}
		
		$sql = "UPDATE " . static::$table_name . " ";
		$sql .= "SET fname='" . Database::escape_value($this->fname) . "', ";
		$sql .= join(", ", $attribute_pairs) . " ";
		$sql .= "WHERE id=" . Database::escape_value($this->id);
		$db->query($sql);
		return ($db->affected_rows() == 1)? true: false;
	}
	
	public function delete(){
		global $db;
		$sql = "DELETE FROM " . static::$table_name . " WHERE id=" . Database::escape_value($this->id) . " LIMIT 1";
		$db->query($sql);
		return ($db->affected_rows() == 1) ? true: false;
	}
	
	public static function find_all(){
		return static::find_by_sql("SELECT * FROM " . static::$table_name);
	}
	
	public static function find_by_id($id=0){
		$result_array = static::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE id={$id}");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public static function find_by_sql($sql){
		global $db;
		$result_set = $db->query($sql);
		$object_array = array();
		
		$row = Database::fetch_array($result_set);
		do{
			$object_array[] = static::instantiate($row);
		}while($row = Database::fetch_array($result_set));
		
		return $object_array;
	}
	
	private static function instantiate($record){
		//TODO: need to make sure $record is an array and isn't empty
		$class_name = get_called_class();
		$object = new $class_name;
		
		if(is_array($record)){
			foreach($record as $attribute=>$value){
				if($object->has_attribute($attribute)){
					$object->$attribute = $value;
				}
			}
		}
		return $object;
	}
	
	private function has_attribute($attribute){
		$object_vars = $this->attributes();
		return array_key_exists($attribute, $object_vars);
	}
}
?>