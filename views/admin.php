<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Студентски календар</title>
		<link rel="stylesheet" type="text/css" href="resources/style.css">
		<script type="text/javascript" src="resources/javascript.js"></script>
	</head>
	<body id="admin-content">		
		<header class="admin">
			<div id="title-container"><div id="title">Студентски календар</div></div>
			<span id="right-title">
				<a href="index.php?logout=y">изход</a>
				<p><?php echo $_SESSION["name"];?>, администратор</p>
			<span>
		</header>
		<section id="content">
			<section id="left-content">
				<section id="calendar">
					<div id="calendar-content">
						<?php echo $calendar;?>
					</div>
				</section>
				<form  action="admin.php" method="post" enctype="multipart/form-data">
					<input type="file" id="usersUpload" name="usersUpload" style="display:none;"/>
					<input type="button" id="usersUploadButton" value="Потребители" onclick="document.getElementById('usersUpload').click();">
					<label for="usersUpload" id="usersFileName"></label>
					<br>
					<input type="file" id="subjectsUpload" name="subjectsUpload" style="display:none;"/>
					<input type="button" id="subjectsUploadButton" value="Предмети" title="Преподаватели и предметите им"  onclick="document.getElementById('subjectsUpload').click();">
					<label for="subjectsUpload" id="subjectsFileName"></label>
					<br>
					<input type="file" id="studentsSubjectsUpload" name="studentsSubjectsUpload" style="display:none;"/>
					<input type="button" id="studentsSubjectsUploadButton" value="Студенти" title="Студенти и техните предмети" onclick="document.getElementById('studentsSubjectsUpload').click();">
					<label for="studentsSubjectsUpload" id="studentsSubjectsFileName"></label>
					<br>
					<br>
					<input type="submit" value="Качване">
				</form>
			</section>
			<section id="events" class="events-admin">
				
				<table>	
					<?php 
					if (empty($events)) {
						echo "<p id='no-event' '>Няма събития за този ден</p>";
					} else {
						foreach($events as $event) {	
							echo "<tr>
									<td>".date("H:m", strtotime($event["date"]))."</td><td>".$event["subjname"]."</td><td>стая ".$event["room"]."</td><td>".$event["lecturer"]."</td><td>".$event["type"]."</td>";
							if($event["status"] == "approved")	{
									echo "<td>одобрен</td>";
							} else if($event["status"] == "canceled"){
									echo "<td>отхвърлен</td>";
							} else {
								echo '<td>
									<form>
										<input type="radio" name="'.$event["eventid"].'" value="apprved">Да	
										<input type="radio" name="'.$event["eventid"].'" value="canceled">Не
									</form>
								</td>';
							}	
								echo "</tr>";	
						}	
					}
					?>
				</table>
			</section>
		</section>
		<br><br><br><br><br>
	</body>
</html>