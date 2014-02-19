<?php
	include_once('DBQuery.php');

	if(isset($_POST['submit']))
	{
		$userName = $_POST['user_name'];
		$password = $_POST['password'];
		$passwordMD5 = md5('d98b05a7c7add6fa22b8de62444da5a5'.$password.'d99947dd2b0329f55babeaa6597fb7c8');
		$passwordMD5 = md5($passwordMD5);
		$ssn = $_POST['ssn'];
		$mail = $_POST['mail'];
		$name = $_POST['name'];
		$lastName = $_POST['last_name'];
		
		if($userName != '' && $password != '' && $ssn != '' && $mail != '' && $name != '' && $lastName != '')
		{
			DBQuery::sql("INSERT INTO user (user_name, password, ssn, mail, name, last_name)
							VALUES ('$userName', '$passwordMD5', '$ssn', '$mail', '$name', '$lastName')");
			?>
			<script>
				window.location = "createAccount.php";
			</script>
			<?php
		}
		
	}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<form action="" method="post">
	<p><input type="text" placeholder="Användarnamn" name="user_name"/></p>
	<p><input type="password" placeholder="Lösenord" name="password" value="test"/></p>
	<p><input type="text" placeholder="Personnummer" name="ssn" maxlength="10"/></p>
	<p><input type="text" placeholder="Mail" name="mail"/></p>
	<p><input type="text" placeholder="Namn" name="name"/></p>
	<p><input type="text" placeholder="Efternamn" name="last_name"/></p>
	<p><input type="submit" name="submit" value="Skapa konto"/></p>
</form>