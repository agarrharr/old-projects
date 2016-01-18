<?php
	echo "<form name='input' action='../main/change_password.php' method='post'>
		<table width='300' cellpadding='0' cellspacing='0' border='0'>
			<tr>
				<td width='50'>Old Password:</td>
				<td><input type='password' name='old' size='20'/></td>
			</tr>
			<tr>
				<td>New Password:</td>
				<td><input type='password' name='new1' size='20' /></td>
			</tr>
			<tr>
				<td>Confirm Password:</td>
				<td><input type='password' name='new2' size='20' /></td>
			</tr>
		</table>
		<input type='submit' name='submit' value='Change' />
	</form>
	<script type='text/javascript'>
		document.input.uname.focus();
	</script>";
?>