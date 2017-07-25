<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Студентски календар</title>
		<link rel="stylesheet" type="text/css" href="resources/style.css">
	</head>
	<body id="student-content">		
		<header class="student">
			<div id="title-container"><div id="title">Студентски календар</div></div>
			<span id="right-title">
				<a href="index.php?logout=y">изход</a>
				<p><?php echo $_SESSION["name"];?>, студент</p>
			<span>
		</header>
		<section id="content">
			<section id="left-content">
				<section id="calendar">
					<div id="calendar-content-student">
						<?php echo $calendar; ?>
					</div>
				</section>
			</section>
			<section id="events" class="events-student">
				<table>
					<?php 
					if (empty($events)) {
						echo "<p id='no-event'>Няма събития за този ден</p>";
					} else {
						foreach($events as $event) {
							echo "<tr>
								<td>".date("H:i", strtotime($event["date"]))."</td>
								<td>".date("H:i", strtotime($event["endHour"]))."</td>
								<td>".$event["subjname"]."</td>
								<td>стая ".$event["room"]."</td>
								<td>".$event["lecturer"]."</td>
								<td>".$event["type"]."</td>
							</tr>";
						}							
					}	
					?>
				</table>
			</section>
		</section>
		<br><br>
	</body>
</html>