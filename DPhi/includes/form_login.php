<?php
if(!logged_in()){
						echo "<form name='input' action='../includes/validate_login.php' method='post'>
							<table width='100%' cellpadding='0' cellspacing='0' border='0'>
								<tr>
									<td width='75'>Username:</td>
									<td><input type='text' name='uname' size='20'";
										if(isset($_GET['u'])){
											echo "value='" . $_GET['u'] . "'";
										}
									echo "/></td>
								</tr>
								<tr>
									<td>Password:</td>
									<td><input type='password' name='pass' size='20' /></td>
								</tr>
							</table>
							<input type='submit' name='submit' value='submit' />
						</form>
						<script type='text/javascript'>
							document.input.uname.focus();
						</script>";
}else{
		redirect_to("Location: ../main/members.php");
}
?>