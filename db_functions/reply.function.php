<?php
session_start();
 if(isset($_POST['temppostid']) && isset($_POST['reply']) && isset($_SESSION['username'])){
	include_once('../classes/connection.class.php');
	include_once('../classes/user.class.php');
	$obj = new User();
	if($obj->addReply($_POST['temppostid'],$_POST['reply'])){
		header('Location:../post.php?id=' . $_POST['temppostid']);			
	}else{
		echo "Something's seriously wrong with you because our server cannot accept your reply! :D";	
	}
}else{
	header('Location:../index.php');	
}
?>