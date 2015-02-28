<?php
	include_once('../classes/connection.class.php');
	include_once('../classes/user.class.php');
	$obj = new User();
	echo "<pre>";
	print_r($obj->getPostReply(1));
	echo "</pre>";
?>