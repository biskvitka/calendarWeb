<?php
	require_once("includes/header.php");
	
	$events = $db->getAllEvents($date);
	
	
	require_once("views/lecturer.php");
?>