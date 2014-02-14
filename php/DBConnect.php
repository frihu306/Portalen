<?php

class DBConnect
{

	public static $mysql;

	public static function open()
	{
		self::$mysql = mysql_connect("localhost","root","") or die("Unable to connect to MySQL");
		mysql_select_db("portalen");
	}
	
	public static function close()
	{
		mysql_close(self::$mysql);
	}

} 
?> 