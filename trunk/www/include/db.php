<?php
if (IN_MANGOS_RUS)
{
	die('HACK!');
}

class db
{
	var $link;
	
	function db($dbhost, $dbuser, $dbpass, $dbname)
	{
		$this->link = @mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connect DB!');
		@mysql_select_db($dbname, $this->link) or die ('Error select DB!');
		@mysql_query("SET CHARSET utf8");
	}
	function query($query)
	{
		$result = @mysql_query($query, $this->link);
		if ($result)
		{
			return $result;
		}
		else
		{
			return false;
		}
	}

	function fetch_array($query)
	{
		$temp = $this->query($query);
		if ($temp)
		{
			$result = @mysql_fetch_assoc($temp);
			if ($result)
			{
				return $result;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	function fetch_big_array($query)
	{
		$temp = $this->query($query);
		if ($temp)
		{
			$i = 0;
			$array_data = array();
			while ($result = @mysql_fetch_assoc($temp))
			{
				$i++;
				$array_data[$i] = $result;
			}
			if ($i != 0)
			{
				$array_data[0] = $i;
				return $array_data;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
}

$db = new db($config['dbhost'], $config['dbuser'], $config['dbpass'], $config['dbname_mangos_rus']);
?>