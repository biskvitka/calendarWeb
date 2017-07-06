<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Студентски календар</title>
		<link rel="stylesheet" type="text/css" href="resources/style.css">
	</head>
	<body>		
		<header class="lecturer">
			<div id="title-container"><div id="title">Студентски календар</div></div>
			<span id="right-title">
				<a href="login.html">изход</a>
				<p>Иван Иванов, преподавател</p>
			<span>
		</header>
		<section id="content">
			<section id="left-content">
				<section id="calendar">
					<div id="calendar-content-lecturer">
						<div id="calendar-title" class="lecturer">
							< Юли 2017 >
						</div>
						<div id="days">
							<table>
								<tr>
									<th>ПН</th><th>ВТ</th><th>СР</th><th>ЧТ</th><th>ПТ</th><th>СБ</th><th>НД</th>
								</tr>
								<tr>
									<td></td><td></td><td></td><td>1</td><td id="today">2</td><td>3</td><td>4</td>
								</tr>
								<tr>
									<td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td>
								</tr>
								<tr>
									<td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td>
								</tr>
								<tr>
									<td>19</td><td>20</td><td>21</td><td>22</td><td>23</td><td>24</td><td>25</td>
								</tr>
								<tr>
									<td>26</td><td>27</td><td>28</td><td>29</td><td>30</td><td>31</td><td></td>
								</tr>
							</table>
						</div>
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
					
					<tr>
						<td>10:00</td><td>Уеб програмиране</td><td>стая 303</td><td>проф. Иван Тодоров</td><td>лекция</td>
					</tr>
					<tr>
						<td>10:00</td><td>Уеб програмиране</td><td>стая 303</td><td>проф. Иван Тодоров</td><td>лекция</td>
					</tr>
					<tr>
						<td>10:00</td><td>Уеб програмиране</td><td>стая 303</td><td>проф. Иван Тодоров</td><td>лекция</td>
					</tr>
					<tr>
						<td>10:00</td><td>Уеб програмиране</td><td>стая 303</td><td>проф. Иван Тодоров</td><td>лекция</td>
					</tr>
					<tr>
						<td>10:00</td><td>Уеб програмиране</td><td>стая 303</td><td>проф. Иван Тодоров</td><td>лекция</td>
					</tr>
					<tr>
						<td>10:00</td><td>Уеб програмиране</td><td>стая 303</td><td>проф. Иван Тодоров</td><td>лекция</td>
					</tr>
					<tr>
						<td>10:00</td><td>Уеб програмиране</td><td>стая 303</td><td>проф. Иван Тодоров</td><td>лекция</td>
					</tr>
					<tr>
						<td>10:00</td><td>Уеб програмиране</td><td>стая 303</td><td>проф. Иван Тодоров</td><td>лекция</td>
					</tr>
					<tr>
						<td>10:00</td><td>Уеб програмиране</td><td>стая 303</td><td>проф. Иван Тодоров</td><td>лекция</td>
					</tr>
					<tr>
						<td>10:00</td><td>Уеб програмиране</td><td>стая 303</td><td>проф. Иван Тодоров</td><td>лекция</td>
					</tr>
					<tr>
						<td>10:00</td><td>Уеб програмиране</td><td>стая 303</td><td>проф. Иван Тодоров</td><td>лекция</td>
					</tr>
					<tr>
						<td>10:00</td><td>Уеб програмиране</td><td>стая 303</td><td>проф. Иван Тодоров</td><td>лекция</td>
					</tr>
					<tr>
						<td>10:00</td><td>Уеб програмиране</td><td>стая 303</td><td>проф. Иван Тодоров</td><td>лекция</td>
					</tr>
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