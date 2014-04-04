<?php
include_once("php/DBQuery.php");
$result = DBQuery::sql("SELECT description, phone_number, date_created, mail FROM user WHERE id = '$_SESSION[user_id]' AND description, phone_number, date_created, mail IS NOT NULL");

if(count($result) == 1)
{
	$profileDescription = $result[0]["description"];
	$profileNumber = $result[0]["phone_number"];
	$profileCreation = $result[0]["date_created"];
	$profileMail = $result[0]["mail"];
}
else
	{
	$profileDescription = "Hej ".$_SESSION['name']." har inte skrivit något om sig själv ännu.";
	$profileNumber = "";
	$profileCreation = "";
	$profileMail = "";
}

?>