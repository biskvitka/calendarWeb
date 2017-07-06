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
					
					<tr>
						<td>10:00</td><td>Уеб програмиране</td><td>стая 303</td><td>проф. Иван Тодоров</td><td>лекция</td>
					</tr>
					<tr>
						<td>10:00</td><td>Уеб програмиране</td><td>стая 303</td><td>проф. Иван Тодоров</td><td>лекция</td>
					</tr>
					<tr>
						<td>10:00</td><td>Уеб програмиране</td><td>стая 303</td><td>проф. Иван Тодоров</td><td>лекция</td>
					</tr>
				</table>
			</section>
		</section>
		<br><br>
	</body>
</html>