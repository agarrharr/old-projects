<?php
	$query = "SELECT *";
	$query .= "FROM members ";
	$query .= "WHERE id = '{$_SESSION['user_id']}';";
	echo $query;
	$result_set = mysql_query($query, $connection);
	confirm_query($result_set);
	if(mysql_num_rows($result_set) == 1){
		$found_user = mysql_fetch_array($result_set);
		$_SESSION['user_id'] = $found_user['id'];
		$_SESSION['fname'] = $found_user['fname'];
		$_SESSION['lname'] = $found_user['lname'];
		$_SESSION['uname'] = $found_user['uname'];
		$_SESSION['email'] = $found_user['email'];
		$_SESSION['phone'] = $found_user['phone'];
		$_SESSION['provider'] = $found_user['provider'];
	}
?>
		
<form name='input' action='../main/info.php' method='post'>
	<table width='300' cellpadding='0' cellspacing='0' border='0'>
		<tr>
			<td width='75'>First Name:</td>
			<td><input type='text' name='fname' size='20'
				<?php
					if(isset($_SESSION['fname'])){
						echo "value='{$_SESSION['fname']}'";
					}					
				?>				
			/></td>
		</tr>
		<tr>
			<td>Last Name:</td>
			<td><input type='text' name='lname' size='20'
				<?php
					if(isset($_SESSION['lname'])){
						echo "value='{$_SESSION['lname']}'";
					}					
				?>
			/></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type='text' name='email' size='20'
				<?php
					if(isset($_SESSION['email'])){
						echo "value='{$_SESSION['email']}'";
					}					
				?>
			/></td>
		</tr>
		<tr>
			<td>Cell Phone Number:</td>
			<td><input type='text' name='phone' size='12' maxlength='12' 
				<?php
					if(isset($_SESSION['phone'])){
						echo "value='{$_SESSION['phone']}'";
					}					
				?>
			/></td>
		</tr>
		<tr>
			<td>Cell Phone Provider:</td>
			<td><input type='text' name='provider' size='20'
				<?php
					if(isset($_SESSION['provider'])){
						echo "value='{$_SESSION['provider']}'";
					}					
				?>
			/></td>
		</tr>
		<!--tr>
			<td>Permanent Address:</td>
			<td><input type='text' name='address1' size='20' /></td>
		</tr>
		<tr>
			<td>City :</td>
			<td><input type='text' name='city1' size='20' /></td>
		</tr>
		<tr>
			<td>State:</td>
			<td><input type='text' name='state1' size='20' /></td>
		</tr>
		<tr>
			<td>Zip Code:</td>
			<td><input type='text' name='zip1' size='20' /></td>
		</tr>
		<tr>
			<td>Local Address:</td>
			<td><input type='text' name='address2' size='20' /></td>
		</tr>
		<tr>
			<td>City:</td>
			<td><input type='text' name='city2' size='20' /></td>
		</tr>
		<tr>
			<td>State:</td>
			<td><input type='text' name='state2' size='20' /></td>
		</tr>
		<tr>
			<td>Zip Code:</td>
			<td><input type='text' name='zip2' size='20' /></td>
		</tr-->
	</table>
	<input type='submit' name='submit' value='Save' />
</form>
<script type='text/javascript'>
	document.input.uname.focus();
</script>