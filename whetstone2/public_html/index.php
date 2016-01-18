<?php
//Bugs:

//TODO:
//add php error log

//Changes to database:
//Made new admin database user whetstone
//Change members table to users, user_id to id, int users.version_id to varchar(7) users.version
//Change versions to version, drop versions.version_id, make version varchar(7), add api tinyint, change desc to name
//Change verses to verse, change verses.verse_id to id, verses.version_id to versions varchar(7), book_id int to book varchar(4), drop everything after version, allow text to be null and make default value null
//Change books to book, drop books.book_id
//Change finishDays to finishDay
//Create card

//When I push it out:
//make changes to database
//chnage config: server, user, pass, name, DEBUG to 0
//change initialize: site_root, url_root
//upload files
//set permissions on directories, make web server owner of logs and give it rw

//Things to note:
//function include_layout_template($template=""){
//function strip_zeros_from_date($marked_string=""){
//function redirect_to($location = NULL){
//Database::escape_value($value) for inserting into the database to escape quotes
//$db->query($sql) to run query, $db->query_debug($sql) to always show sql if it fails

require_once("../includes/initialize.php");

include_layout_template('header');

/*//List of all users
$users = User:: find_all();
foreach($users as $user){
	echo "User: " . $user->email . "<br/>";
}*/

echo Version::get_versions();


include_layout_template('footer');
?>