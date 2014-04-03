<?php
include_once("php/DBQuery.php");
$result = DBQuery::sql("SELECT description FROM user WHERE id = '$_SESSION[user_id]' AND description IS NOT NULL");

if(count($result) == 1)
	$profileDescription = $result[0]["description"];
else
	$profileDescription = "Hej ".$_SESSION['name']." har inte skrivit något om sig själv ännu.";

$result = DBQuery::sql("SELECT phone_number FROM user WHERE id = '$_SESSION[user_id]' AND phone_number IS NOT NULL");

if(count($result) == 1)
	$profileNumber = $result[0]["phone_number"];
else
	$profileNumber = "";


$result = DBQuery::sql("SELECT date_created FROM user WHERE id = '$_SESSION[user_id]' AND date_created  IS NOT NULL");

if(count($result) == 1)
	$profileCreation = $result[0]["date_created"];
else
	$profileCreation = "";

$result = DBQuery::sql("SELECT mail FROM user WHERE id = '$_SESSION[user_id]' AND mail  IS NOT NULL");

if(count($result) == 1)
	$profileMail = $result[0]["mail"];
else
	$profileMail = "";

?>