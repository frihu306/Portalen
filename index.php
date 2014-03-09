<?php
session_start();
if(!isset($_SESSION['user_id']))
{
	header('Location: login.php');
}

include_once('php/general.php');
include_once('php/pageManager.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Trappans personalportal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<link href="css/style.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<link rel="stylesheet" href="css/jquery-ui-1.10.4.custom.css">
	<link rel="stylesheet" href="css/jquery-ui-timepicker-addon.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	<script src="https://code.jquery.com/jquery.js"></script>
  </head>
  <body>
	  <div id="page-container">
		  <div id="sidebar">
			  <!-- begin logo -->
			  <a href="/" class="logo"><img src="img/logo.png"></a>
			  <!-- end Logo -->
			 
			  <div class="your-period">
 					 <p>
 					  <small>Din period: <strong><?php echo $periodStart.' - '.$periodEnd; ?></strong></small>
 					  </p>
					  
					  <div class="progress" rel='tooltip' title="Här ska det vara ett php-script" >
					    <div class="progress-bar worked" rel='tooltip' title="Arbetade: <?php echo $workedPointsPercent ?>p" style="width: <?php echo $workedPointsPercent ?>%">
						<!--<p> 3p </p>
					      <span class="sr-only">3 arbetade poÃ¤ng</span>-->
					    </div>
					    <div class="progress-bar booked" rel='tooltip'  title="Bokade: <?php echo $bookedPointsPercent ?>p" style="width:<?php echo $bookedPointsPercent ?>%">
						<!--<p> 3p </p>
					      <span class="sr-only">3 bokade poÃ¤ng</span> -->
					    </div>
					  </div> <!-- .progress -->
					  
			  </div> <!-- .your-period -->
			  
			  
			  <!-- begin menu -->
			  
		      <!-- Fixed navbar -->
		      <div class="main-menu-wrapper" role="navigation">
		        
		          <div class="navbar-header">
		            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		              <span class="sr-only">Toggle navigation</span>
		              <span class="icon-bar"></span>
		              <span class="icon-bar"></span>
		              <span class="icon-bar"></span>
		            </button>
		          </div>
				  
				  
		          <div class="navbar-collapse collapse">
		            <ul class="main-nav">
		              <li class="active"><a href="?page=start"><span class="glyphicon glyphicon-home"></span>Hem</a></li>
		              <li class="panel dropdown">
					<a data-toggle="collapse" data-parent="#menu-bar" href="#collapseOne" ><span class="glyphicon glyphicon-user"></span>Min konto<span class="glyphicon glyphicon-chevron-down"></span></a>
						  <ul id="collapseOne" class="panel-collapse collapse">
						  <li><a href="#">Min profil</a></li>
						  <li><a href="#">Meddelande</a></li>
						  <li><a href="#">Redigera profil</a></li>
						  <li><a href="#">Avsluta medlemskap</a></li>
						  </ul>
		              </li>
		               <li class="panel dropdown">
					<a data-toggle="collapse" data-parent="#menu-bar2" href="#collapseTwo" ><span class="glyphicon glyphicon-wrench"></span>Adminverktyg<span class="glyphicon glyphicon-chevron-down"></span></a>
						  <ul id="collapseTwo" class="panel-collapse collapse">
					  <li><a href="?page=createEvent"></span>Skapa evenemang</a></li>
					  <li><a href="?page=createAccount"></span>Skapa nytt konto</a></li>
						  </ul>
		              </li>
		              <li><a href="?page=book" onclick="location.reload()"><span class="glyphicon glyphicon-list-alt"></span>Boka pass</a></li>
		              <li><a href="?page=news"><span class="glyphicon glyphicon-bullhorn"></span>Nyheter</a></li>
					  <li><a href="?page=forum"><span class="glyphicon glyphicon-comment"></span>Diskussionsforum</a></li>
					  <li><a href="?page=groups"><span class="glyphicon glyphicon-globe"></span>Lagsidor</a></li>

		            </ul>
		          </div><!--/.nav-collapse -->
		        
		      </div>
			  
			  
			  
			  <!-- end menu -->
				  
		  </div> 
		  <!-- end sidebar -->

		  <div id="content">
			  <div class="row">
				  <div class="col-sm-4 search">
					  <button type="submit" class="btn"><span class="glyphicon glyphicon-search"></span></button>
				  		<input type="search" class="form-control" placeholder="Sök på portalen...">
				  </div> <!-- col-sm-4 -->
					  
				  	<div class="col-sm-8">
					  <div class="user-info">
						  <img src="<?php echo loadAvatar(); ?>" class="avatar-32x32" width="32px" height="32px">
						  <a href="http://google.se" class="username"><span style="font-weight: normal">Inloggad som</span> <?php echo $_SESSION['name'].' '.$_SESSION['last_name']; ?></a>
					  	<a href="login.php" class="sign-out"><span class="glyphicon glyphicon-off"></span></a>
					  </div>
				  </div>
		 	 </div> 
			 <div class="top-div"></div>
   		 	 
   		 	 <div class="row">
				<?php content(); ?>
   		 	 </div>
			 
		  <div class="row">
			  <div id="footer">
			  <div class="col-sm-10">
				  <p>Trappans Personalportal 2014. <a href="?page=about">Om portalen</a>. <br />Kontakta Trappans <a href="#">webbansvarig</a> vid problem eller frågor. Portalen använder sig av <a href="http://glyphicons.com/" target="_blank">Glyphicons</a>.
			  </div>
			  <div class="col-sm-2 text-right">
				  <a href="#top" class="scroll-to-top"><span class="glyphicon glyphicon-chevron-up"></span></a>
			  </div>
		 	  </div> <!-- #footer -->
		  </div>
			 
   	 	</div> <!-- end #content -->
	</div> <!-- #page-container -->
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<script src="js/ui-datepicker.js"></script>
	<script src="js/ui_timepicker-addon.js"></script>
	<script>
		$(function() {
			$( ".datepicker" ).datetimepicker();
		});
	</script>
	
					<script type="text/javascript">
						(function($) {
							var $window = $(window),
								$html = $('#menu-bar');

							$window.resize(function resize() {
								if ($window.width() < 768) {
								   return $html.removeClass('nav-stacked');
								}
								$html.addClass('nav-stacked');
							}).trigger('resize');
									})(jQuery);
				</script>

		  <script>
  $(function() {
    $( document ).tooltip({
      position: {
        using: function( position, feedback ) {
          $( this ).css( position );
          $( "<div>" )
            .addClass( "arrow" )
            .addClass( feedback.vertical )
            .addClass( feedback.horizontal )
            .appendTo( this );
        }
      }
    });
  });
  </script>
  </body>
</html>
