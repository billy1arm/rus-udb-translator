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
	$array_data['ID_TABLES'] = $_GET['id'];
	if ($table_data['row_rus'] == $table_data['row_orig'])
	{
		$array_data['IF_TABLE_NEW'] = false;
	}
	else
	{
		$array_data['IF_TABLE_NEW'] = true;
	}
	if ($table_data['row_rus'] == $table_data['full_translate'])
	{
		$array_data['IF_TABLE_PARTIALLY'] = false;
	}
	else
	{
		$array_data['IF_TABLE_PARTIALLY'] = true;
	}
	if ($table_data['row_rus'] == 0)
	{
		$array_data['IF_TABLE_TRANSLATED'] = false;
	}
	else
	{
		$array_data['IF_TABLE_TRANSLATED'] = true;
	}
	$array_data['IF_TABLE_EXPORT'] = true;

	$array_data['IF_SELECT_NEW'] = false;
	$array_data['IF_SELECT_PARTIALLY'] = false;
	$array_data['IF_SELECT_TRANSLATED'] = false;
	$array_data['IF_BIG_PREV'] = false;
	$array_data['IF_PREV'] = false;
	$array_data['IF_NEXT'] = false;
	$array_data['IF_BIG_NEXT'] = false;
	$array_data['IF_SELECT_SUBACT'] = false;

	if (isset($_GET['subact']) && ($_GET['subact'] == 'new' || $_GET['subact'] == 'partially' || $_GET['subact'] == 'translated'))
	{
		$array_data['IF_SELECT_SUBACT'] = true;
		if ($_GET['subact'] == 'new')
		{
			$array_data['IF_SELECT_NEW'] = true;
			$temp = $db->fetch_array("SHOW INDEX FROM `" . $config['dbname_' . $table_data['db']] . "`.`" . $table_data['name_orig'] . "`");
			$index_field_orig = $temp['Column_name'];
			$temp = $db->fetch_array("SHOW INDEX FROM `" . $config['dbname_' . $table_data['db'] . '_rus'] . "`.`" . $table_data['name_rus'] . "`");
			$index_field_rus = $temp['Column_name'];
			$temp = $db->fetch_big_array("SELECT `" . $index_field_orig . "` AS " . $index_field_rus . " FROM `" . $config['dbname_' . $table_data['db']] . "`.`" . $table_data['name_orig'] . "` WHERE `" . $table_data['name_orig'] . "`.`" . $index_field_orig . "` NOT IN (SELECT `" . $index_field_rus . "` FROM `" . $config['dbname_' . $table_data['db'] . '_rus'] . "`.`" . $table_data['name_rus'] . "`) ORDER BY `" . $config['dbname_' . $table_data['db']] . "`.`" . $table_data['name_orig'] . "`.`" . $index_field_orig . "` ASC;");
			if (!$temp) $array_data['IF_SELECT_SUBACT'] = false;
		}
		elseif ($_GET['subact'] == 'partially')
		{
			$array_data['IF_SELECT_PARTIALLY'] = true;
			$temp = $db->fetch_array("SHOW INDEX FROM `" . $config['dbname_' . $table_data['db'] . '_rus'] . "`.`" . $table_data['name_rus'] . "`");
			$index_field_rus = $temp['Column_name'];
			$temp_query = "SELECT " . $index_field_rus . " FROM `" . $config['dbname_' . $table_data['db'] . '_rus'] . "`.`" . $table_data['name_rus'] . "` WHERE ";
			$temp_table = $db->fetch_big_array("SELECT * FROM `config_table` WHERE `id_table` =" . $_GET['id']);
			for ($i = 1; $i <= $temp_table[0]; $i++)
			{
				if ($temp_table[$i]['custom'] != 0)
				{
					$tmp = explode(',', $temp_table[$i]['name']);
					$temp_table[$i]['row_nonrus_name'] = $tmp[0];
					$temp_table[$i]['row_rus_name'] = $tmp[1];
				}
				else
				{
					if ($temp_table[$i]['default'] == 0)
					{
						$temp_table[$i]['row_nonrus_name'] = $temp_table[$i]['name'] . '_loc1';
					}
					else
					{
						$temp_table[$i]['row_nonrus_name'] = $temp_table[$i]['name'] . '_default';
					}
					$temp_table[$i]['row_rus_name'] = $temp_table[$i]['name'] . '_loc8';
				}
				$temp = $db->fetch_array("SHOW COLUMNS FROM `" . $table_data['name_rus'] . "` FROM `" . $config['dbname_' . $table_data['db'] . '_rus'] . "` LIKE '" . $temp_table[$i]['row_nonrus_name'] . "'");
				if ($temp['Null'] == 'NO')
				{
					$temp_table[$i]['row_nonrus_default'] = " != ''";
				}
				else
				{
					$temp_table[$i]['row_nonrus_default'] = ' IS NOT NULL';
				}
				$temp = $db->fetch_array("SHOW COLUMNS FROM `" . $table_data['name_rus'] . "` FROM `" . $config['dbname_' . $table_data['db'] . '_rus'] . "` LIKE '" . $temp_table[$i]['row_rus_name'] . "'");
				if ($temp['Null'] == 'NO')
				{
					$temp_table[$i]['row_rus_default'] = " = ''";
				}
				else
				{
					$temp_table[$i]['row_rus_default'] = ' IS NULL';
				}
				$temp_query .= "(`" . $temp_table[$i]['row_nonrus_name'] . "`" . $temp_table[$i]['row_nonrus_default'] . " AND `" . $temp_table[$i]['row_rus_name'] . "`" . $temp_table[$i]['row_rus_default'] . ")";
				if ($i != $temp_table[0]) $temp_query .= " OR "; else $temp_query .= ";";
			}
			$temp = $db->fetch_big_array($temp_query);
			if (!$temp)
			{
				$array_data['IF_SELECT_SUBACT'] = false;
			}
			else
			{
				$tmp = $db->fetch_array("SELECT `row_orig`, `row_rus` FROM `config_db` WHERE `id` = " . $_GET['id']);
				$db->query("UPDATE `config_db` SET `last_recalculate` = CURRENT_TIMESTAMP , `full_translate` = '" . $tmp['row_orig'] - $temp[0] . "' WHERE `id` = " . $_GET['id']);
				if (($tmp['row_orig'] - $temp[0]) > $tmp['row_rus']) $db->query("UPDATE `config_db` SET `last_recalculate` = CURRENT_TIMESTAMP , `row_rus` = '" . $tmp['row_orig'] -  $temp[0] . "' WHERE `id` = " . $_GET['id']);
			}
		}
		elseif ($_GET['subact'] == 'translated')
		{
			$array_data['IF_SELECT_TRANSLATED'] = true;
			$temp = $db->fetch_array("SHOW INDEX FROM `" . $config['dbname_' . $table_data['db'] . '_rus'] . "`.`" . $table_data['name_rus'] . "`");
			$index_field_rus = $temp['Column_name'];
			$temp_query = "SELECT " . $index_field_rus . " FROM `" . $config['dbname_' . $table_data['db'] . '_rus'] . "`.`" . $table_data['name_rus'] . "` WHERE ";
			$temp_table = $db->fetch_big_array("SELECT * FROM `config_table` WHERE `id_table` =" . $_GET['id']);
			for ($i = 1; $i <= $temp_table[0]; $i++)
			{
				if ($temp_table[$i]['custom'] != 0)
				{
					$tmp = explode(',', $temp_table[$i]['name']);
					$temp_table[$i]['row_nonrus_name'] = $tmp[0];
					$temp_table[$i]['row_rus_name'] = $tmp[1];
				}
				else
				{
					if ($temp_table[$i]['default'] == 0)
					{
						$temp_table[$i]['row_nonrus_name'] = $temp_table[$i]['name'] . '_loc1';
					}
					else
					{
						$temp_table[$i]['row_nonrus_name'] = $temp_table[$i]['name'] . '_default';
					}
					$temp_table[$i]['row_rus_name'] = $temp_table[$i]['name'] . '_loc8';
				}
				$temp = $db->fetch_array("SHOW COLUMNS FROM `" . $table_data['name_rus'] . "` FROM `" . $config['dbname_' . $table_data['db'] . '_rus'] . "` LIKE '" . $temp_table[$i]['row_nonrus_name'] . "'");
				if ($temp['Null'] == 'NO')
				{
					$temp_table[$i]['row_nonrus_default'] = " != ''";
				}
				else
				{
					$temp_table[$i]['row_nonrus_default'] = ' IS NOT NULL';
				}
				$temp = $db->fetch_array("SHOW COLUMNS FROM `" . $table_data['name_rus'] . "` FROM `" . $config['dbname_' . $table_data['db'] . '_rus'] . "` LIKE '" . $temp_table[$i]['row_rus_name'] . "'");
				if ($temp['Null'] == 'NO')
				{
					$temp_table[$i]['row_rus_default'] = " = ''";
				}
				else
				{
					$temp_table[$i]['row_rus_default'] = ' IS NULL';
				}
				$temp_query .= "(`" . $temp_table[$i]['row_nonrus_name'] . "`" . $temp_table[$i]['row_nonrus_default'] . " AND `" . $temp_table[$i]['row_rus_name'] . "`" . $temp_table[$i]['row_rus_default'] . ")";
				if ($i != $temp_table[0]) $temp_query .= " OR ";
			}
			$temp = $db->fetch_big_array("SELECT `" . $index_field_rus . "` FROM `" . $config['dbname_' . $table_data['db'] . '_rus'] . "`.`" . $table_data['name_rus'] . "` WHERE `" . $table_data['name_rus'] . "`.`" . $index_field_rus . "` NOT IN (" . $temp_query . ") ORDER BY `" . $config['dbname_' . $table_data['db'] . '_rus'] . "`.`" . $table_data['name_rus'] . "`.`" . $index_field_rus . "` ASC;");
			if (!$temp)
			{
				$array_data['IF_SELECT_SUBACT'] = false;
			}
			else
			{
				$tmp = $db->fetch_array("SELECT `row_rus` FROM `config_db` WHERE `id` = " . $_GET['id']);
				$db->query("UPDATE `config_db` SET `last_recalculate` = CURRENT_TIMESTAMP , `full_translate` = '" . $temp[0] . "' WHERE `id` = " . $_GET['id']);
				if ($temp[0] > $tmp['row_rus']) $db->query("UPDATE `config_db` SET `last_recalculate` = CURRENT_TIMESTAMP , `row_rus` = '" . $temp[0] . "' WHERE `id` = " . $_GET['id']);
			}
		}
		else
		{
			$array_data['IF_SELECT_SUBACT'] = false;
		}
		$array_data['ALL_ROW'] = $temp[0];
		if(isset($_GET['start']) && !empty($_GET['start']) && ereg('^[0-9]+$', $_GET['start']) && $_GET['start'] <= $array_data['ALL_ROW'] && $_GET['start'] != 0)
		{
			$start_row = $_GET['start'];
		}
		else
		{
			$start_row = 1;
		}
		if (($temp[0] - $start_row) > 20)
		{
			$end_row = $start_row + 19;
		}
		else
		{
			$end_row = $temp[0];
		}
		$array_data['SHOW_ROW'] = $end_row - $start_row + 1;
		$all_page = ceil($temp[0]/20);
		$cur_page = ceil($end_row/20);
		if ($all_page > 9)
		{
			$start_page = $cur_page - 4;
			if ($start_page < 1) $start_page = 1;
			$end_page = $start_page + 8;
			if ($end_page > $all_page)
			{
				$end_page = $all_page;
				$start_page = $end_page - 8;
			}
			if ($start_page > 1)
			{
				$array_data['IF_BIG_PREV'] = true;
				$big_prev_page = ($cur_page - 10) * 20 + 1;
				if ($big_prev_page < 1) $big_prev_page = 1;
				$array_data['URL_BIG_PREV'] = '?action=table_view&subact=' . $_GET['subact'] . '&start=' . $big_prev_page . '&id=' . $_GET['id'];
			}
			if ($cur_page > 1)
			{
				$array_data['IF_PREV'] = true;
				$prev_page = ($cur_page - 2) * 20 + 1;
				if ($prev_page < 1) $prev_page = 1;
				$array_data['URL_PREV'] = '?action=table_view&subact=' . $_GET['subact'] . '&start=' . $prev_page . '&id=' . $_GET['id'];
			}
			if ($cur_page < $all_page)
			{
				$array_data['IF_NEXT'] = true;
				$next_page = $cur_page * 20 + 1;
				if ($next_page > $temp[0]) $next_page = $temp[0];
				$array_data['URL_NEXT'] = '?action=table_view&subact=' . $_GET['subact'] . '&start=' . $next_page . '&id=' . $_GET['id'];
			}
			if ($end_page < $all_page)
			{
				$array_data['IF_BIG_NEXT'] = true;
				$big_next_page = ($cur_page + 8) * 20 + 1;
				if ($big_next_page > $temp[0]) $big_next_page = $temp[0];
				$array_data['URL_BIG_NEXT'] = '?action=table_view&subact=' . $_GET['subact'] . '&start=' . $big_next_page . '&id=' . $_GET['id'];
			}
		}
		else
		{
			$start_page = 1;
			$end_page = $all_page;
		}

		for ($i=$start_page;$i<=$end_page;$i++)
		{
			$array_data['ARRAY_PAGE'][$i]['NUM_PAGE'] = $i;
			$url_page = ($i - 1) * 20 + 1;
			if ($url_page < 1) $url_page = 1;
			if ($url_page > $temp[0]) $url_page = $temp[0];
			$array_data['ARRAY_PAGE'][$i]['URL_PAGE'] = '?action=table_view&subact=' . $_GET['subact'] . '&start=' . $url_page . '&id=' . $_GET['id'];
			if ($i == $cur_page)
			{
				$array_data['ARRAY_PAGE'][$i]['IF_NOT_CUR_PAGE1'] = false;
				$array_data['ARRAY_PAGE'][$i]['IF_NOT_CUR_PAGE2'] = false;
			}
			else
			{
				$array_data['ARRAY_PAGE'][$i]['IF_NOT_CUR_PAGE1'] = true;
				$array_data['ARRAY_PAGE'][$i]['IF_NOT_CUR_PAGE2'] = true;
			}
		}

		if (!empty($table_data['url_orig']) && !empty($table_data['url_rus']))
		{
			$array_data['IF_WOWHEAD_URL'] = true;
		}
		else
		{
			$array_data['IF_WOWHEAD_URL'] = false;
		}
		$array_data['INDEX_FIELD'] = $index_field_rus;

		for ($i=$start_row; $i<=$end_row; $i++)
		{
			$array_data['ARRAY_ROW'][$i]['DB_ID'] = $_GET['id'];
			$array_data['ARRAY_ROW'][$i]['ID_ROW'] = $temp[$i][$index_field_rus];
			$array_data['ARRAY_ROW'][$i]['SUBACTION'] = $_GET['subact'];
			if (!empty($table_data['url_orig']) && !empty($table_data['url_rus']))
			{
				$array_data['ARRAY_ROW'][$i]['IF_WOWHEAD_URL_ROW'] = true;
				$array_data['ARRAY_ROW'][$i]['URL_WOWHEAD_ORIG'] = $table_data['url_orig'] . $temp[$i][$index_field_rus];
				$array_data['ARRAY_ROW'][$i]['URL_WOWHEAD_RUS'] = $table_data['url_rus'] . $temp[$i][$index_field_rus];
			}
			else
			{
				$array_data['ARRAY_ROW'][$i]['IF_WOWHEAD_URL_ROW'] = false;
			}
		}
	}
}
else
{
	include_once($config['site_dir'] . 'action/main.php');
}
?>