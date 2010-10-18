<?php

class TemplateVars {
	public static $vars = array();
	
	public static function set($name, $value) {
		self::$vars[$name] = $value;
	}
	public static function get($name) {
		return self::$vars[$name];
	}
	
	public static function display($name) {
		$value = self::get($name);
		
		if (is_string($value) || is_object($value)) {
			print (string)$value;
		}
		if (is_array($value)) {
			echo("<ul class=\"tv_list\">");
			foreach($value as $k=>$v) {
				printf("<li>%s</li>", $v);
			}
			echo("</ul>");
		}
	}
}
