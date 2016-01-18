<?php
require_once(LIB_PATH.DS.'database.php');

class Book extends DatabaseObject{
	protected static $table_name = "verses";
	protected static $db_fields = array('order', 'isNew', 'name', 'chapters');
	public $order;
	public $isNew;
	public $name;
	public $chapters;	
}

?>