<?php
include_once('DBQuery.php');

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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="../css/jquery-ui-timepicker-addon.css">
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="../js/ui-datepicker.js"></script>
<script src="../js/ui_timepicker-addon.js"></script>
<script>
	$(function() {
		$( ".datepicker" ).datetimepicker();
	});
</script>
<script>

//Global variables
var countSlots = 0;

Date.prototype.yyyymmdd = function() {         
                                
        var yyyy = this.getFullYear().toString();                                    
        var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based         
        var dd  = this.getDate().toString();             
                            
        return yyyy + '-' + (mm[1]?mm:"0"+mm[0]) + '-' + (dd[1]?dd:"0"+dd[0]);
   };  


function getTemplate(id)
{
	if(window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function()
	{
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
		{
			var jsonObj = JSON.parse(xmlhttp.responseText);
			var date = new Date();
			$("#type" + jsonObj.type).attr("selected", "selected");
			$("#start").attr("value", date.yyyymmdd() + " " + jsonObj.start);
			
			var endDate = new Date();
			if(jsonObj.end < jsonObj.start)
			{
				endDate.setDate(date.getDate() + 1);
			}
			
			$("#end").attr("value", endDate.yyyymmdd() + " " + jsonObj.end);
		}
	}
	xmlhttp.open("GET","askTemplate.php?template_id="+id, true);
	xmlhttp.send();
}

function addGroup()
{
	var group = $("#group option:selected").text();
	var start = $("#slot_start").val();
	var end = $("#slot_end").val();
	var points = $("#slot_points").val();
	var amount = $("#group_amount").val();
	for(var i = 0; i < amount; ++i)
	{
		$("#added_groups").append("<p id='slot" + countSlots + "'>"
		+ "<input type='text' value='" + group + "' name='slotGroups[]' style='border:0px;' size='11' readonly />"
		+ "<input class='datepicker' type='text' value='" + start + "' name='slotStarts[]' />"
		+ "<input class='datepicker' type='text' value='" + end + "' name='slotEnds[]' />"
		+ "<input type='number' value='" + points + "' name='slotPoints[]' style='width:40px;' />"
		+ "<button type='button' onclick='removeSlot(" + countSlots + ")'>X</button></p>");
		++countSlots;
	}
}

function removeSlot(id)
{
	$("#slot" + id).remove();
}

</script>
<form action="" method="post">
	<p><input type="text" placeholder="Namn" name="name"/></p>
	<p>
		<select name="template" onchange="getTemplate(this.value)">
			<option value="no">Ingen mall</option>
			<?php loadTemplates(); ?>
		</select>
	</p>
	<p>
		<select name="type">
			<option id="typeno" value="no">Välj typ</option>
			<?php loadTypes(); ?>
		</select>
	</p>
	<p><input id="start" class="datepicker" type="text" placeholder="Starttid" name="start" value="<?php echo $date; ?>"/></p>
	<p><input id="end" class="datepicker" type="text" placeholder="Sluttid" name="end" value="<?php echo $date; ?>"/></p>
	<div id="added_groups">
	</div>
	<p>
		<input type="button" value="Lägg till pass" onClick="addGroup()"/>
		<input id="group_amount" type="number" value="1" style="width:40px;"/>
		<select id="group" name="group">
			<?php loadGroups(); ?>
		</select>
		<input id="slot_start" class="datepicker" type="text" placeholder="Starttid" name="start" value="<?php echo $date; ?>"/>
		<input id="slot_end" class="datepicker" type="text" placeholder="Sluttid" name="end" value="<?php echo $date; ?>"/>
		<input id="slot_points" type="number" value="0" style="width:40px;"/>
	<p>
	
	<input type="submit" name="submit" value="Skapa event"/></p>
</form>