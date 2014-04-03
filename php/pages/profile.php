<?php
include_once("php/DBQuery.php");
$result = DBQuery::sql("SELECT description FROM user WHERE id = '$_SESSION[user_id]' AND description IS NOT NULL");

if(count($result) == 1)
	$profileDescription = $result[0]["description"];
else
	$profileDescription = "Hej. Du suger. Du är lat.";


?>