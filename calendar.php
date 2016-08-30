<?php 
	
	$monthName['01'] = '������';
	$monthName['02'] = '��������';
	$monthName['03'] = '����';
	$monthName['04'] = '�����';
	$monthName['05'] = '���';
	$monthName['06'] = '���';
	$monthName['07'] = '���';
	$monthName['08'] = '������';
	$monthName['09'] = '���������';
	$monthName['10'] = '��������';
	$monthName['11'] = '�������';
	$monthName['12'] = '��������';

	$date = time();

	$today = date('d', $date);
	$thisMonth = date('m', $date);
	$thisYear = date('Y', $date);

	

	function printDaysNames(){
		$daysNames = Array('����������', '�������', '�����', '���������', '�����', '������', '������');
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


