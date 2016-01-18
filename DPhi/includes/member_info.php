<form name=form1 method=POST action="../index.php">
	<table>
		<tr align="right">
			<td colspan="2">
				<a href="javascript:var f=$('form1'); f.style.display=(f.style.display=='block'?'none':'block');
					 $('fname').focus(); void 0;">Close</a>
			</td>
		</tr>
			<td>First Name:</td>
			<td><input name="fname" type="text" size="30"></td>
		</tr>
		</tr>
			<td>Last Name:</td>
			<td><input name="lname" type="text" size="30"></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input name="email" type="text" size="30"></td>
		</tr>
		<tr>
			<td>Cellphone:</td>
			<td><input name="phone" type="text" size="30"></td>
		</tr>
		<tr>
			<td>Cellphone Provider:</td>
			<td>
				<select name="provider">
					<option value=""></option>
					<option value="AT&T">ATT</option>
					<option value="Nextel">Nextel</option>
					<option value="Sprint">Sprint</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Username:</td>
			<td><input name="uname" type="text" size="30"></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input name="password" type="password" size="30"></td>
		</tr>
		<tr>
			<td>Retype Password:</td>
			<td><input name="password2" type="password" size="30"></td>
		</tr>
		<tr>
			<td colspan=2 align=center>
				<input type='submit' name='submit' value="Register">
			</td>
		</tr>
	</table>
</form>