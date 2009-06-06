<?php
if (IN_MANGOS_RUS)
{
	die('HACK!');
}

/*****************************************************************************
**	Начало редактируемой части настроек										**
*****************************************************************************/

$config['dbhost'] = 'localhost'; // Сервер базы данных (по умолчания: localhost)
$config['dbuser'] = 'mangos'; // Имя пользователя в БД
$config['dbpass'] = 'mangos123dayver'; // Пароль пользователя БД
$config['dbname_mangos'] = 'mangos'; // Имя базы данных
$config['dbname_mangos_rus'] = 'mangos-rus'; // Имя базы данных
$config['dbname_scriptdev2'] = 'scriptdev2'; // Имя базы данных
$config['dbname_scriptdev2_rus'] = 'scriptdev2-rus'; // Имя базы данных

/*****************************************************************************
**	Конец редактируемой части настроек										**
*****************************************************************************/

/*****************************************************************************
**	Начало блока авто-настроек												**
*****************************************************************************/
if ($_SERVER['HTTPS']) $config['site_url'] = 'https://'; else $config['site_url'] = 'http://';
$config['site_url'] .= GetEnv("HTTP_HOST") . $_SERVER['SCRIPT_NAME'];
$config['site_url'] = str_replace('index.php', '', $config['site_url']);
$config['inc_url'] = $config['site_url'] . 'include/';
$config['site_dir'] = str_replace('\\', '/', $_SERVER['SCRIPT_FILENAME']);
$config['site_dir'] = str_replace('index.php', '', $config['site_dir']);
$config['inc_dir'] = $config['site_dir'] . 'include/';
/*****************************************************************************
**	Конец блока авто-настроек												**
*****************************************************************************/
?>