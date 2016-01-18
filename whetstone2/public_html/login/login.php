<?php
require_once('../../includes/initialize.php');
if ($session->is_logged_in()){ redirect_to("../index.php");}

if(isset($_POST['submit'])){
	$email = trim($_POST['email']);
	
	$found_user = User:: authenticate($email, $_POST['password']);
	
	if($found_user && !empty($found_user->id)){
		$session->login($found_user);
		redirect_to("../index.php");
	}else{
		$session->set_message("Email/password combination is incorrect.");
	}
}else{
	$email = "";
}

include_layout_template('admin_header');
?>
<form action="login.php" method="post">
	<table>
		<tr>
			<td>Email:</td>
			<td><input type="text" name="email" maxlength="30" value="<?php echo htmlentities($email); ?>"></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input type="password" name="password" maxlength="30"></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" name="submit" value="Login"/></td>
		</tr>
	</table>
</form>
<?php include_layout_template('admin_footer'); ?>