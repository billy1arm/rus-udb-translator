<?php
if (IN_MANGOS_RUS)
{
	die('HACK!');
}

$tables = $db->fetch_big_array("SELECT * FROM `config_db`");

$array_data = array();
$template_file = 'main.tpl';

$transl[1] = 0;
$transl[2] = 0;
$i = 1;

foreach ($tables as $id => $array_value)
{
	if(is_array($array_value))
	{
		$temp_rus = $db->fetch_array('SHOW TABLE STATUS FROM `' . $config['dbname_' . $array_value['db'] . '_rus'] . '` LIKE \'' . $array_value['name_rus'] . '\'');
		$temp_orig = $db->fetch_array('SHOW TABLE STATUS FROM `' . $config['dbname_' . $array_value['db']] . '` LIKE \'' . $array_value['name_orig'] . '\'');

		if ($temp_orig['Rows'] == 0) $percent = 0; else $percent = round($temp_rus['Rows']/$temp_orig['Rows']*100, 2);

		$array_data['ARRAY_TABLES'][$i] = array(
			'NAME_TABLES' => $array_value['name_rus'],
			'TRANSLATE_ROWS' => $temp_rus['Rows'],
			'ALL_ROWS' => $temp_orig['Rows'],
			'PERCENT_TRANSLATE' => $percent
		);

		$transl[1] = $transl[1] + $temp_rus['Rows'];
		$transl[2] = $transl[2] + $temp_orig['Rows'];
		$i++;
	}
}

if ($transl[2] == 0) $percent = 0; else $percent = round($transl[1]/$transl[2]*100, 2);

$array_data = array_merge($array_data, array(
	'TRANSLATE_ROWS' => $transl[1],
	'ALL_ROWS' => $transl[2],
	'PERCENT_TRANSLATE' => $percent
));

?>