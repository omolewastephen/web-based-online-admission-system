<?php require_once ("functions.php");?>
<?php 
	session_start();

	function logged_in()
	{
		return isset($_SESSION['id']);
	}
	
	function confirm_logged_in() {
		if (!logged_in()) {
			redirect_to("admin_login.php");
		}
	}
?>