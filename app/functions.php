<?php

function debug($var, $exit=false)
{
	echo("<PRE>");
	print_r($var);
	echo("</PRE>");
	if ($exit) exit;
}

function strip_junk($var)
{
	return preg_replace('/[^a-zA-Z0-9_]/', '', $var);
}
