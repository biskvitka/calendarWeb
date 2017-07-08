<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Студентски календар</title>
		<link rel="stylesheet" type="text/css" href="resources/style.css">
	</head>
	
	<body>

	<form id="login" method="post" action="./index.php">
	  <div class="container">
		<?php if($wrong_user) echo "<font style='display:block;' color='red'>Не съществува такъв потребител</font>";?>
		<input type="text" placeholder="Потребителско име" name="uname" required>
		<br>
		<input type="password" placeholder="Парола" name="psw" required>
			
		<button type="submit">Вход</button>
		<br>
	  </div>
	</form>

	</body>
</html>