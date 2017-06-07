<?php 
	header('Content-Type: text/html; charset=UTF-8');
	$monthName[1] = 'January';
	$monthName[2] = 'February';
	$monthName[3] = 'March';
	$monthName[4] = 'April';
	$monthName[5] = 'May';
	$monthName[6] = 'June';
	$monthName[7] = 'July';
	$monthName[8] = 'August';
	$monthName[9] = 'September';
	$monthName[10] = 'Octomber';
	$monthName[11] = 'November';
	$monthName[12] = 'December';

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
		$daysNames = Array('Monday', 'Tuesday', 'Wednesday', 'Thirstday', 'Friday', 'Saturday', 'Sunday');
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


