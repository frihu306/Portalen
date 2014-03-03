<?php
session_start();
if(!isset($_SESSION['user_id']))
{
	header('Location: login.php');
}

include_once('php/general.php');
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
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
					  
					  <div class="progress">
					    <div class="progress-bar worked" style="width: <?php echo $workedPointsPercent ?>%">
						<!--<p> 3p </p>
					      <span class="sr-only">3 arbetade poÃ¤ng</span>-->
					    </div>
					    <div class="progress-bar booked" style="width: <?php echo $bookedPointsPercent ?>%">
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
		              <li class="active"><a href="#"><span class="glyphicon glyphicon-home"></span>Hem</a></li>
		              <li class="dropdown">
		                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>Mitt konto <b class="caret"></b></a>
		                <ul class="dropdown-menu">
		                  <li><a href="#">Arbetade pass</a></li>
		                  <li><a href="#">Meddelanden</a></li>
		                  <li class="divider"></li>
		                  <li class="dropdown-header">Inställningar</li>
		                  <li><a href="#">Redigera profil</a></li>
		                  <li><a href="#">Avsluta medlemskap</a></li>
		                </ul>
		              </li>
		              <li><a href="#about"><span class="glyphicon glyphicon-list-alt"></span>Boka pass</a></li>
		              <li><a href="#contact"><span class="glyphicon glyphicon-bullhorn"></span>Nyheter</a></li>
					  <li><a href="#contact"><span class="glyphicon glyphicon-comment"></span>Diskussionsforum</a></li>
					  <li><a href="#contact"><span class="glyphicon glyphicon-globe"></span>Lagsidor</a></li>
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
				 <div class="col-sm-5">
					 <div class="row">
						 <div class="col-sm-12"><h3>Dina bokade pass</h3>
							
							 
							
							<div class="list-group">
							  <?php loadBookedEvents(); ?>
							</div>
							
						<h3>Idag på Trappan</h3>
							<div class="list-group">	
							<?php
								loadTodaysEvents();
							?>
							</div>
						
						 <h3>Lediga pass</h3>
						 
							 <div class="list-group">
								<?php loadAvailableEvents(); ?>
							 </div>
							 
						 </div>
				 	</div>
				 </div>
				 <div class="col-sm-7">
					 <h1>En helgrym H1-rubrik. Light 36px</h1>
					 <img src="profile.jpg" class="avatar-16x16" width="16px" height="16px"><small>Skrivet av <a href="#">Astrid Adelsköld</a> den 24 februari 2014 kl. 14:45</small>
					 <p>Hej! Terminen har dragit igång och det finns några pass kvar i januari att fylla. Framförallt på Vinterkravallen och Nollefesten, där behöver vi dessutom allapass som vem som helst kan jobba som! Annars finns det nu pass för februari, och som vanligt gäller det att jobba 8 poäng eller motsvarande för att få personalförmåner. 
						 
<h2>En H2-rubrik som är smal. Light 30px</h2>
Ny termin betyder också ny personal, onsdagen den 5/2 kl 18 kommer vi ha infokväll på Trappan! Så om ni känner någon som är sugen på att börja men vill ha mer information om lagen och Trappan - tipsa dem om infokvällen!

<h3>Sen har vi H3 också. Light 24px</h3>
<h4>Och en H4. Bold 18px</h4>
Dagen innan infokvällen, alltså tisdagen 4/2, vill vi istället hylla er som redan jobbar på Trappan genom att ha personalpub! Denna gång är det marknadsföringslaget och barlaget som ska anordna, mer information kommer inom kort.Hej! Terminen har dragit igång och det finns några pass kvar i januari att fylla. Framförallt på Vinterkravallen och Nollefesten, där behöver vi dessutom allapass som vem som helst kan jobba som! Annars finns det nu pass för februari, och som vanligt gäller det att jobba 8 poäng eller motsvarande för att få personalförmåner. Nästa personalfest är i mars, så för att få gå på den måste man ha jobbat sina poäng i både dec/jan och februari! Alternativt vara nybyggare och aldrig ha gått på en personalfest innan.
<h5>En H5-rubrik kommer här. Bold 14px</h5>
<h6>En H6-rubrik kommer här. Bold 12px</h6>
Ny termin betyder också ny personal, onsdagen den 5/2 kl 18 kommer vi ha infokväll på Trappan! Så om ni känner någon som är sugen på att börja men vill ha mer information om lagen och Trappan - tipsa dem om infokvällen!

Dagen innan infokvällen, alltså tisdagen 4/2, vill vi istället hylla er som redan jobbar på Trappan genom att ha personalpub! Denna gång är det marknadsföringslaget och barlaget som ska anordna, mer information kommer inom kort</p></div>
   		 	 </div>
			 
		  <div class="row">
			  <div id="footer">
			  <div class="col-sm-10">
				  <p>Trappans Personalportal 2014. <a href="#">Om portalen</a>. <br />Kontakta Trappans <a href="#">webbansvarig</a> vid problem eller frågor. Portalen använder sig av <a href="http://glyphicons.com/" target="_blank">Glyphicons</a>.
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
  </body>
</html>
