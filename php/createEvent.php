<?php
	include_once('DBQuery.php');
	
	$date = new DateTime;
	$date->setTimezone(new DateTimeZone('Europe/Stockholm'));
	$date = $date->format('Y-m-d');
	
	if(isset($_POST['submit']))
	{
		$_POST['submit'] == null;
		$name = $_POST['name'];
		$type = $_POST['type'];
		$start = $_POST['start'];
		$end = $_POST['end'];
		
		$periodId = DBQuery::sql("SELECT id FROM period WHERE start_date < '$start' AND end_date > '$start'");
		$periodId = $periodId[0]['id'];
		if($name != '' && $type != 'no' && $start != '' && $end != '' && $start < $end)
		{
			DBQuery::sql("INSERT INTO event (name, event_type_id, start_time, end_time, period_id)
							VALUES ('$name', '$type', '$start', '$end', '$periodId')");
			?>
			<script>
				window.location = "createEvent.php";
			</script>
			<?php
		}
	}
	function loadTypes()
	{
		$types = DBQuery::getRows('event_type');
		for($i = 0; $i < count($types); ++$i)
		{
			?>
				<option value="<?php echo $types[$i]['id']; ?>"><?php echo $types[$i]['name']; ?></option>
			<?php
		}
	}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="../css/jquery-ui-timepicker-addon.css">
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="../js/ui-datepicker.js"></script>
<script src="../js/ui-timepicker-addon.js"></script>
<script>
	$(function() {
		$( ".datepicker" ).datetimepicker();
	});
</script>
<form action="" method="post">
	<p><input type="text" placeholder="Namn" name="name"/></p>
	<p>
		<select name="type">
			<option value="no">Välj typ</option>
			<?php loadTypes(); ?>
		</select>
	</p>
	<p><input class="datepicker" type="text" placeholder="Starttid" name="start"/></p>
	<p><input class="datepicker" type="text" placeholder="Sluttid" name="end"/></p>
	<p><input type="submit" name="submit" value="Skapa event"/></p>
</form>