<?php
if (IN_MANGOS_RUS)
{
	die('HACK!');
}

if ((isset($_GET['db_id']) && !empty($_GET['db_id']) && ereg('^[0-9]+$', $_GET['db_id'])) && (isset($_GET['id']) && !empty($_GET['id']) && ereg('^[-0-9]+$', $_GET['id'])))
{
	//
}
else
{
	include_once($config['site_dir'] . 'action/main.php');
}
?>