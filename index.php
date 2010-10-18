<?php

require_once __DIR__.'/app/bootstrap.php';

$active_db = DEFAULT_DATABASE;
$active_table = false;

if (isset($_GET['db'])) {
	$active_db = strip_junk($_GET['db']);
}
if (isset($_GET['table'])) {
	$active_table = strip_junk($_GET['table']);
}

$db = new Database($active_db);
$tables = $db->getTables();

if ($active_table == false) {
	$active_table = $tables[0];
}
$curr_table = $db->getTable($active_table);

// Build default menu for active_db.
$lm = new ListMenu;
$lm->setItems($tables);
$lm->setColumnMax(3);
TemplateVars::set('tables', $lm->toString($active_table));

// Grab database listing
TemplateVars::set('dbs', Database::getAllDatabases());
TemplateVars::set('active_db', $active_db);

require_once './app/templates/header.phtml';

$data = $curr_table->getRows(0, 10, $return_res=true);

TemplateVars::set('table', $active_table);
TemplateVars::set('schema', $curr_table->getFields($return_res=true));
TemplateVars::set('schema_sql', $curr_table->getSQL());
TemplateVars::set('table_data', $data);

require_once './app/templates/show_table.phtml';
require_once './app/templates/footer.phtml';