<?php
	require_once("includes/header.php");
	
	$events = $db->getStudentEvents($_SESSION['userid'], $date);
	
	require_once("views/student.php");
?>