﻿<?php
session_start();

include_once('DBQuery.php');

if(isset($_SESSION['user_id']))
{
	//header('Location: ../index.html');
}

if(isset($_POST['log_in']))
{
	$userName = mysql_real_escape_string($_POST['user_name']);
	$password = mysql_real_escape_string($_POST['password']);
	
	$passwordMD5 = md5('d98b05a7c7add6fa22b8de62444da5a5'.$password.'d99947dd2b0329f55babeaa6597fb7c8');
	$passwordMD5 = md5($passwordMD5);
	
	$result = DBQuery::sql("SELECT id FROM user WHERE user_name = '$userName' AND BINARY password = '$passwordMD5'");
	if(count($result) == 1)
	{
		$_SESSION['user_id'] = $result[0]['id'];
		header('Location: ../index.html');
	}
}

?>

<html>
<head>
</head>
<body>
	<form action="" method="post">
		<p>
			Användarnamn:<input type="text" placeholder="Användarnamn" name="user_name"/>
		</p>
		<p>
			Lösenord:<input type="password" placeholder="Lösenord" name="password"/>
		</p>
		<p>
			<input type="submit" value="Logga in" name="log_in"/>
		</p>
	</form>
</body>
</html>