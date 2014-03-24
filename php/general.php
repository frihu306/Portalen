<?php
include_once('php/DBQuery.php');
	
	
//Score progress bar calculation
$dates = new DateTime;
$dates->setTimezone(new DateTimeZone('Europe/Stockholm'));
$date = $dates->format('Y-m-d H:i:s');
$dateNoTime = $dates->format('Y-m-d');
				
$workedPointsResult = DBQuery::sql	("SELECT points FROM work_slot WHERE event_id IN
										(SELECT id FROM event WHERE period_id IN 
											(SELECT id FROM period WHERE start_date <= '$dateNoTime' AND end_date >= '$dateNoTime')
										) 
									AND id IN
										(SELECT work_slot_id FROM user_work WHERE user_id = '$_SESSION[user_id]' AND checked = '1')
									");
				
$workedPoints = 0;

$bookedPointsResult = DBQuery::sql	("SELECT points FROM work_slot WHERE event_id IN
										(SELECT id FROM event WHERE period_id IN 
											(SELECT id FROM period WHERE start_date <= '$dateNoTime' AND end_date >= '$dateNoTime')
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

$emptyPoints = 8 - $workedPoints - $bookedPoints;

$emptyPointsPercent = $emptyPoints / 8 * 100;
$workedPointsPercent = $workedPoints / 8 * 100;
$bookedPointsPercent = $bookedPoints / 8 * 100;

/*
	The progressbar showed wrong value, 25% instead of 75%. It seems to work after I 	commented this code. /Andreas

if($emptyPointsPercent > 100 - $emptyPointsPercent)
{
	$emptyPointsPercent = 100 - $emptyPointsPercent;
}*/
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
function loadUpcomingEvents()
{
	global $date;
	$upcomingEvents = DBQuery::sql("SELECT event.id, event.name AS event_name, event.start_time, event.end_time, event_type.name AS type_name FROM event 
									INNER JOIN event_type ON event.event_type_id = event_type.id 
									WHERE start_time > '$date' ORDER BY start_time LIMIT 3");
								
	
	for($i = 0; $i < count($upcomingEvents); ++$i)
	{
		$eventId = $upcomingEvents[$i]['id'];
		$workSlots = DBQuery::sql("SELECT id FROM work_slot WHERE event_id = '$eventId'");
		$availableSlots = DBQuery::sql	("SELECT id FROM work_slot WHERE event_id = '$eventId' AND id NOT IN
											(SELECT work_slot_id FROM user_work)
										");
		$workSlotsCount = count($workSlots);
		$availableSlotsCount = count($availableSlots);
		$availableSlotsText = 'lediga platser';
		if($availableSlotsCount == 1)
		{
			$availableSlotsText = 'ledig plats';
		}
		
		$name = $upcomingEvents[$i]['event_name'];
		$eventDate = new DateTime($upcomingEvents[$i]['start_time']);
		$day = $eventDate->format('j');
		$month = $eventDate->format('n');
		$start = $eventDate->format('H:i');
		$end = new DateTime($upcomingEvents[$i]['end_time']);
		$end = $end->format('H:i');
		$type = $upcomingEvents[$i]['type_name'];
		/*switch($month)
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
		}*/
		?>
			<a href="#" class="list-group-item"><span class="badge"><?php echo $availableSlotsCount.' '.$availableSlotsText; ?></span><strong class="list-group-item-date-floated-left"><?php echo $day.'/'.$month; ?></strong><?php echo $name ?></a>
		<?php
	}
}
//
//Load current period
$periodDates = DBquery::sql("SELECT start_date, end_date FROM period WHERE start_date <= '$dateNoTime' AND end_date >= '$dateNoTime'");
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
	$periodEnd = str_replace('y', 'j', $periodEnd);
	$periodEnd = str_replace('c', 'k', $periodEnd);
}
//
//Load booked events
function loadBookedEvents()
{
	$bookedEvents = DBQuery::sql("SELECT id, name, start_time FROM event WHERE id IN
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
		$eventId = $bookedEvents[$i]['id'];	
		$availableSlots = DBQuery::sql	("SELECT id FROM work_slot WHERE event_id = '$eventId' AND id NOT IN
											(SELECT work_slot_id FROM user_work)
										");
		$availableSlotsCount = count($availableSlots);
		$availableSlotsText = 'lediga platser';
		if($availableSlotsCount == 1)
		{
			$availableSlotsText = 'ledig plats';
		}
		$name = $bookedEvents[$i]['name'];
		$eventDate = new DateTime($bookedEvents[$i]['start_time']);
		$day = $eventDate->format('j');
		$month = $eventDate->format('n');
		$start = new DateTime($workTimes[$i]['start_time']);
		$start = $start->format(' H:i -');
		$end = new DateTime($workTimes[$i]['end_time']);
		$end = $end->format(' H:i');
		$points = $workTimes[$i]['points'];
		?>
		
			<a href="#" class="list-group-item"><i class="glyphicon glyphicon-chevron-down" style="float:right; margin-top: 3px;"></i><span class="badge" style="margin-right: 15px">X poäng</span><strong class="list-group-item-date-floated-left"><?php echo $day.'/'.$month; ?></strong><span class="title" style="font-size: 0.8em; margin: 0 5px 0 -10px"><?php // echo $start. '' .$end;?></span><?php echo $name ?></a>
		
		<?php
	}
	
	if(count($bookedEvents) == 0)
	{
		?>
		
		<p><i>Du har inte några bokade pass just nu.</i></p>
		
		<?php
	}
}
//
//Load today's events
function loadTodaysEvents()
{
	global $dateNoTime;
	$upcomingEvents = DBQuery::sql("SELECT event.id, event.name AS event_name, event.start_time, event.end_time, event_type.name AS type_name FROM event 
									INNER JOIN event_type ON event.event_type_id = event_type.id 
									WHERE start_time > '$dateNoTime' ORDER BY start_time");
								
	
	for($i = 0; $i < count($upcomingEvents); ++$i)
	{
		$eventId = $upcomingEvents[$i]['id'];
		$workSlots = DBQuery::sql("SELECT id FROM work_slot WHERE event_id = '$eventId'");
		$availableSlots = DBQuery::sql	("SELECT id FROM work_slot WHERE event_id = '$eventId' AND id NOT IN
											(SELECT work_slot_id FROM user_work)
										");
		$eventDate = new DateTime($upcomingEvents[$i]['start_time']);
		if($dateNoTime == $eventDate->format('Y-m-d'))
		{
			$workSlotsCount = count($workSlots);
			$availableSlotsCount = count($availableSlots);
			$availableSlotsText = 'lediga platser';
			if($availableSlotsCount == 1)
			{
				$availableSlotsText = 'ledig plats';
			}
			
			$name = $upcomingEvents[$i]['event_name'];
			
			$day = $eventDate->format('j');
			$month = $eventDate->format('n');
			$start = $eventDate->format('H:i -');
			$end = new DateTime($upcomingEvents[$i]['end_time']);
			$end = $end->format(' H:i');
			$type = $upcomingEvents[$i]['type_name'];
			?>
				<a href="#" class="list-group-item"><strong class="list-group-item-time-floated-left"><?php echo $start. '' .$end;?></strong><?php echo $name ?></a>
			<?php
		}
	}
}
//
//Load upcoming events
function loadAvailableEvents()
{
	global $dateNoTime;
	$availableEvents = DBQuery::sql("SELECT event.id, event.name AS event_name, event.start_time, event.end_time, event_type.name AS type_name FROM event 
									INNER JOIN event_type ON event.event_type_id = event_type.id 
									WHERE start_time > '$dateNoTime' AND event.id IN
										(SELECT event_id FROM work_slot WHERE id NOT IN
											(SELECT work_slot_id FROM user_work)
										)
									ORDER BY start_time");
								
	
	for($i = 0; $i < count($availableEvents); ++$i)
	{
		$eventId = $availableEvents[$i]['id'];
		$workSlots = DBQuery::sql("SELECT id FROM work_slot WHERE event_id = '$eventId'");
		$availableSlots = DBQuery::sql	("SELECT id FROM work_slot WHERE event_id = '$eventId' AND id NOT IN
											(SELECT work_slot_id FROM user_work)
										");
		$workSlotsCount = count($workSlots);
		$availableSlotsCount = count($availableSlots);
		$availableSlotsText = 'lediga platser';
		if($availableSlotsCount == 1)
		{
			$availableSlotsText = 'ledig plats';
		}
		
		$name = $availableEvents[$i]['event_name'];
		$eventDate = new DateTime($availableEvents[$i]['start_time']);
		$day = $eventDate->format('j');
		$month = $eventDate->format('n');
		$start = $eventDate->format('H:i -');
		$end = new DateTime($availableEvents[$i]['end_time']);
		$end = $end->format(' H:i');
		$type = $availableEvents[$i]['type_name'];

		?>
			<a href="#" class="list-group-item"><span class="badge"><?php echo $availableSlotsCount.' '.$availableSlotsText; ?></span><strong class="list-group-item-date-floated-left"><?php echo $day.'/'.$month; ?></strong><?php echo $name ?></a>
		<?php
	}
}
//
//Load avatar
function loadAvatar()
{
	$results = DBQuery::sql("SELECT avatar FROM user WHERE id = '$_SESSION[user_id]' AND avatar IS NOT NULL");
	if(count($results) == 0)
	{
		return 'img/avatars/no_face_small.png';
	}
	return 'img/avatars/'.$results[0]['avatar'];
}
?>