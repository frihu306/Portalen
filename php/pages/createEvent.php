<?php
include_once('php/DBQuery.php');

$date = new DateTime;
$date->setTimezone(new DateTimeZone('Europe/Stockholm'));
$date = $date->format('Y-m-d');

if(isset($_POST['submit']))
{
	$name = $_POST['name'];
	$type = $_POST['type'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	
	$periodId = DBQuery::sql("SELECT id FROM period WHERE start_date < '$start' AND end_date > '$start'");
	$periodId = $periodId[0]['id'];
	if($name != '' && $type != 'no' && $start != '' && $end != '' && $start < $end)
	{
		DBQuery::sql("INSERT INTO event (id, name, event_type_id, start_time, end_time, period_id)
						VALUES ('', '$name', '$type', '$start', '$end', '$periodId')");
		$eventId = DBQuery::$lastId;
		if(isset($_POST['slotGroups']))
		{
			$slotGroups = $_POST['slotGroups'];
			$slotStarts = $_POST['slotStarts'];
			$slotEnds = $_POST['slotEnds'];
			$slotPoints = $_POST['slotPoints'];
			
			for($i = 0; $i < count($slotGroups); ++$i)
			{
				$groupIds = DBQuery::sql("SELECT id FROM work_group WHERE name = '$slotGroups[$i]'");
				$groupId = $groupIds[0]['id'];
				DBQuery::sql("INSERT INTO work_slot (group_id, event_id, start_time, end_time, points)
						VALUES ('$groupId', '$eventId', '$slotStarts[$i]', '$slotEnds[$i]', '$slotPoints[$i]')");
			}
		}
		?>
		<script>
			window.location = "?page=createEvent";
		</script>
		<?php
	}
}
function loadTypes()
{
	$types = DBQuery::sql("SELECT id, name FROM event_type ORDER BY name");
	for($i = 0; $i < count($types); ++$i)
	{
		?>
			<option id="type<?php echo $types[$i]['id']; ?>" value="<?php echo $types[$i]['id']; ?>"><?php echo $types[$i]['name']; ?></option>
		<?php
	}
}

function loadTemplates()
{
	$templates = DBQuery::sql("SELECT id, name FROM event_template ORDER BY name");
	for($i = 0; $i < count($templates); ++$i)
	{
		?>
			<option value="<?php echo $templates[$i]['id']; ?>"><?php echo $templates[$i]['name']; ?></option>
		<?php
	}
}

function loadGroups()
{
	$groups = DBQuery::sql("SELECT id, name FROM work_group ORDER BY name");
	for($i = 0; $i < count($groups); ++$i)
	{
		?>
			<option value="<?php echo $groups[$i]['id']; ?>"><?php echo $groups[$i]['name']; ?></option>
		<?php
	}
}

?>