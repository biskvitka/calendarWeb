<?php 
	
	$monthName['01'] = 'Януари';
	$monthName['02'] = 'Февруари';
	$monthName['03'] = 'Март';
	$monthName['04'] = 'Април';
	$monthName['05'] = 'Май';
	$monthName['06'] = 'Юни';
	$monthName['07'] = 'Юли';
	$monthName['08'] = 'Август';
	$monthName['09'] = 'Септември';
	$monthName['10'] = 'Октомври';
	$monthName['11'] = 'Ноември';
	$monthName['12'] = 'Декември';

	$date = time();

	$today = date('d', $date);
	$thisMonth = date('m', $date);
	$thisYear = date('Y', $date);

	

	function printDaysNames(){
		$daysNames = Array('Понеделник', 'Вторник', 'Сряда', 'Четвъртък', 'Петък', 'Събота', 'Неделя');
		foreach ($daysNames as $key ) {
			echo "<li>$key</li>";
		}
	}

	function printDays($day, $month, $year){//$day_of_week

		$first_day = mktime(0, 0, 0, $month, 1, $year);
		$title = date('F', $first_day);
		$day_of_week = date('D', $first_day);
		$days_in_month = cal_days_in_month(0, $month, $year);

		$day_count = 1;

		switch($day_of_week){
			case "Mon": $blank = 0; break;
			case "Tue": $blank = 1; break;
			case "Wed": $blank = 2; break;
			case "Thu": $blank = 3; break;
			case "Fri": $blank = 4; break;
			case "Say": $blank = 5; break;
			case "Sun": $blank = 6; break;
		}


		while ($blank > 0){
			echo "<li></li>";
			$blank = $blank - 1;
			$day_count++; 
		}

		$day_num = 1;

		while ($day_num <= $days_in_month){
			if($day != $day_num){
				echo "<li> $day_num </li>";
			}
			else {
				echo "<li> <span class=\"active\">$day</span></li>";
			}

			$day_num++;
			$day_count++;

			if ($day_count > 7){
				$day_count = 1;
			}
		}

		while ($day_count > 1 && $day_count <= 7){
			echo "<li> </li>";
			$day_count++;
		}
	}
?>


