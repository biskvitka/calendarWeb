<?php
	require_once("includes/header.php");
	
	if (!empty($_FILES)){
		if (!empty($_FILES['usersUpload']['tmp_name'])){
			
			$fileError = $site->checkFile($_FILES['usersUpload']);
			if ($fileError == "") {
				$users = $site->readUsers($_FILES['usersUpload']['tmp_name']);
				if($users) {
					foreach ($users as $user){
						$db->addUser($user['username'], $user['name'], $user['password'], $user['type'], $user['email']);
					}
				}
			} else {
				echo $fileError;
			}
		}
		if (!empty($_FILES['subjectsUpload']['tmp_name'])){
			
			$fileError = $site->checkFile($_FILES['subjectsUpload']);
			if ($fileError == "") {
				$subjects = $site->readSubjects($_FILES['subjectsUpload']['tmp_name']);
				
				if($subjects) {
					foreach ($subjects as $subject){
						$db->insertSubject($subject['subjname'], $subject['lecturerName']);
					}
				}
			} else {
				echo $fileError;
			}
		}
		if (!empty($_FILES['studentsSubjectsUpload']['tmp_name'])){
			
			$fileError = $site->checkFile($_FILES['studentsSubjectsUpload']);
			if ($fileError == "") {
				$subjectsStudents = $site->readSubjectStudent($_FILES['studentsSubjectsUpload']['tmp_name']);
				
				 if($subjectsStudents) {
					foreach ($subjectsStudents as $subjectStudent){
						$db->insertSubjectStudent($subjectStudent['subjname'], $subjectStudent['username']);
					}
				}
			} else {
				echo $fileError;
			}
		}
		$link = 'admin.php?date='.$date;
		header("location: ".$link);
	}
	if (!empty($_POST)) {
		foreach ($_POST as $eventid => $status) {
			$db->setEventStatus($eventid, $status);
		}
		$link = 'admin.php?date='.$date;
		header("location: ".$link);
	}
	
	
	$events = $db->getAllEvents($date);
	require_once("views/admin.php");

?>