<?php

include_once('DBConnect.php');

class DBQuery
{	
	public static function get($select, $from, $where, $value)
	{
		$sql = "SELECT $select FROM $from WHERE $where = '$value'";
		DBConnect::open();
		$result = mysql_query($sql);
		DBConnect::close();
		$row = mysql_fetch_array($result);
		return $row[$select];
	}
	
	public static function getSeveral($select, $from, $where = 0, $value = 0)
	{
		if($where == 0)
			$sql = "SELECT $select FROM $from";
		else
			$sql = "SELECT $select FROM $from WHERE $where = '$value'";
		DBConnect::open();
		$result = mysql_query($sql);
		DBConnect::close();
		$rows = array();
		while($row = mysql_fetch_array($result))
		{
			array_push($rows,$row[$select]);
		}
		return $rows;
	}
	
	public static function getRow($from, $id)
	{
		$sql = "SELECT * FROM $from WHERE id = '$id'";
		DBConnect::open();
		$result = mysql_query($sql);
		DBConnect::close();
		$row = mysql_fetch_array($result);
		return $row;
	}
	
	public static function getRows($from, $where = 0, $value = 0)
	{
		if($where == 0)
			$sql = "SELECT * FROM $from";
		else
			$sql = "SELECT * FROM $from WHERE $where = '$value'";
		DBConnect::open();
		$result = mysql_query($sql);
		DBConnect::close();
		$rows = array();
		while($row = mysql_fetch_array($result))
		{
			array_push($rows,$row);
		}
		return $rows;
	}
	
	public static function sql($sql)
	{
		DBConnect::open();
		$result = mysql_query($sql);
		DBConnect::close();
		$rows = array();
		while($row = mysql_fetch_array($result))
		{
			array_push($rows,$row);
		}
		return $rows;
	}
}

?>