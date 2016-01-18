<?php
	function email_new_member($member_name, $member_email){
		$to = $member_email;
		$subject = "Welcome to Delta Phi Xi";
		$body = $member_name . ", you can now log onto the Delta Phi Xi website.";
		mail($to, $subject, $body);
	}
?>