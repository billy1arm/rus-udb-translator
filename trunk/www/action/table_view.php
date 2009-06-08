<?php
if (IN_MANGOS_RUS)
{
	die('HACK!');
}

if(isset($_GET['id']) && !empty($_GET['id']) && ereg('^[0-9]+$', $_GET['id']))
{
	$array_data = array();
	$array_data['SITE_URL'] = $config['site_url'];
	$array_data['SCRIPT_URL'] = $config['site_url'] . '?action=table_view&id=' . $_GET['id'];
	$template_file = 'table_view.tpl';
	
	$table_data = $db->fetch_array("SELECT * FROM `config_db` WHERE `id` = " . $_GET['id']);
	$table_info = $db->fetch_big_array("SELECT * FROM `config_table` WHERE `id_table` =" . $_GET['id']);
	if ($table_data['row_orig'] == 0) $percent = 100; else $percent = round($table_data['full_translate']/$table_data['row_orig']*100, 2);

	$array_data['NAME_TABLES'] = $table_data['name_rus'];
	$array_data['NAME_ORIG_TABLES'] = $table_data['name_orig'];
	$array_data['TRANSLATE_ROWS'] = $table_data['row_rus'];
	$array_data['FULL_TRANSLATE'] = $table_data['full_translate'];
	$array_data['ALL_ROWS'] = $table_data['row_orig'];
	$array_data['LAST_RECALCULATE'] = $table_data['last_recalculate'];
	$array_data['PERCENT_TRANSLATE'] = $percent;
}
else
{
	include_once($config['site_dir'] . 'action/main.php');
}
?>