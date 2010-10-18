<?php

class ConfigSet
{
	protected $vars = array();
	
	public function load()
	{	
		$this->vars = dibi::fetchPairs("SELECT name, value FROM configs");
	}
	
	public function __get($name)
	{
		if (!array_key_exists($name, $this->vars)) {
			return NULL;
		}
		return $this->vars[$name];
	}
	
	public function __set($name, $value)
	{
		if (!array_key_exists($name, $this->vars)) {
			dibi::insert("configs", array('name'=>$name, 'value'=>$value))
					->execute();
			return $this->vars[$name] = $value;
		} else {
			if ($this->vars[$name] == $value) {
				return $value;
			}
			
			dibi::update("configs", array('value'=>$value))
				->where('name=%s', $name)
				->execute();

			return $this->vars[$name] = $value;
		}
	}
	
	public static function getInstance()
	{
		static $instance = null;
		
		if (is_null($instance)) {
			$instance = new ConfigSet;
			$instance->load();
		}
		return $instance;
	}
}

