<?php
if (IN_MANGOS_RUS)
{
	die('HACK!');
}

if ((isset($_GET['db_id']) && !empty($_GET['db_id']) && ereg('^[0-9]+$', $_GET['db_id'])) && (isset($_GET['id']) && !empty($_GET['id']) && ereg('^[-0-9]+$', $_GET['id'])))
{
	$array_data = array();
	$template_file = 'table_partially.tpl';

	$array_data['SITE_URL'] = $config['site_url'];
	$array_data['TABLE_URL'] = $config['site_url'] . '?action=table_view&subact=partially&id=' . $_GET['db_id'];
	$array_data['SCRIPT_URL'] = $config['site_url'] . '?action=table_partially&db_id=' . $_GET['db_id'] . '&id=' . $_GET['id'];
	$array_data['ID_ROW'] = $_GET['id'];

	$table_data = $db->fetch_array("SELECT * FROM `config_db` WHERE `id` = " . $_GET['db_id']);
	$table_info = $db->fetch_big_array("SELECT * FROM `config_table` WHERE `id_table` =" . $_GET['db_id']);

	$array_data['NAME_TABLES'] = $table_data['name_rus'];
	$array_data['NAME_ORIG_TABLES'] = $table_data['name_orig'];

	$temp = $db->fetch_array("SHOW INDEX FROM `" . $config['dbname_' . $table_data['db']] . "`.`" . $table_data['name_orig'] . "`");
	$index_field_orig = $temp['Column_name'];
	$temp = $db->fetch_array("SHOW INDEX FROM `" . $config['dbname_' . $table_data['db'] . '_rus'] . "`.`" . $table_data['name_rus'] . "`");
	$index_field_rus = $temp['Column_name'];

	$array_data['NAME_ORIG_INDEX'] = $index_field_orig;
	$array_data['NAME_RUS_INDEX'] = $index_field_rus;

	if (!empty($table_data['url_orig']) && !empty($table_data['url_rus']))
	{
		$array_data['IF_WOWHEAD_URL'] = true;
		$array_data['URL_WOWHEAD_ORIG'] = $table_data['url_orig'] . $_GET['id'];
		$array_data['URL_WOWHEAD_RUS'] = $table_data['url_rus'] . $_GET['id'];
	}
	else
	{
		$array_data['IF_WOWHEAD_URL'] = false;
	}

	for ($i = 1; $i <= $table_info[0]; $i++)
	{
		if ($table_info[$i]['custom'] != 0)
		{
			$tmp = explode(',', $table_info[$i]['name']);
			if ($table_info[$i]['default'] == 1)
			{
				$table_info[$i]['row_default_name'] = $tmp[0];
				$table_info[$i]['row_nonrus_name'] = $tmp[1];
				$table_info[$i]['row_rus_name'] = $tmp[2];
				$temp = $db->fetch_array("SHOW COLUMNS FROM `" . $table_data['name_rus'] . "` FROM `" . $config['dbname_' . $table_data['db'] . '_rus'] . "` LIKE '" . $table_info[$i]['row_default_name'] . "'");
				if ($temp['Null'] == 'NO')
				{
					$table_info[$i]['row_default_default'] = "''";
				}
				else
				{
					$table_info[$i]['row_default_default'] = 'NULL';
				}
			}
			else
			{
				$table_info[$i]['row_nonrus_name'] = $tmp[0];
				$table_info[$i]['row_rus_name'] = $tmp[1];
			}
		}
		else
		{
			if ($table_info[$i]['default'] == 1)
			{
				$table_info[$i]['row_default_name'] = $table_info[$i]['name'] . '_default';
				$temp = $db->fetch_array("SHOW COLUMNS FROM `" . $table_data['name_rus'] . "` FROM `" . $config['dbname_' . $table_data['db'] . '_rus'] . "` LIKE '" . $table_info[$i]['row_default_name'] . "'");
				if ($temp['Null'] == 'NO')
				{
					$table_info[$i]['row_default_default'] = "''";
				}
				else
				{
					$table_info[$i]['row_default_default'] = 'NULL';
				}
			}
			$table_info[$i]['row_nonrus_name'] = $table_info[$i]['name'] . '_loc1';
			$table_info[$i]['row_rus_name'] = $table_info[$i]['name'] . '_loc8';
		}
		$temp = $db->fetch_array("SHOW COLUMNS FROM `" . $table_data['name_rus'] . "` FROM `" . $config['dbname_' . $table_data['db'] . '_rus'] . "` LIKE '" . $table_info[$i]['row_nonrus_name'] . "'");
		if ($temp['Null'] == 'NO')
		{
			$table_info[$i]['row_nonrus_default'] = "''";
		}
		else
		{
			$table_info[$i]['row_nonrus_default'] = 'NULL';
		}
		$temp = $db->fetch_array("SHOW COLUMNS FROM `" . $table_data['name_rus'] . "` FROM `" . $config['dbname_' . $table_data['db'] . '_rus'] . "` LIKE '" . $table_info[$i]['row_rus_name'] . "'");
		if ($temp['Null'] == 'NO')
		{
			$table_info[$i]['row_rus_default'] = " ''";
		}
		else
		{
			$table_info[$i]['row_rus_default'] = 'NULL';
		}

		$temp = $db->fetch_array("SELECT `" . $table_info[$i]['row_orig_name'] . "` FROM `" . $config['dbname_' . $table_data['db']] . "`.`" . $table_data['name_orig'] . "` WHERE `" . $index_field_orig . "` = " . $_GET['id']);
		$table_info[$i]['row_orig_data'] = $temp[$table_info[$i]['row_orig_name']];
		$table_info[$i]['row_nonrus_data'] = $temp[$table_info[$i]['row_orig_name']];
		$temp = $db->fetch_array("SELECT `" . $table_info[$i]['row_rus_name'] . "` FROM `" . $config['dbname_' . $table_data['db']. '_rus'] . "`.`" . $table_data['name_rus'] . "` WHERE `" . $index_field_rus . "` = " . $_GET['id']);
		$table_info[$i]['row_rus_data'] = $temp[$table_info[$i]['row_rus_name']];
		if ($table_info[$i]['default'] == 1)
		{
			$table_info[$i]['row_default_data'] = $temp[$table_info[$i]['row_orig_name']];
		}

		$array_data['ARRAY_FIELD'][$i] = array (
			'DESCRIPTION' => $table_info[$i]['description'],
			'NAME_OF_ORIG_FIELD' => $table_info[$i]['row_orig_name'],
			'NAME_OF_RUS_FIELD' => $table_info[$i]['row_rus_name'],
			'TEXT_OF_ORIG' => htmlspecialchars($table_info[$i]['row_orig_data'], ENT_QUOTES),
			'TEXT_OF_RUS' => htmlspecialchars($table_info[$i]['row_rus_data'], ENT_QUOTES)
		);

		if (($table_info[$i]['row_orig_data'] != NULL && $table_info[$i]['row_orig_data'] != '' && ($table_info[$i]['row_rus_data'] == NULL || $table_info[$i]['row_rus_data'] == '')) || (($table_info[$i]['row_orig_data'] == NULL || $table_info[$i]['row_orig_data'] == '') && $table_info[$i]['row_rus_data'] != NULL && $table_info[$i]['row_rus_data'] != ''))
		{
			$array_data['ARRAY_FIELD'][$i]['IF_NOT_TRANSLATED'] = true;
		}
		else
		{
			$array_data['ARRAY_FIELD'][$i]['IF_NOT_TRANSLATED'] = false;
		}
		if (isset($_GET['save']) && $_GET['save'] == 'true' && isset($_POST['change_' . $table_info[$i]['row_rus_name']]) && $_POST['change_' . $table_info[$i]['row_rus_name']] == 'on')
		{
			$array_data['ARRAY_FIELD'][$i]['TEXT_OF_RUS'] = htmlspecialchars($_POST['text_of_' . $table_info[$i]['row_rus_name']], ENT_QUOTES);
			if (($table_info[$i]['row_orig_data'] != NULL && $table_info[$i]['row_orig_data'] != '' && ($_POST['text_of_' . $table_info[$i]['row_rus_name']] == NULL || $_POST['text_of_' . $table_info[$i]['row_rus_name']] == '')) || (($table_info[$i]['row_orig_data'] == NULL || $table_info[$i]['row_orig_data'] == '') && $_POST['text_of_' . $table_info[$i]['row_rus_name']] != NULL && $_POST['text_of_' . $table_info[$i]['row_rus_name']] != ''))
			{
				$array_data['ARRAY_FIELD'][$i]['IF_NOT_TRANSLATED'] = true;
			}
			else
			{
				$array_data['ARRAY_FIELD'][$i]['IF_NOT_TRANSLATED'] = false;
			}
		}
	}

	if (isset($_GET['save']) && $_GET['save'] == 'true')
	{
		for ($i = 1; $i <= $table_info[0]; $i++)
		{
			if (isset($_POST['change_' . $table_info[$i]['row_rus_name']]) && $_POST['change_' . $table_info[$i]['row_rus_name']] == 'on')
			{
				if (set_magic_quotes_runtime)
				{
					$tmp = addslashes($_POST['text_of_' . $table_info[$i]['row_rus_name']]);
				}
				else
				{
					$tmp = $_POST['text_of_' . $table_info[$i]['row_rus_name']];
				}
				$db->query("UPDATE `" . $config['dbname_' . $table_data['db']. '_rus'] . "`.`" . $table_data['name_rus'] . "` SET `" . $table_info[$i]['row_rus_name'] . "` = '" . $tmp . "' WHERE `" . $index_field_rus . "` = " . $_GET['id']);
			}
		}
	}
}
else
{
	include_once($config['site_dir'] . 'action/main.php');
}
?>