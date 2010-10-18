<?php

require_once __DIR__.'/app/bootstrap.php';

if (!isset($_GET['action'])) {
	die("No action set.");
}
if (!isset($_GET['db'])) {
	die("No db set.");
}

$action = $_GET['action'];
$active_db = $_GET['db'];
$active_table = false;


if ($action == 'show_menu') {

	$db = new Database($active_db);
	$tables = $db->getTables();
	
	if ($active_table == false) {
		if (isset($tables[0])) {
			$active_table = $tables[0];
		}
	}
	$curr_table = $db->getTable($active_table);
	
	// Build default menu for active_db.
	$lm = new ListMenu;
	$lm->setItems($tables);
	$lm->setColumnMax(3);
	TemplateVars::set('tables', $lm->toString($active_table));
	
	if (count($tables) == 0) {
		die("<em>This database is empty.</em>");
	}

	require_once './app/templates/partials/menu_display.phtml';
	exit;
}