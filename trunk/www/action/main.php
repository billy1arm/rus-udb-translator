<?php
if (IN_MANGOS_RUS)
{
	die('HACK!');
}

if(isset($_GET['id']) && !empty($_GET['id']) && ereg('^[0-9]+$', $_GET['id']))
{
	$table_data = $db->fetch_array("SELECT * FROM `config_db` WHERE `id` = " . $_GET['id']);
	$table_info = $db->fetch_big_array("SELECT * FROM `config_table` WHERE `id_table` =" . $_GET['id']);
	$query_orig = "SELECT SQL_NO_CACHE COUNT(*) AS count FROM `" . $config['dbname_' . $table_data['db']] . "`.`" . $table_data['name_orig'] . "` WHERE ";
	$query_rus = "SELECT SQL_NO_CACHE COUNT(*) AS count FROM `" . $config['dbname_' . $table_data['db'] . '_rus'] . "`.`" . $table_data['name_rus'] . "` WHERE ";
	$count_translate = 0;

	for ($i = 1; $i <= $table_info[0]; $i++)
	{
		$query_translate = "SELECT SQL_NO_CACHE COUNT(*) AS count FROM `" . $config['dbname_' . $table_data['db'] . '_rus'] . "`.`" . $table_data['name_rus'] . "` WHERE ";
		if ($table_info[$i]['custom'] != 0)
		{
			$temp = explode(',', $table_info[$i]['name']);
			$table_info[$i]['row_nonrus_name'] = $temp[0];
			$table_info[$i]['row_rus_name'] = $temp[1];
		}
		else
		{
			if ($table_info[$i]['default'] == 0)
			{
				$table_info[$i]['row_nonrus_name'] = $table_info[$i]['name'] . '_loc1';
			}
			else
			{
				$table_info[$i]['row_nonrus_name'] = $table_info[$i]['name'] . '_default';
			}
			$table_info[$i]['row_rus_name'] = $table_info[$i]['name'] . '_loc8';
		}
		$temp = $db->fetch_array("SHOW COLUMNS FROM `" . $table_data['name_rus'] . "` FROM `" . $config['dbname_' . $table_data['db'] . '_rus'] . "` LIKE '" . $table_info[$i]['row_nonrus_name'] . "'");
		if ($temp['Null'] == 'NO')
		{
			$table_info[$i]['row_nonrus_default'] = " != ''";
		}
		else
		{
			$table_info[$i]['row_nonrus_default'] = ' IS NOT NULL';
		}
		$temp = $db->fetch_array("SHOW COLUMNS FROM `" . $table_data['name_rus'] . "` FROM `" . $config['dbname_' . $table_data['db'] . '_rus'] . "` LIKE '" . $table_info[$i]['row_rus_name'] . "'");
		if ($temp['Null'] == 'NO')
		{
			$table_info[$i]['row_rus_default'] = " = ''";
		}
		else
		{
			$table_info[$i]['row_rus_default'] = ' IS NULL';
		}
		$temp = $db->fetch_array("SHOW COLUMNS FROM `" . $table_data['name_orig'] . "` FROM `" . $config['dbname_' . $table_data['db']] . "` LIKE '" . $table_info[$i]['row_orig_name'] . "'");
		if ($temp['Null'] == 'NO')
		{
			$table_info[$i]['row_orig_default'] = " != ''";
		}
		else
		{
			$table_info[$i]['row_orig_default'] = ' IS NOT NULL';
		}
		$query_orig .= "`" . $table_info[$i]['row_orig_name'] . "`" . $table_info[$i]['row_orig_default'];
		$query_rus .= "`" . $table_info[$i]['row_nonrus_name'] . "`" . $table_info[$i]['row_nonrus_default'];
		$query_translate .= "`" . $table_info[$i]['row_nonrus_name'] . "`" . $table_info[$i]['row_nonrus_default'] . " AND `" . $table_info[$i]['row_rus_name'] . "`" . $table_info[$i]['row_rus_default'];
		if ($i < $table_info[0])
		{
			$query_orig .= " OR ";
			$query_rus .= " OR ";
		}
		$temp_translate = $db->fetch_array($query_translate);
		if($temp_translate['count'] > $count_translate) $count_translate = $temp_translate['count'];
	}
	$count_orig = $db->fetch_array($query_orig);
	$count_rus = $db->fetch_array($query_rus);
	$count_translate = $count_rus['count'] - $count_translate;
	$db->query("UPDATE `config_db` SET `last_recalculate` = CURRENT_TIMESTAMP , `row_rus` = '" . $count_rus['count'] . "', `full_translate` = '" . $count_translate . "', `row_orig` = '" . $count_orig['count'] . "' WHERE `id` = " . $_GET['id']);
}

$tables = $db->fetch_big_array("SELECT * FROM `config_db`");

$array_data = array();
$template_file = 'main.tpl';

$transl[1] = 0;
$transl[2] = 0;
$transl[3] = 0;

foreach ($tables as $id => $array_value)
{
	if(is_array($array_value))
	{
		if ($array_value['row_orig'] == 0) $percent = 100; else $percent = round($array_value['full_translate']/$array_value['row_orig']*100, 2);

		$array_data['ARRAY_TABLES'][$id] = array(
			'ID_TABLES' => $array_value['id'],
			'DESCRIPTION' => $array_value['description'],
			'NAME_ORIG_TABLES' => $array_value['name_orig'],
			'NAME_TABLES' => $array_value['name_rus'],
			'TRANSLATE_ROWS' => $array_value['row_rus'],
			'FULL_TRANSLATE' => $array_value['full_translate'],
			'ALL_ROWS' => $array_value['row_orig'],
			'LAST_RECALCULATE' => $array_value['last_recalculate'],
			'PERCENT_TRANSLATE' => $percent
		);

		$transl[1] = $transl[1] + $array_value['row_rus'];
		$transl[2] = $transl[2] + $array_value['full_translate'];
		$transl[3] = $transl[3] + $array_value['row_orig'];
	}
}

if ($transl[3] == 0) $percent = 100; else $percent = round($transl[2]/$transl[3]*100, 2);

$array_data = array_merge($array_data, array(
	'SITE_URL' => $config['site_url'],
	'TRANSLATE_ROWS' => $transl[1],
	'FULL_TRANSLATE' => $transl[2],
	'ALL_ROWS' => $transl[3],
	'PERCENT_TRANSLATE' => $percent
));

?>