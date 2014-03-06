
<?php
session_start();

include_once('php/DBQuery.php');

if(isset($_SESSION['user_id']))
{
	//header('Location: ../index.html');
	session_destroy();
}

if(isset($_POST['log_in']))
{
	$userName = mysql_real_escape_string($_POST['user_name']);
	$password = mysql_real_escape_string($_POST['password']);
	
	$passwordMD5 = md5('d98b05a7c7add6fa22b8de62444da5a5'.$password.'d99947dd2b0329f55babeaa6597fb7c8');
	$passwordMD5 = md5($passwordMD5);
	
	$result = DBQuery::sql("SELECT id, name, last_name FROM user WHERE user_name = '$userName' AND BINARY password = '$passwordMD5'");
	if(count($result) == 1)
	{
		$_SESSION['user_id'] = $result[0]['id'];
		$_SESSION['name'] = $result[0]['name'];
		$_SESSION['last_name'] = $result[0]['last_name'];
		//Change to hardcoded url later to get rid of index.php in url
		?>
		<script>
			window.location = "index.php?page=start";
		</script>
		<?php
	}
}

?>



<html>
<head>
<link href="css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      /* Override some defaults */
      html, body {
        background-color: #de851b;
      }
      body {
        padding-top: 40px; 
      }
      .container {
        width: 300px;
      }

      /* The white background content wrapper */
      .container > .content {
        background-color: #f5f5f5;
        padding: 20px;
        margin: 0 -10px;
      }

	  .login-form {
		margin-top: 20px;
	  }
	
	  legend {
		margin-right: -50px;
		font-weight: bold;
	  	color: #404040;
	  }
	  
	  textarea:focus, input:focus{
    outline: 0;
}
	  
	  .btn-primary {
		color: #ffffff;
		background-color: #428bca;
	  }
	  
	  input {
	  background: #fff;
	  padding: 4px;
	  border-color: #fff;
	  }

	  .btn {
		display: inline-block;
		padding: 6px 12px;
		margin-bottom: -20;
		margin-left: 112;
		margin-top: 10px;
		font-size: 14px;
		color: #fff;
		font-weight: normal;
		line-height: 1.428571429;
		text-align: center;
		white-space: nowrap;
		vertical-align: middle;
		cursor: pointer;
		background: #f99929;
		border-radius: 0;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		-o-user-select: none;
		user-select: none;
}

box {
background: #f99929;
padding: 8px;

}

.orange {
color: #fff;

}

input:-webkit-autofill {
-webkit-box-shadow: 0 0 0px 1000px #fff inset;
}

input, input[type="password"], input[type="search"], isindex {
background-color: white;
border-top: 2px solid #eeeeee;
border-bottom: 2px solid #eeeeee;
border-right: 2px solid #eeeeee;
border-left: 0px solid;
-webkit-rtl-ordering: logical;
-webkit-user-select: text;
cursor: auto;
}

.logo {
		width: 290;
		max-height: 20;
		overflow: hidden;
	} 
	
.info {

	margin-top: 30px;
	text-align: center;
	margin-bottom: -20px;
	font-size: 10px;

}
    </style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body><center><a href="/" class="logo"><img src="img/border2.png"></a></center>
  <div class="container">
			<div class="content">
			  <div class="row"><center>
				<div class="login-form">
				  <form action="" method="post">
					<fieldset>
					  <div class="clearfix">
						<box><span class="glyphicon glyphicon-user  orange"></span> </box><input type="text" placeholder="Username" name="user_name" >
					  </div></br>
					  <div class="clearfix">
					   <box><span class="glyphicon glyphicon-lock orange"></span> </box> <input type="password" placeholder="Password" name="password">
					  </div>
					  <button class="btn primary" type="submit" name="log_in">Logga in</button>
					</fieldset>
				  </form></center>
				  		<div class="info"><p>För att kunna logga in måste du vara registrerad. </br>Kontakta personalansvarig vid problem.</p></div>
				</div>
			 </div>
	</div>
  </div> <!-- /container -->
</body>
</html>