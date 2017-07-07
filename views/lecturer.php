<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Студентски календар</title>
		<link rel="stylesheet" type="text/css" href="resources/style.css">
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
					<form action="#" method="post">
						Час<select>
							<option>10:00</option>
							<option>11:00</option>
							<option>12:00</option>
						</select>
						Предмет<select style="max-width: 300px;">
							<option>Висша алгебра</option>
							<option>Аналитична геометрия</option>
							<option>ДИС</option>
							<option>Увод в програмирането</option>
						</select>
						Стая<select>
							<option>101</option>
							<option>102</option>
							<option>103</option>
							<option>104</option>
						</select>
						Тип събитие<select>
							<option>лекция</option>
							<option>упражнение</option>
							<option>консултация</option>
							<option>изпит</option>
						</select>
						Край на събитието<input type="date" disabled/>
						<input type="submit" value="Запиши">
					</form>
				</section>
			</section>
			<section id="events" class="events-lecturer">
				<table>
					
					<?php foreach($events as $event) {
						echo "<tr>
								<td>".date("H:m", strtotime($event["date"]))."</td><td>".$event["subjname"]."</td><td>стая ".$event["room"]."</td><td>".$event["lecturer"]."</td><td>".$event["type"]."</td>
							</tr>";	
					}	
					?>
				</table>
			</section>
		</section>
		<br><br>
	</body>
</html>