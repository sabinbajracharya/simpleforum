<?php
	if(isset($_POST['username']) && isset($_POST['password'])){	
		include_once('../classes/connection.class.php');
		include_once('../classes/user.class.php');
		$obj = new User();
		$obj->accountVerification($_POST['username'],$_POST['password']);
	}
?>