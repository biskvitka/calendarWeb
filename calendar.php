<?php 
	
	$monthName[1] = 'Януари';
	$monthName[2] = 'Февруари';
	$monthName[3] = 'Март';
	$monthName[4] = 'Април';
	$monthName[5] = 'Май';
	$monthName[6] = 'Юни';
	$monthName[7] = 'Юли';
	$monthName[8] = 'Август';
	$monthName[9] = 'Септември';
	$monthName[10] = 'Октомври';
	$monthName[11] = 'Ноември';
	$monthName[12] = 'Декември';

	$date = time();
	$today = date('d', $date);

	if($month == ""){
		$month = date('n', $date);
		$year = date('Y', $date);
	}
	elseif($month == 13){
		$month = 1;
		$year++;
	}
	elseif($month == 0){
		$month = 12;
		$year--;
	}

	function printDaysNames(){
		$daysNames = Array('Понеделник', 'Вторник', 'Сряда', 'Четвъртък', 'Петък', 'Събота', 'Неделя');
		foreach ($daysNames as $key ) {
			print("<td>$key</td>");
		}
	}

	function printDays($day, $month, $year){
		$first_day = mktime(0, 0, 0, $month, 1, $year);
		$title = date('F', $first_day);
		$day_of_week = date('w', $first_day);
		$days_in_month = cal_days_in_month(0, $month, $year);
		
		if ($day_of_week == 0){
			$day_of_week = 7;
		}
		
		$day_count = 1;

		while ($day_of_week > 1){
			print("<td></td>");
			$day_of_week = $day_of_week - 1;
		}

		$day_num = 1;

		while ($day_num <= $days_in_month){
			print("<td>");
			
			if($day != $day_num){
				print("$day_num");

			}
			else {
				print("<span class=\"active\">$day</span>");
			}

			print("<p></p>
				</td>
				");

			$day_num++;
		}

	}
?>

<link href="calendar.css" type="text/css" rel="stylesheet" />
<div class="month"> 
  <ul>
  	<form action="index.php" method="GET">
  		<input  type='hidden' id='month' name='month'   />
  		<input  type='hidden' id='year' name='year'  />
  	 </form>

  	 <a href="index.php?year=<?php print $year; ?>&month=<?php print $month - 1; ?>">
 		<li class="prev">&#10094;</li>
 	</a>
 	<li >
	      <?php print($monthName[$month] )?><br>
	      <span style="font-size:18px"><?php print($year)?></span>
    	</li>
 	
 	 <a href="index.php?year=<?php print $year; ?>&month=<?php print $month + 1; ?>">
 		<li class="prev">&#10095;</li>
 	</a>

 	
  </ul>
</div>

<table class="weekdays">
	<?php print(printDaysNames());?>
</table>

<table class="days"> 
 	<?php print(printDays($today, $month, $year));?>  
</table>


