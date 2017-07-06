<?php
	session_start();
	
	if (isset($_GET['logout'])) {
		session_unset();
		session_destroy();
	}
	
	require_once("DBManager.php");
	$db = new DBManager();
	$db->connect();
	
	$page = basename($_SERVER["SCRIPT_FILENAME"]);
	if (!empty($_SESSION) && isset($_SESSION["type"]) ) {
		if ($_SESSION["type"] == "student" && $page != "student.php"){
			header("location: index.php?logout=y");
		} else if ($_SESSION["type"] == "lecturer" && $page != "lecturer.php"){
			header("location: index.php?logout=y");
		} else if ($_SESSION["type"] == "admin" && $page != "admin.php"){
			header("location: index.php?logout=y");
		}
	} 
	
	require_once("Site.php");
	$site = new Site();
	$calendar = $site->calendar();
?>