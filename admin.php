<?php
	require_once("includes/header.php");
	
	// if (!empty($_FILES)){
		// if (!empty($_FILES['usersUpload']['tmp_name'])){
			// $users = $site->readUsers($_FILES['usersUpload']['tmp_name']);
			// if($users) {
				// foreach ($users as $user){
					// $db->addUser($user['username'], $user['name'], $user['password'], $user['type'], $user['email']);
				// }
			// }
		// }
		// if (!empty($_FILES['subjectsUpload']['tmp_name'])){
			// $subjects = $site->readSubjects($_FILES['subjectsUpload']['tmp_name']);
			
			// if($subjects) {
				// foreach ($subjects as $subject){
					// $db->insertSubject($subject['subjname'], $subject['lecturerName']);
				// }
			// }
		// }
		// if (!empty($_FILES['studentsSubjectsUpload']['tmp_name'])){
			// $subjectsStudents = $site->readSubjectStudent($_FILES['studentsSubjectsUpload']['tmp_name']);
			
			 // if($subjectsStudents) {
				// foreach ($subjectsStudents as $subjectStudent){
					// $db->insertSubjectStudent($subjectStudent['subjname'], $subjectStudent['username']);
				// }
			// }
		// }
		
	// }
	
	
	$events = $db->getAllEvents($date);
	require_once("views/admin.php");

?>