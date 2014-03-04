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
	xmlhttp.open("GET","php/askTemplate.php?template_id="+id, true);
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
	<p><input id="start" class="datepicker" type="text" placeholder="Starttid" name="start" value="<?php echo $dateNoTime; ?>"/></p>
	<p><input id="end" class="datepicker" type="text" placeholder="Sluttid" name="end" value="<?php echo $dateNoTime; ?>"/></p>
	<div id="added_groups">
	</div>
	<p>
		<input type="button" value="Lägg till pass" onClick="addGroup()"/>
		<input id="group_amount" type="number" value="1" style="width:40px;"/>
		<select id="group" name="group">
			<?php loadGroups(); ?>
		</select>
		<input id="slot_start" class="datepicker" type="text" placeholder="Starttid" value="<?php echo $dateNoTime; ?>"/>
		<input id="slot_end" class="datepicker" type="text" placeholder="Sluttid" value="<?php echo $dateNoTime; ?>"/>
		<input id="slot_points" type="number" value="0" style="width:40px;"/>
	<p>
	
	<input type="submit" name="submit" value="Skapa event"/></p>
</form>