<?php
require_once(LIB_PATH.DS.'database.php');

class Verse extends DatabaseObject{
	protected static $table_name = "verses";
	protected static $db_fields = array('id', 'user_id', 'book', 'chapter', 'verse', 'text', 'version');
	public $id;
	public $user_id;
	public $book;
	public $chapter;
	public $verse;
	public $text;
	public $version;
}

?>