<?php
if (IN_MANGOS_RUS)
{
	die('HACK!');
}

$work->page_header();

$result = $db->query('SHOW TABLE STATUS FROM `' . $config['dbname_mangos_rus'] . '`');
if ($result)
{
	while($res = mysql_fetch_array($result))
	{
		if ($res['Name'] != 'config')
		{
			$tables['mangos_rus'][$res['Name']] = $res['Rows'];
			$i++;
		}
	}
}
else
{
	die('Error in ' . $config['dbname_mangos_rus']);
}

$result = $db->query('SHOW TABLE STATUS FROM `' . $config['dbname_scriptdev2_rus'] . '`');
if ($result)
{
	while($res = mysql_fetch_array($result))
	{
		$tables['scriptdev2_rus'][$res['Name']] = $res['Rows'];
		$i++;
	}
}
else
{
	die('Error in ' . $config['dbname_scriptdev2_rus']);
}

echo '<div align="center">
	<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><h2>Выбираем таблицу для работы</h2></td>
		</tr>
	</table>
	<table border="1" cellspacing="0" cellpadding="2">
		<tr>
			<td>Наименование таблицы</td>
			<td>Переведено строк</td>
			<td>Всего строк</td>
			<td>% перевода</td>
		</tr>';

$transl[1] = 0;
$transl[2] = 0;

foreach ($tables['mangos_rus'] as $name => $value)
{
	$temp_name = str_replace('locales_', '', $name);
	if ($temp_name == 'creature' || $temp_name == 'gameobject' || $temp_name == 'item' || $temp_name == 'quest') $temp_name .= '_template';
	$temp = $db->fetch_array('SHOW TABLE STATUS FROM `' . $config['dbname_mangos'] . '` LIKE \'' . $temp_name . '\'');
	if ($temp['Rows'] == 0) $percent = 0; else $percent = round($value/$temp['Rows']*100, 2);
	echo '		<tr>
    <td>' . $name . '</td>
    <td>' . $value . '</td>
    <td>' . $temp['Rows'] . '</td>
    <td>' . $percent . '</td>
  </tr>';
	$transl[1] = $transl[1] + $value;
	$transl[2] = $transl[2] + $temp['Rows'];
}
foreach ($tables['scriptdev2_rus'] as $name => $value)
{
	$temp = $db->fetch_array('SHOW TABLE STATUS FROM `' . $config['dbname_scriptdev2'] . '` LIKE \'' . $name . '\'');
	if ($temp['Rows'] == 0) $percent = 0; else $percent = round($value/$temp['Rows']*100, 2);
	echo '		<tr>
    <td>' . $name . '</td>
    <td>' . $value . '</td>
    <td>' . $temp['Rows'] . '</td>
    <td>' . $percent . '</td>
  </tr>';
	$transl[1] = $transl[1] + $value;
	$transl[2] = $transl[2] + $temp['Rows'];
}
if ($transl[2] == 0) $percent = 0; else $percent = round($transl[1]/$transl[2]*100, 2);
echo '		<tr>
    <td><strong>Итого:</strong></td>
    <td><strong>' . $transl[1] . '</strong></td>
    <td><strong>' . $transl[2] . '</strong></td>
    <td><strong>' . $percent . '</strong></td>
  </tr>
</table>';


$work->page_footer();
?>