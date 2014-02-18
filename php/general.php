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
	$upcomingEvents = DBQuery::sql("SELECT * FROM event WHERE start_time >= '$date'ORDER BY start_time LIMIT 3");
	
	function loadUpcomingEvents($events)
	{
		for($i = 0; $i < count($events); ++$i)
		{
			?>
			<div class="col-sm-4">
					 <div class="upcoming-event">
						 <strong><?php echo $events[$i]['name']; ?></strong><br /> 20:e februari 17.00-18.00
					 </div>
					 <div class="upcoming-event-info" style="overflow: hidden;">
						 <small><p style="float: left;">Lediga pass <br /><strong>2/16</strong></p>
						 <p style="float: right">Arrangemangstyp <br /><strong>Personalaktivitet</strong></p></small>
					 </div>
				 </div>
			<?php
		}
	}
?>