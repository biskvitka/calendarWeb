<?php
	class Site{
	
	private function printDaysString($day, $month, $year){
		$first_day = mktime(0, 0, 0, $month, 1, $year);
		$title = date('F', $first_day);
		$day_of_week = date('w', $first_day);
		$days_in_month = cal_days_in_month(0, $month, $year);
		
		if ($day_of_week == 0){
			$day_of_week = 7;
		}
		$dayString = "<tr>";
		$day_count = 1;
		while ($day_of_week > 1){
			$dayString = $dayString."<td></td>";
			$day_of_week = $day_of_week - 1;
			++$day_count;
		}
		
		$day_num = 1;
		while ($day_num <= $days_in_month){
			if($day != $day_num){
				$dayString = $dayString."<td>";
				$dayString = $dayString.$day_num;
			}
			else {
				$dayString = $dayString."<td id=\"today\">".$day_num;
			}
			$dayString = $dayString."</td>";
			if ($day_count % 7 == 0) {
				$dayString = $dayString."</tr><tr>";
			}
			$day_num++;
			++$day_count;
		}
		$dayString = $dayString."</tr>";
		return $dayString;
	}
	
	public function calendar() {
	
	$monthName[1]  = 'Януари';
	$monthName[2]  = 'Февруари';
	$monthName[3]  = 'Март';
	$monthName[4]  = 'Април';
	$monthName[5]  = 'Май';
	$monthName[6]  = 'Юни';
	$monthName[7]  = 'Юли';
	$monthName[8]  = 'Август';
	$monthName[9]  = 'Септември';
	$monthName[10] = 'Октомври';
	$monthName[11] = 'Ноември';
	$monthName[12] = 'Декември';
	$date = time();
	$today = date('d', $date);
	$month = 0;
	if ($month == 0) {
		$month = date('n', $date);
		$year = date('Y', $date);
	} elseif($month == 13) {
		$month = 1;
		$year++;
	} elseif($month == 0){
		$month = 12;
		$year--;
	}
		$calendar = '
			<div id="calendar-title">
							<'.$monthName[$month].' '.$year.' >
						</div>
						<div id="days">
							<table>
								<tr>
									<th>ПН</th><th>ВТ</th><th>СР</th><th>ЧТ</th><th>ПТ</th><th>СБ</th><th>НД</th>
								</tr>'
								.$this->printDaysString($today, $month, $year).
							'</table>
						</div>
		';
		return $calendar;
	}
		
		
	}
?>