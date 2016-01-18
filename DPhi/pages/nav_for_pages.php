<a href='../../main/index.php'>Home</a><br/>
			<a href='../../main/members.php'>Members</a><br/>
			<a href='../../main/info.php'>Edit Info</a><br/>
			<a href='../../main/change_password.php'>Change Password</a><br/>
			<a href='../../main/create_page.php'>Create a New Page</a><br/>
			<a href='../../main/change_page.php'>Change a Page</a><br/>
			<a href='../../main/delete_page.php'>Delete a Page</a><br/>
			<a href='../../main/logout.php'>Log out</a><br/><br/><?php
				if(is_admin()){
					echo "<a href='../../admin/privileges.php'>Privileges</a><br/>
						<a href='../../admin/view_members.php'>View Members</a><br/>
						<a href='../../admin/add_member.php'>Add a Member</a><br/><br/>";
				}
			?>
			<a href='../About/About.php'>About</a><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='../About/members.php'>members</a><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='..//.php'></a><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='../About/actives.php'>actives</a><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='../About/wert.php'>wert</a><br/>