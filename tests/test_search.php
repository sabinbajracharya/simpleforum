<?php
	
	include('../classes/connection.class.php');
	include('../classes/user.class.php');
	
	$obj = new User();
	echo "<pre>";
	print_r($obj->search($_GET['text'],$_GET['start'],$_GET['limit']));
	echo "</pre>";

?>