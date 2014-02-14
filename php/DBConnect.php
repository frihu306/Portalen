<?php

class connect
{

	private $connection;

	public static function connectDB()
	{
		$connection = mysqli_connect("localhost","root","","portalen");
		if(mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		echo "yea";
	}
	
	public static function disconnectDB()
	{
		mysqli_close($connection);
	}

  
?> 