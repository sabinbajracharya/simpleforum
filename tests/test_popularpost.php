<?php
	include_once('../classes/connection.class.php');
	include_once('../classes/user.class.php');
	$obj = new User();
	echo "<pre>";
	print_r($obj->getPopularPost(4));
	echo "</pre>";
?>