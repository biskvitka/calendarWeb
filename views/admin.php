<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Студентски календар</title>
		<link rel="stylesheet" type="text/css" href="resources/style.css">
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
			</section>
			<section id="events" class="events-admin">
				<form>
				<table>	
					<?php foreach($events as $event) {
						echo "<tr>
								<td>".date("H:m", strtotime($event["date"]))."</td><td>".$event["subjname"]."</td><td>стая ".$event["room"]."</td><td>".$event["lecturer"]."</td><td>".$event["type"]."</td>";
						if($event["status"] == "approved")	{
								echo "<td>одобрен</td>";
						} else if($event["status"] == "canceled"){
								echo "<td>отхвърлен</td>";
						} else {
							echo '<td>
								<input type="radio" name="approvement" value="apprved">Да	
								<input type="radio" name="approvement" value="canceled">Не
							</td>';
						}	
							echo "</tr>";	
					}	
					?>
				</form>
				</table>
			</section>
		</section>
	</body>
</html>