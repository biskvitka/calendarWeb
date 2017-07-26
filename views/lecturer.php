<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Студентски календар</title>
		<link rel="stylesheet" type="text/css" href="resources/style.css">
		<script type="text/javascript" src="resources/javascript.js"></script>
	</head>
	<body id="lecturer-content">		
		<header class="lecturer">
			<div id="title-container"><div id="title">Студентски календар</div></div>
			<span id="right-title">
				<a href="index.php?logout=y">изход</a>
				<p><?php echo $_SESSION["name"];?>, преподавател</p>
			<span>
		</header>
		<section id="content">
			<section id="left-content">
				<section id="calendar">
					<div id="calendar-content-lecturer">
						<?php echo $calendar;?>
					</div>
				</section>
				<section id="add-event">
					<p>Добавяне на събитие</p>
					<form action="lecturer.php" method="post">
						Начален час<select name="hour">
							<option value="9">09:00</option>
							<option value="10">10:00</option>
							<option value="11">11:00</option>
							<option value="12">12:00</option>
							<option value="13">13:00</option>
							<option value="14">14:00</option>
							<option value="15">15:00</option>
							<option value="16">16:00</option>
							<option value="17">17:00</option>
							<option value="18">18:00</option>
						</select>
						Краен час <select name="end_hour">
							<option value="10">10:00</option>
							<option value="11">11:00</option>
							<option value="12">12:00</option>
							<option value="13">13:00</option>
							<option value="14">14:00</option>
							<option value="15">15:00</option>
							<option value="16">16:00</option>
							<option value="17">17:00</option>
							<option value="18">18:00</option>
							<option value="19">19:00</option>
							<option value="20">20:00</option>
							<option value="21">21:00</option>
						</select>
						Предмет<select name="subjects" style="max-width: 300px;">
							<?php foreach ($subjects as $subject){
									echo "<option value=".$subject['subjectid'].">".$subject['name']."</option>";
								}
							?>
						</select>
						Стая<select name="room">
							<option value="101">101</option>
							<option value="102">102</option>
							<option value="103">103</option>
							<option value="104">104</option>
							<option value="105">105</option>
							<option value="106">106</option>
							<option value="107">107</option>
							<option value="108">108</option>
						</select>
						Тип събитие<select id="eventType" name="type">
							<option value="exam">изпит</option>						
							<option value="lecture">лекция</option>
							<option value="consultation">консултация</option>
						</select>
						Начало на събитието<input name="startDate" type="date" placeholder="mm/dd/yyyy"/>
						Край на събитието<input name="endDate" id="endDate" type="date" placeholder="mm/dd/yyyy" disabled/>
						<input type="submit" value="Запиши">
					</form>
				</section>
			</section>
			<section id="events" class="events-lecturer">
				<table>
					
					<?php 
					if (empty($events)) {
						echo "<p id='no-event' '>Няма събития за този ден</p>";
					} else {
						echo '<form action="lecturer.php" method="post"><table><tr>';
						foreach($events as $event) {
							echo "
								<td>".date("H:i", strtotime($event["date"]))."</td>
								<td>".date("H:i", strtotime($event["endHour"]))."</td>
								<td>".$event["subjname"]."</td>
								<td> стая ".$site->addRoomOpts($event['room'], $event['eventid'])."</td>".
								"<td>".$event["lecturer"]."</td>
								<td>".$event["type"]."</td>
								<td>".$status[$event["status"]]."</td>";
							if ($event['lecturer'] == $_SESSION['name']){
								echo "<td><a href='lecturer.php?date=".$date."&eventid=".$event['eventid']."'>&#x274C</a></td>";
							} else {
								echo "<td></td>";
							}
							echo "</tr>";
	
						}
							echo "</table>
							<input type='submit' style='float:right;' value='Запази'>
						</form>";
					}	
					
					?>
				</table>
			</section>
		</section>
		<br><br>
	</body>
</html>
