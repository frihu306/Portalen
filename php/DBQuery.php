<?php

include_once('DBConnect.php');

class DBQuery
{			

	public static $lastId;

	public static function sql($sql)
	{
		DBConnect::open();
		$result = mysql_query($sql);
		self::$lastId = mysql_insert_id();
		DBConnect::close();
		$rows = array();
		if(strtolower(substr($sql,0,6)) == 'select')
		{
			while($row = mysql_fetch_array($result))
			{
				array_push($rows,$row);
			}
			return $rows;
		}
	}
}

?>