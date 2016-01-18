<?php
	echo "
	<form action = 'create_page.php' method = 'POST'>
		Name <input type = 'text' name='name'/><br/>
		x <input type = 'text' name='x'/><br/>
		y <input type = 'text' name='y'/><br/>
		z <input type = 'text' name='z'/><br/>
		Body <textarea name = 'body' rows='10' cols='30'></textarea><br/>
		<!--input type = radio name='html' value = 'n' checked>Plain Text
		<input type = radio name='html' value = 'y'>HTML<br/-->
		<input type='hidden' name='html' value='n'></br>
		<input type='submit' name='submit' value='submit' />
	</form>
	";
?>