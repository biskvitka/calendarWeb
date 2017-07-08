<?php
	require_once("includes/header.php");
	
	$events = $db->getLecturerEvents($date, $_SESSION['userid']);
	
	require_once("views/lecturer.php");
?>