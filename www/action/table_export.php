<?php
if (IN_MANGOS_RUS)
{
	die('HACK!');
}

if (isset($_GET['id']) && !empty($_GET['id']) && ereg('^[0-9]+$', $_GET['id']))
{
	$array_data = array();
	$array_data['SITE_URL'] = $config['site_url'];
	$array_data['SCRIPT_URL'] = $config['site_url'] . '?action=table_view&id=' . $_GET['id'];
	$template_file = 'table_export.tpl';

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
	$date_date = date("Y-m-d");
	$date_time = date("H:i:s");

	$big_export = '-- Date: ' . $date_date . '
-- Time: ' . $date_time . '
-- Rev.: ' . $config['rev_rus'] . '

';
	$small_export = '-- Date: ' . $date_date . '
-- Time: ' . $date_time . '
-- Rev.: From ' . $config['rev_orig'] . ' to ' . $config['rev_rus'] . '

';

	$temp = $db->fetch_array("SHOW CREATE TABLE `" . $config['dbname_' . $table_data['db']] . "`.`" . $table_data['name_rus'] . "`");
	$big_export .= 'DROP TABLE IF EXISTS `' . $table_data['name_rus'] . '`;
';
	if (!set_magic_quotes_runtime) $tmp = str_replace("''", "'", $temp['Create Table']); else $tmp = $temp['Create Table'];
	$big_export .= str_replace('CREATE TABLE ', 'CREATE TABLE IF NOT EXISTS ', $tmp) . ';

';
	if ($table_data['name_rus'] == $table_data['name_orig'])
	{
		$big_export = str_replace($table_data['name_rus'], $table_data['name_rus'] . '2', $big_export);
		$big_export .= 'INSERT INTO `' . $table_data['name_rus'] . '2` (';
	}
	else
	{
		$big_export .= 'INSERT INTO `' . $table_data['name_rus'] . '` (';
	}

	$temp = $db->fetch_array("SHOW INDEX FROM `" . $config['dbname_' . $table_data['db']] . "`.`" . $table_data['name_orig'] . "`");
	$index_field_orig = $temp['Column_name'];
	$temp = $db->fetch_array("SHOW INDEX FROM `" . $config['dbname_' . $table_data['db'] . '_rus'] . "`.`" . $table_data['name_rus'] . "`");
	$index_field_rus = $temp['Column_name'];

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
			$table_info[$i]['row_rus_default'] = "''";
		}
		else
		{
			$table_info[$i]['row_rus_default'] = 'NULL';
		}

		$temp = $db->fetch_array("SELECT `" . $table_info[$i]['row_orig_name'] . "` FROM `" . $config['dbname_' . $table_data['db']] . "`.`" . $table_data['name_orig'] . "` WHERE `" . $index_field_orig . "` = " . $_GET['id']);
		$table_info[$i]['row_orig_data'] = $temp[$table_info[$i]['row_orig_name']];
		$table_info[$i]['row_nonrus_data'] = $temp[$table_info[$i]['row_orig_name']];
		if ($table_info[$i]['default'] == 1)
		{
			$table_info[$i]['row_default_data'] = $temp[$table_info[$i]['row_orig_name']];
		}
	}

	$temp = $db->fetch_big_array("SHOW COLUMNS FROM `" . $table_data['name_rus'] . "` FROM `" . $config['dbname_' . $table_data['db']] . "`");
	$tmp = '';
	for ($i = 1; $i <= $temp[0]; $i++)
	{
		$non_field = 0;
		for ($j = 1; $j <= $table_info[0]; $j++)
		{
			if (strpos($temp[$i]['Field'], $table_info[$j]['name']) !== false)
			{
				$non_field++;
			}
		}
		if ($non_field == 0)
		{
			$big_export .= '`' . $temp[$i]['Field'] . '`, ';
			$tmp .= '`' . $temp[$i]['Field'] . '`, ';
		}
	}
	for ($i = 1; $i <= $table_info[0]; $i++)
	{
		if ($table_info[$i]['default'] == 1)
		{
			$big_export .= '`' . $table_info[$i]['row_default_name'] . '`, ';
			if ($table_info[$i]['row_default_name'] == $table_info[$i]['row_orig_name'])
			{
				$tmp .= '`' . $table_info[$i]['row_orig_name'] . '`, ';
			}
			else
			{
				$tmp .= '`' . $table_info[$i]['row_orig_name'] . '` AS `' . $table_info[$i]['row_default_name'] . '`, ';
			}
		}
		$big_export .= '`' . $table_info[$i]['row_nonrus_name'] . '`, `' . $table_info[$i]['row_rus_name'] . '`';
		$tmp .= '`' . $table_info[$i]['row_orig_name'] . '` AS `' . $table_info[$i]['row_nonrus_name'] . '`, `' . $table_info[$i]['row_orig_name'] . '` AS `' . $table_info[$i]['row_rus_name'] . '`';
		if ($i == $table_info[0])
		{
			$big_export .= ') SELECT ';
			$tmp .= ' FROM `' . $table_data['name_orig'] . '`;

';
		}
		else
		{
			$big_export .= ', ';
			$tmp .= ', ';
		}
	}
	$big_export .= $tmp;

	if ($table_data['name_rus'] == $table_data['name_orig'])
	{
		$big_export .= 'DROP TABLE IF EXISTS `' . $table_data['name_rus'] . '`;
RENAME TABLE `' . $table_data['name_rus'] . '2` TO `' . $table_data['name_rus'] . '`;

';
	}

	$temp_update = '';
	if (!set_magic_quotes_runtime) $quotes = "'"; else $quotes = "";
	for ($i = 1; $i <= $table_info[0]; $i++)
	{
		if ($table_info[$i]['default'] == 1)
		{
			$temp_update .= 'UPDATE `' . $table_data['name_rus'] . '` SET `' . $table_info[$i]['row_default_name'] . '` = ';
			if ($table_info[$i]['row_default_default'] == "''")
			{
				$temp_update .=  $quotes . $table_info[$i]['row_default_default'] . ' WHERE `' . $table_info[$i]['row_default_name'] . '` = NULL;
';
			}
			else
			{
				$temp_update .= $table_info[$i]['row_default_default'] . ' WHERE `' . $table_info[$i]['row_default_name'] . "` = " . $quotes . "'';
";
			}
		}
		$temp_update .= 'UPDATE `' . $table_data['name_rus'] . '` SET `' . $table_info[$i]['row_nonrus_name'] . '` = ';
		if ($table_info[$i]['row_nonrus_default'] == "''")
		{
			$temp_update .=  $quotes . $table_info[$i]['row_nonrus_default'] . ' WHERE `' . $table_info[$i]['row_nonrus_name'] . '` = NULL;
';
		}
		else
		{
				$temp_update .= $table_info[$i]['row_nonrus_default'] . ' WHERE `' . $table_info[$i]['row_nonrus_name'] . "` = " . $quotes . "'';
";
		}
		$temp_update .= 'UPDATE `' . $table_data['name_rus'] . '` SET `' . $table_info[$i]['row_rus_name'] . '` = ';
		if ($table_info[$i]['row_rus_default'] == "''")
		{
			$temp_update .=  $quotes . $table_info[$i]['row_rus_default'] . ' WHERE `' . $table_info[$i]['row_rus_name'] . '` = NULL;
';
		}
		else
		{
				$temp_update .= $table_info[$i]['row_rus_default'] . ' WHERE `' . $table_info[$i]['row_rus_name'] . "` = " . $quotes . "'';
";
		}
	}
	$db->query($temp_update);

	$temp = $db->fetch_big_array("SELECT `" . $index_field_rus . "` FROM `" . $config['dbname_' . $table_data['db'] . '_rus'] . "`.`" . $table_data['name_rus'] . "`");
	$big_export_row = 0;

	for ($i = 1; $i <= $temp[0]; $i++)
	{
		$query = 'SELECT `' . $index_field_rus . '`, ';
		for ($j = 1; $j <= $table_info[0]; $j++)
		{
			$query .= '`' . $table_info[$j]['row_rus_name'] . '`';
			if ($j == $table_info[0]) $query .= 'FROM `' . $config['dbname_' . $table_data['db'] . '_rus'] . '`.`' . $table_data['name_rus'] . '` WHERE `' . $index_field_rus . '` = ' . $temp[$i][$index_field_rus]; else $query .= ', ';
		}
		$tmp = $db->fetch_array($query);
		$query = 'UPDATE `' . $table_data['name_rus'] . '` SET ';
		$upd_field = 0;
		for ($j = 1; $j <= $table_info[0]; $j++)
		{
			if ($tmp[$table_info[$j]['row_rus_name']] != '' && $tmp[$table_info[$j]['row_rus_name']] != NULL)
			{
				if ($upd_field > 0) $query .= ', ';
				if (set_magic_quotes_runtime) $tmp[$table_info[$j]['row_rus_name']] = str_replace("''''", "'''", str_replace("'", "''", $tmp[$table_info[$j]['row_rus_name']]));
				$query .= '`' . $table_info[$j]['row_rus_name'] . "` = '" . $tmp[$table_info[$j]['row_rus_name']] . "'";
				$upd_field++;
			}
		}
		if ($upd_field > 0)
		{
			$big_export .= $query . ' WHERE `' . $index_field_rus . '` = ' . $tmp[$index_field_rus] . ';
';
			$big_export_row++;
		}
	}
	if ($big_export_row > 0) $big_export .= '
';
	$big_export .= $temp_update;

	$temp = $db->fetch_big_array("SELECT `" . $index_field_rus . "` FROM `" . $config['dbname_' . $table_data['db'] . '_rus'] . "`.`" . $table_data['name_rus'] . "`");
	$small_export_row = 0;
	for ($i = 1; $i <= $temp[0]; $i++)
	{
		$query_orig = 'SELECT `' . $index_field_rus . '`, ';
		$query_rus = 'SELECT `' . $index_field_rus . '`, ';
		for ($j = 1; $j <= $table_info[0]; $j++)
		{
			$query_orig .= '`' . $table_info[$j]['row_rus_name'] . '`';
			$query_rus .= '`' . $table_info[$j]['row_rus_name'] . '`';
			if ($j == $table_info[0])
			{
				$query_orig .= 'FROM `' . $config['dbname_' . $table_data['db']] . '`.`' . $table_data['name_rus'] . '` WHERE `' . $index_field_rus . '` = ' . $temp[$i][$index_field_rus];
				$query_rus .= 'FROM `' . $config['dbname_' . $table_data['db'] . '_rus'] . '`.`' . $table_data['name_rus'] . '` WHERE `' . $index_field_rus . '` = ' . $temp[$i][$index_field_rus];
			}
			else
			{
				$query_orig .= ', ';
				$query_rus .= ', ';
			}
		}
		$tmp_orig = $db->fetch_array($query_orig);
		$tmp_rus = $db->fetch_array($query_rus);
		$upd_field = 0;

		for ($j=1; $j <= $table_info[0]; $j++)
		{
			if ($tmp_orig[$table_info[$j]['row_rus_name']] != $tmp_rus[$table_info[$j]['row_rus_name']] && $tmp_orig[$table_info[$j]['row_nonrus_name']] != $tmp_rus[$table_info[$j]['row_rus_name']])
			{
				if (set_magic_quotes_runtime) $tmp_rus[$table_info[$j]['row_rus_name']] = str_replace("''''", "'''", str_replace("'", "''", $tmp_rus[$table_info[$j]['row_rus_name']]));
				if ($tmp_rus[$table_info[$j]['row_rus_name']] == '' || $tmp_rus[$table_info[$j]['row_rus_name']] == NULL)
				{
					if ($table_info[$i]['row_rus_default'] == "''")
					{
						$tmp_rus[$table_info[$j]['row_rus_name']] =  $quotes . $table_info[$i]['row_rus_default'];
					}
					else
					{
						$tmp_rus[$table_info[$j]['row_rus_name']] = 'NULL';
					}
				}
				else
				{
					$tmp_rus[$table_info[$j]['row_rus_name']] = "'" . $tmp_rus[$table_info[$j]['row_rus_name']] . "'";
				}
				$small_export .= 'UPDATE `' . $table_data['name_rus'] . '` SET `' . $table_info[$j]['row_rus_name'] . '` = ' . $tmp_rus[$table_info[$j]['row_rus_name']] . ' WHERE `' . $index_field_rus . '` = ' . $tmp_rus[$index_field_rus] . ';
';
				$upd_field++;
			}
		}
		if ($upd_field > 0) $small_export_row++;
	}

	$end_export = '
ALTER TABLE `' . $table_data['name_rus'] . '` ORDER BY `' . $index_field_rus . "`;

CREATE TABLE IF NOT EXISTS `rus_udb_rev` (
  `name` varchar(50) NOT NULL,
  `value` int(11) unsigned NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DELETE FROM `rus_udb_rev` WHERE `name` = '" . $table_data['name_rus'] . "';
INSERT INTO `rus_udb_rev` (`name`, `value`) VALUES ('" . $table_data['name_rus'] . "', '" . $config['rev_rus'] . "');
";

	$big_export .= $end_export;
	$small_export .= '
' . $temp_update . $end_export;

	$filename = $config['site_dir'] . 'rus-udb/' . $table_data['db'] . '_' . $table_data['name_rus'] . '.sql';
	if (file_exists($filename)) unlink($filename);
	$handle = fopen($filename, "w");
	fwrite($handle, $big_export);

	$filename = $config['site_dir'] . 'rus-udb/update/r' . $config['rev_rus'] . '_from_r' . $config['rev_orig'] . '_' . $table_data['db'] . '_' . $table_data['name_rus'] . '.sql';
	if (file_exists($filename)) unlink($filename);
	$handle = fopen($filename, "w");
	fwrite($handle, $small_export);

	$array_data['REV_EXPORT'] = $config['rev_rus'];
	$array_data['BIG_EXPORT'] = $big_export_row;
	$array_data['REV_PREV'] = $config['rev_orig'];
	$array_data['SMALL_EXPORT'] = $small_export_row;
}
else
{
	include_once($config['site_dir'] . 'action/main.php');
}
?>