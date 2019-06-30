<?php 
	session_start();
	if(isset($_POST['action']) && $_POST['action'] == 'leave') {
		require("db/users.php");
		$objUser = new users;
	 	$objUser->setLastLogin(date('Y-m-d h:i:s'));
	 	$objUser->setId($_POST['userId']);
	 	if($objUser->updateLoginStatus()) {
	 		unset($_SESSION['user']);
	 		session_destroy();
			 echo "Logout...";
			 
	 	} else {
	 		echo "Somthing went wrong..";
	 	}
	}
 ?>