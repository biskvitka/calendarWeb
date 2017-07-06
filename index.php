<?php
	require_once("includes/header.php");
	if (!empty($_POST)) {
		print_r($_POST);
		
		$userInfo = $db->login($_POST["uname"], $_POST["psw"]);
		if(!empty($userInfo)) {
			session_start();
			$_SESSION["userid"] = $userInfo["userid"];
			$_SESSION["type"] 	= $userInfo["type"];
			$_SESSION["name"] 	= $userInfo["name"];
			$_SESSION["email"] 	= $userInfo["email"];
			if ($_SESSION["type"] == "student"){
				header("location: student.php");
			} else if ($_SESSION["type"] == "lecturer") {
				header("location: lecturer.php");
			} else {
				header("location: admin.php");
			}
		}
	
	
	}
	
	
	
	
	
	require_once("views/login.php");
	
?>