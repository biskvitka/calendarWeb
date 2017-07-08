<?php
	class Site{
	
	private function printDaysString($day, $month, $year){
		global $page;
		
		$first_day = mktime(0, 0, 0, $month, 1, $year);
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
				$date = date('Y-m-d', mktime(0, 0, 0, $month, $day_num, $year));
				$dayString = $dayString."<td><a href=".$page."?date=".$date.">";
				$dayString = $dayString.$day_num;
			}
			else {
				$dayString = $dayString."<td id='today'>".$day_num;
			}
			$dayString = $dayString."</a></td>";
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
		global $page;
		$date = date('Y-m-d');

		// $today = date('d', $date);
		if (isset($_GET['date']) && $_GET['date'] == date('Y-m-d', strtotime($_GET['date']))) {
			$date = $_GET['date'];
		}
		$month 	= date('n', strtotime($date));
		$year 	= date('Y', strtotime($date));
		$day 	= date('d', strtotime($date));
		
		$previousMonth = date('Y-m-d', strtotime('-1 month', strtotime($date)));
		$nextMonth     = date('Y-m-d', strtotime('+1 month', strtotime($date)));
		
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

		$calendar = '
			<div id="calendar-title">'.
							'<a href='.$page.'?date='.$previousMonth.'> < </a>'
						.$monthName[$month].' '.$year.
							'<a href='.$page.'?date='.$nextMonth.'	> > </a>'
			.'</div>
						<div id="days">
							<table>
								<tr>
									<th>ПН</th><th>ВТ</th><th>СР</th><th>ЧТ</th><th>ПТ</th><th>СБ</th><th>НД</th>
								</tr>'
								.$this->printDaysString($day, $month, $year).
							'</table>
						</div>
		';
		return $calendar;
	}

	private function readPropsFile($filepath, $numberprops) {

		$file = fopen($filepath, 'r') or die("Cannot open file at " . $filepath);
		while(!feof($file)) {
			$line = fgets($file);
			$arrayline = explode(',', $line);
			if(sizeof($arrayline) != $numberprops) {
				continue;
			}
			$lines[] = $arrayline;
		}

		return $lines;
	}
	

	public function checkFile($filepath) {
		$errormsg;
		if(!file_exists($filepath)) {
			$errormsg = "No such file $filepath";
			$error = true;
		}

		$filetype = pathinfo($filepath, PATHINFO_EXTENSION);
		if($filetype != 'csv') {
			$errormsg = "Please choose .csv file";
			$error = true;
		}

		if(filesize($filepath) > 2000000) {
			$errormsg = "$filepath file is too large. (More than ~2MB) ";
			$error = true;
		}

		return $errormsg;
	}

	public function readUsers($filepath) {
		$keys = array('username', 'password', 'name', 'type', 'email');
		$numberprops = sizeof($keys);
		
		$users = $this->readPropsFile($filepath, $numberprops);
		if(empty($users)) {
			return;
		}

		$records = array();
		foreach($users as $user) {
			$records[] = array_combine($keys, $user);
		}

		return $records;
		// echo "<pre>";
		// print_r($records);
		// echo "</pre>";
	}

	public function readSubjects($filepath) {
		$keys = array('subjname', 'lecturerName');
		$numberprops = sizeof($keys);

		$subjects = $this->readPropsFile($filepath, $numberprops);
		if(empty($subjects)) {
			return;
		}

		$records = array();
		foreach($subjects as $subject) {
			$records[] = array_combine($keys, $subject);
		}

		return $records;
		// echo "<pre>";
		// print_r($records);
		// echo "</pre>";
	}

	public function readSubjectStudent($filepath) {
		$keys = array('subjname', 'username');

		$numberprops = sizeof($keys);

		$entities = $this->readPropsFile($filepath, $numberprops);
		if(empty($entities)) {
			return;
		}

		$records = array();
		foreach($entities as $entity) {
			$records[] = array_combine($keys, $entity);
		}

		return $records;
	}

	public function sendMail($message, $subject, $receiver) {
		$headers = "Content-Type: text/html; charset=utf-8\r\n";
		mail($receiver, $subject, $message, $headers) or die("PRoblem while sending");
	}
}
?>