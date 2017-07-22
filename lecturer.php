<?php
	require_once("includes/header.php");
	$status["none"] = "без статус";
	$status["approved"] = "одобрен";
	$status["canceled"] = "неодобрен"; 
	
	$subjects = $db->getLecturerSubs($_SESSION['userid']);
	if (!empty($_POST)){
		
		if(isset($_POST['subjects']) && !empty($_POST['subjects']) && isset($_POST['startDate']) && !empty($_POST['startDate']) ) {
			if ($_POST['type'] == "lecture" ) {
				$date = $_POST['startDate'];
				$endDate = $_POST['endDate'];
				if (isset($endDate) && !empty($endDate) && $date < $endDate){
					while ($date < $endDate) {
						$dateHour = date("Y-m-d H:i:s", strtotime($date . "+" . $_POST['hour'] . " hours"));
						$db->insertEvent($_POST['type'], $dateHour, $_POST['room'], $_POST['subjects']);
						$date = date("Y-m-d", strtotime($date."+7 days"));						
					}
				}
			} else {
				$dateHour = date("Y-m-d H:i:s", strtotime($_POST['startDate'] . "+" . $_POST['hour'] . " hours"));
				$db->insertEvent($_POST['type'], $dateHour, $_POST['room'], $_POST['subjects']);
			}
		}
		unset($_POST);
		$_POST = array();
	}
	
	$events = $db->getLecturerEvents($date, $_SESSION['userid']);
	require_once("views/lecturer.php");
?>