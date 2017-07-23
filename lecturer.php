<?php
	require_once("includes/header.php");
	$status["none"] = "без статус";
	$status["approved"] = "одобрен";
	$status["canceled"] = "неодобрен"; 
	
	$subjects = $db->getLecturerSubs($_SESSION['userid']);
	if (!empty($_POST)){
		
		if(isset($_POST['subjects']) && !empty($_POST['subjects']) && isset($_POST['startDate']) && !empty($_POST['startDate']) ) {
			if ($_POST['type'] == "lecture" ) {
				$date = date("Y-m-d", strtotime($_POST['startDate']));
				//$testdate = date("Y-m-d", strtotime($date));
				//echo "testdate: $testdate<br>";
				$endDate = date("Y-m-d", strtotime($_POST['endDate']));
				if (isset($endDate) && !empty($endDate) && $date < $endDate){
					while ($date < $endDate) { // dosnt include end date
						$dateHour = date("Y-m-d H:i:s", strtotime($date . "+" . $_POST['hour'] . " hours"));
						$db->insertEvent($_POST['type'], $dateHour, $_POST['room'], $_POST['subjects']);
						//echo "date $date<br>"; // added
						$date = date("Y-m-d", strtotime($date."+7 days"));						
						//echo "date $date<br>"; // added
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