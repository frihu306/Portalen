<?php

include_once('DBConnect.php');

class DBQuery
{			
	public static function sql($sql, $close = True)
	{
		DBConnect::open();
		$result = mysql_query($sql);
		if($close == True)
		{
			DBConnect::close();
		}
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