<?php
include_once('php/DBQuery.php');

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
			window.location = "?page=createAccount";
		</script>
		<?php
	}
	
}
?>