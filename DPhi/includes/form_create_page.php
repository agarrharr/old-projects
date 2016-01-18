<?php
	echo "
	<form action = '../includes/validate_create_page.php' method = 'POST'>
		Name <input type = 'text' name='name'/><br/>
		<input type = 'hidden' name='x' value='{$_POST['x']}'/>
		<input type = 'hidden' name='y' value='{$_POST['y']}'/>
		<input type = 'hidden' name='z' value='{$_POST['z']}'/>
		<textarea name = 'body' rows='10' cols='30'></textarea><br/>
		<!--input type = radio name='html' value = 'n' checked>Plain Text
		<input type = radio name='html' value = 'y'>HTML<br/-->
		<input type='hidden' name='html' value='n'></br>
		<input type='submit' name='submit' value='submit' />
	</form>
	";
?>