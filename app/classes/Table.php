<?php

class Table
{
	public $name;
	public $db;
	
	public function __construct($name, $db)
	{
		$this->name = $name;
		$this->db = $db;
	}
	
	public function getSQL()
	{
		$row = dibi::fetch("SHOW CREATE TABLE `{$this->db}`.`{$this->name}`");
		return $row['Create Table'];
	}
	
	public function getFields($return_res=false)
	{
		$result = dibi::query("DESCRIBE `{$this->db}`.`{$this->name}`");
		
		if ($return_res) {
			return $result;
		} else {
			return $result->fetchAll();
		}
	}
	
	public function getRows($offset=0, $limit=10, $return_res=false)
	{
		$result = dibi::query("SELECT * FROM `{$this->db}`.`{$this->name}`
							  LIMIT {$offset}, {$limit}");
		
		if ($return_res) {
			return $result;
		} else {
			return $result->fetchAll();
		}
	}
}