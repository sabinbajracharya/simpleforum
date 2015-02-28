<?php
	if(isset($_POST['regname']) && isset($_POST['regpswd']) && isset($_POST['regemail']) && isset($_POST['regusername'])){
		$name = $_POST['regname'];
		$email = $_POST['regemail'];
		$pswd = $_POST['regpswd'];
		$username = $_POST['regusername'];	
		include('../classes/connection.class.php');
		include('../classes/user.class.php');
		$obj = new User();
		$obj->register($name,$username,$pswd,$email);
	}else{
		echo "Some details are missing!";
	}
?>