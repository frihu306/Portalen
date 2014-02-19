<?php
include_once('php/DBQuery.php');
	
	
	//Score progress bar calculation
	$date = date('Y-m-d');
					
	$workedPointsResult = DBQuery::sql	("SELECT points FROM work_slot WHERE event_id IN
											(SELECT id FROM event WHERE period_id IN 
												(SELECT id FROM period WHERE start_date <= '$date' AND end_date >= '$date')
											) 
										AND id IN
											(SELECT work_slot_id FROM user_work WHERE user_id = '$_SESSION[user_id]' AND checked = '1')
										");
					
	$workedPoints = 0;
	
	$bookedPointsResult = DBQuery::sql	("SELECT points FROM work_slot WHERE event_id IN
											(SELECT id FROM event WHERE period_id IN 
												(SELECT id FROM period WHERE start_date <= '$date' AND end_date >= '$date')
											) 
										AND id IN
											(SELECT work_slot_id FROM user_work WHERE user_id = '$_SESSION[user_id]' AND checked = '0')
										");
					
	$bookedPoints = 0;
					
	for($i = 0; $i < count($workedPointsResult); ++$i)
	{
		$workedPoints = $workedPoints + $workedPointsResult[$i]['points'];
	}
	
	for($i = 0; $i < count($bookedPointsResult); ++$i)
	{
		$bookedPoints = $bookedPoints + $bookedPointsResult[$i]['points'];
	}
	
	$workedPointsPercent = $workedPoints / 8 * 100;
	$bookedPointsPercent = $bookedPoints / 8 * 100;
	if($workedPointsPercent > 100)
	{
		$workedPointsPercent = 100;
	}
	if($bookedPointsPercent > 100 - $workedPointsPercent)
	{
		$bookedPointsPercent = 100 - $workedPointsPercent;
	}
	//
	//Load upcoming events
	function loadUpcomingEvents($date)
	{
		$upcomingEvents = DBQuery::sql("SELECT * FROM event WHERE start_time >= '$date' ORDER BY start_time LIMIT 3");
		$eventTypes = DBQuery::sql	("SELECT name FROM event_type WHERE id IN 
										(SELECT event_type_id FROM event WHERE start_time >= '$date' ORDER BY start_time)
									LIMIT 3");
		for($i = 0; $i < count($upcomingEvents); ++$i)
		{
			$eventId = $upcomingEvents[$i]['id'];
			$workSlots = DBQuery::sql("SELECT * FROM work_slot WHERE event_id = '$eventId'");
			$availableSlots = DBQuery::sql	("SELECT * FROM work_slot WHERE event_id = '$eventId' AND id NOT IN
												(SELECT work_slot_id FROM user_work)
											");
			$workSlotsCount = count($workSlots);
			$availableSlotsCount = count($availableSlots);
			
			$name = $upcomingEvents[$i]['name'];
			$date = new DateTime($upcomingEvents[$i]['start_time']);
			$day = $date->format('j');
			$month = $date->format('m');
			$start = $date->format('H:i');
			$end = new DateTime($upcomingEvents[$i]['end_time']);
			$end = $end->format('H:i');
			$type = $eventTypes[$i]['name'];
			switch($month)
			{
			case '01':
				$month = 'januari';
				break;
			case '02':
				$month = 'februari';
				break;
			case '03':
				$month = 'mars';
				break;
			case '04':
				$month = 'april';
				break;
			case '05':
				$month = 'maj';
				break;
			case '06':
				$month = 'juni';
				break;
			case '07':
				$month = 'juli';
				break;
			case '08':
				$month = 'augusti';
				break;
			case '09':
				$month = 'september';
				break;
			case '10':
				$month = 'oktober';
				break;
			case '11':
				$month = 'november';
				break;
			case '12':
				$month = 'december';
				break;
			default:
				break;
			}
			?>
			<div class="col-sm-4">
					 <div class="upcoming-event">
						 <strong><?php echo $name; ?></strong><br /> <?php echo $day ?>:e <?php echo $month ?> <?php echo $start.'-'.$end; ?>
					 </div>
					 <div class="upcoming-event-info" style="overflow: hidden;">
						 <small><p style="float: left;">Lediga pass <br /><strong><?php echo $availableSlotsCount; ?>/<?php echo $workSlotsCount; ?></strong></p>
						 <p style="float: right">Arrangemangstyp <br /><strong><?php echo $type ?></strong></p></small>
					 </div>
				 </div>
			<?php
		}
	}
	//
	//Load current period
	$periodDates = DBquery::sql("SELECT start_date, end_date FROM period WHERE start_date <= '$date' AND end_date >= '$date'");
	$periodStart = "";
	$periodEnd = "";
	if(count($periodDates) == 1)
	{
		$periodStart = new DateTime($periodDates[0]['start_date']);
		$periodStart = strtolower($periodStart->format('j M'));
		$periodEnd = new DateTime($periodDates[0]['end_date']);
		$periodEnd = strtolower($periodEnd->format('j M'));
		$periodStart = str_replace('y', 'j', $periodStart);
		$periodStart = str_replace('c', 'k', $periodStart);
	}
	//
	//Load booked events
	function loadBookedEvents()
	{
		$bookedEvents = DBQuery::sql("SELECT name FROM event WHERE id IN
										(SELECT event_id FROM work_slot WHERE id IN
										(SELECT work_slot_id FROM user_work WHERE user_id = '$_SESSION[user_id]' AND checked = '0')
										) 
									ORDER BY start_time
									");
								
		$workTimes = DBQuery::sql	("SELECT start_time, end_time, points FROM work_slot WHERE id IN
										(SELECT work_slot_id FROM user_work WHERE user_id = '$_SESSION[user_id]' AND checked = '0')
									ORDER BY start_time
									");
								
		for($i = 0; $i < count($bookedEvents); ++$i)
		{
			$name = $bookedEvents[$i]['name'];
			$start = new DateTime($workTimes[$i]['start_time']);
			$start = $start->format('j/n H:i');
			$end = new DateTime($workTimes[$i]['end_time']);
			$end = $end->format('H:i');
			$points = $workTimes[$i]['points'];
			?>
			
			<p>
				<?php echo $start.'-'.$end.' '.$name.' '.$points.'p'; ?>
			</p>
			
			<?php
		}
	}
?>