<?php
require_once(LIB_PATH.DS.'database.php');

class Card extends DatabaseObject{
	protected static $table_name = "verses";
	protected static $db_fields = array('id', 'user_id', 'book', 'chapter_start', 'verse_start', 'chapter_end', 'verse_end', 'text', 'version', 'stage', 'weekly', 'monthly', 'yearly', 'correct_last', 'times_total', 'correct_total', 'reviewed_last', 'dated_added');
	public $id;
	public $user_id;
	public $book;
	public $chapter_start;
	public $chapter_end;
	public $verse_start;
	public $verse_end;
	public $text;
	public $version;
	public $stage;
	public $weekly;
	public $monthly;
	public $yearly;
	public $correct_last;
	public $times_total;
	public $correct_total;
	public $reviewed_last;
	public $date_added;	
}

?>