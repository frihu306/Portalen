	<div class="col-sm-12">
		<div class="page-header">
		<img src="<?php echo loadAvatar(); ?>" class="avatar-96x96" width="96px" height="96px">
			<h1><?php echo $_SESSION['name'].' '.$_SESSION['last_name']; ?></h1>
		</div>
	</div>
</div> <!-- .row -->

<div class="row">

<div class="col-sm-5">
	<p><?php echo $profileDescription; ?></p>
</div>
<div class="col-sm-7">
<p>Mobilnummer: <?php echo $profileNumber; ?> </br>
Personal på Trappan sedan: <?php echo $profileCreation; ?></br>
E-mail Adress: <?php echo $profileMail; ?></p>
</div>