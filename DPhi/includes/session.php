<?php
	//NEED TO REPLACE THESE WITH FULL URLS
	session_start();
	
	function logged_in(){
		return isset($_SESSION['user_id']);
	}
	
	function confirm_logged_in(){
		if(!logged_in()){
			redirect_to("Location: ../main/login.php");
		}
	}	

	function is_admin(){
		if(isset($_SESSION['user_id']) && $_SESSION['type'] == 0)
			return true;
		else
			return false;
		}
	
	
	function confirm_admin(){
		if(!is_admin()){
			redirect_to("Location: ../main/");
		}
	}
?>