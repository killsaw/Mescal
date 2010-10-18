<?php

class Database
{
	public $name;
	
	public function __construct($name)
	{
		$this->name = $name;
	}
	
	public function getSQL()
	{
		$row = dibi::fetch("SHOW CREATE DATABASE `{$this->name}`");
		return $row['Create Database'];
	}
	
	public function getTable($table)
	{
		return new Table($table, $this->name);
	}
	
	public function getTables()
	{
		$res = dibi::query("SHOW TABLES IN `{$this->name}`");
		$tables = array();
		
		while($row = $res->fetchSingle()) {			
			$tables[] = $row;
		}
		return $tables;
	}
	
	public static function getAllDatabases()
	{
		$res = dibi::query("SHOW DATABASES");
		$dbs = array();
		while($db = $res->fetchSingle()) {
			$dbs[] = $db;
		}
		return $dbs;
	}
}