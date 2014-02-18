
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
	
	$result = DBQuery::sql("SELECT * FROM user WHERE user_name = '$userName' AND BINARY password = '$passwordMD5'");
	if(count($result) == 1)
	{
		$_SESSION['user_id'] = $result[0]['id'];
		$_SESSION['name'] = $result[0]['name'];
		$_SESSION['last_name'] = $result[0]['last_name'];
		//Change to hardcoded url later to get rid of index.php in url
		?>
		<script>
			window.location = "index.php";
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
        background-color: #eee;
      }
      body {
        padding-top: 40px; 
      }
      .container {
        width: 300px;
      }

      /* The white background content wrapper */
      .container > .content {
        background-color: #fff;
        padding: 20px;
        margin: 0 -20px; 
      }

	  .login-form {
		margin-left: 65px;
	  }
	
	  legend {
		margin-right: -50px;
		font-weight: bold;
	  	color: #404040;
	  }
	  
	  .btn-primary {
		color: #ffffff;
		background-color: #428bca;
	  }

	  .btn {
		display: inline-block;
		float: right;
		padding: 6px 12px;
		margin-bottom: 0;
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
    </style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
  <div class="container">
    <div class="content">
      <div class="row">
        <div class="login-form">
          <h2>Login</h2>
          <form action="">
            <fieldset>
              <div class="clearfix">
                <input type="text" placeholder="Username" >
              </div>
              <div class="clearfix">
                <input type="password" placeholder="Password">
              </div>
              <button class="btn primary" type="submit" name="sign_in">Sign in</button>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div> <!-- /container -->
</body>
</html>