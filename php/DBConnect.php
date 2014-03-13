<?php

class DBConnect
{

	public static $mysql;

	public static function open()
	{
		self::$mysql = mysql_connect("localhost","root","") or die("Unable to connect to MySQL");
		mysql_select_db("portalen");
		mysql_set_charset('utf8');
	}
	
	public static function close()
	{
		mysql_close(self::$mysql);
	}

} 
?> 