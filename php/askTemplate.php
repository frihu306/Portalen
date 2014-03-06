<?php

include_once('DBQuery.php');

$date = new DateTime;
$date->setTimezone(new DateTimeZone('Europe/Stockholm'));
$date = $date->format('Y-m-d');

if($_GET['template_id'] == 'no')
{
	echo '{"type":"no","start":"","end":""}';
}
else
{
	$id = $_GET['template_id'];
	$template = DBQuery::sql("SELECT event_type_id, start_time, end_time FROM event_template WHERE id = '$id'");
	$type = $template[0]['event_type_id'];
	$start = new DateTime($template[0]['start_time']);
	$start = $start->format('H:i');
	//$start = $date.' '.$start;
	$end = new DateTime($template[0]['end_time']);
	$end = $end->format('H:i');
	//Use commented lines to adjust end date if over midnight with php. 
	//Using javascript in createEvent.php to do this operation at the moment.
	//$end = $date.' '.$end;
	/*if($end < $start)
	{
		$end = new DateTime($end);
		$end->add(new DateInterval('P1D'));
		$end = $end->format('Y-m-d H:i');
	}*/
	
	$templateSlots = DBQuery::sql	("SELECT start_time, end_time, points, name FROM event_template_group
									INNER JOIN work_group ON group_id = work_group.id 
									WHERE event_template_id = '$id'");
	
	$json = '{"type":'.$type.',"start":"'.$start.'","end":"'.$end.'","slots":[';
	for($i = 0; $i < count($templateSlots); ++$i)
	{
		$slotStart = new DateTime($templateSlots[$i]['start_time']);
		$slotStart = $slotStart->format('H:i');
		$slotEnd = new DateTime($templateSlots[$i]['end_time']);
		$slotEnd = $slotEnd->format('H:i');
		$points = $templateSlots[$i]['points'];
		$groupId = $templateSlots[$i]['name'];
		$json .= '{"start":"'.$slotStart.'","end":"'.$slotEnd.'","points":'.$points.',"group":"'.$groupId.'"}';
	}
	$json .= ']}';
	
	echo $json;
}

?>