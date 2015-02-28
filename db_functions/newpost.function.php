<?php
	if(isset($_POST['value'])){
		session_start();
		if(isset($_SESSION['username'])){
			include_once('../classes/connection.class.php');
			include_once('../classes/user.class.php');
			echo "session set and value received";
			$title = $_POST['value'];	
			$username = $_SESSION['username'];
			$obj = new User();
			$obj->insertPost($title,$username);
			$postid = $_SESSION['postid'];
			header('Location:../post.php?id='.$postid);
		}else{
			echo "Please login in to add to the fourm!";	
		}
	}else{
		header("Location:../index.php");	
	}
?>