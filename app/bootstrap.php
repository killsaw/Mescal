<?php

require_once __DIR__.'/vendors/dibi.min.php';
require_once __DIR__.'/../config.php';
require_once __DIR__.'/classes/ConfigSet.php';
require_once __DIR__.'/classes/Analytics.php';
require_once __DIR__.'/classes/ListMenu.php';
require_once __DIR__.'/classes/TemplateVars.php';
require_once __DIR__.'/classes/Database.php';
require_once __DIR__.'/classes/Table.php';
require_once __DIR__.'/functions.php';


if (!dibi::isConnected()) {
	try {
		dibi::connect(array(
			'driver'   => 'mysqli',
			'host'     => DB_HOST,
			'username' => DB_USER,
			'password' => DB_PASS,
			'database' => DB_NAME,
			'charset'  => 'utf8',
		));
	} catch (DibiException $e) {
		die("Error: ".$e->getMessage());
	}
}

session_start();

// Check for a ban.
if (dibi::fetchSingle("SELECT 1 FROM bans WHERE ip=%s", 
		$_SERVER['REMOTE_ADDR'])) {
	die("<h2>YOU ARE BANNED SON</h2>");
}

// Check for IP whitelist
if (dibi::fetchSingle("SELECT 1 FROM whitelist WHERE ip=%s", 
		$_SERVER['REMOTE_ADDR'])) {
	$_SESSION['whitelisted'] = true;
}


$configs = ConfigSet::getInstance();
$analytics = new Analytics;
$analytics->logAccess();
