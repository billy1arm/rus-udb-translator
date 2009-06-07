<?php
define ('IN_MANGOS_RUS', FALSE);

include_once ('config.php');

include_once ($config['inc_dir'] . 'db.php');
include_once ($config['inc_dir'] . 'common.php');
include_once ($config['inc_dir'] . 'template.php');

if (!isset($_REQUEST['action']) || empty($_REQUEST['action']) || $work->url_check())
{
	$action = 'main';
}
else
{
	$action = $_REQUEST['action'];
	if(!@fopen($config['site_dir'] . 'action/' . $action . '.php', 'r')) $action = 'main';
}

include_once($config['site_dir'] . 'action/' . $action . '.php');

echo $template->page_header() . $template->create_template($template_file, $array_data) . $template->page_footer();

?>