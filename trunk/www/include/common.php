<?php
if (IN_MANGOS_RUS)
{
	die('HACK!');
}

class work
{
	var $conf = array();
	
	function work()
	{
		global $db, $config;
		
		$this->conf = $config;
		$result = $db->query("SELECT * FROM `config`");
		if ($result)
		{
			while($res = mysql_fetch_array($result))
			{
				$this->conf[$res['name']] = $res['value'];
			}
		}
		else
		{
			die('Невозможно получить настройки');
		}
		$config = $this->conf;
	}
	function url_check()
	{
		$array_rules = array('http_', '_server', 'delete%20', 'delete ', 'delete-', 'delete(', '(delete',  'drop%20', 'drop ', 'create%20', 'update-', 'update(', '(update', 'insert-', 'insert(', '(insert', 'create ', 'create(', 'create-', '(create', 'update%20', 'update ', 'insert%20', 'insert ', 'select%20', 'select ', 'bulk%20', 'bulk ', 'union%20', 'union ', 'select-', 'select(', '(select', 'union-', '(union', 'union(', 'or%20', 'or ', 'and%20', 'and ', 'exec', '@@', '%22', '"', 'openquery', 'openrowset', 'msdasql', 'sqloledb', 'sysobjects', 'syscolums',  'syslogins', 'sysxlogins', 'char%20', 'char ', 'into%20', 'into ', 'load%20', 'load ', 'msys', 'alert%20', 'alert ', 'eval%20', 'eval ', 'onkeyup', 'x5cx', 'fromcharcode', 'javascript:', 'javascript.', 'vbscript:', 'vbscript.', 'http-equiv', '->', 'expression%20', 'expression ', 'url%20', 'url ', 'innerhtml', 'document.', 'dynsrc', 'jsessionid', 'style%20', 'style ', 'phpsessid', '<applet', '<div', '<emded', '<iframe', '<img', '<meta', '<object', '<script', '<textarea', 'onabort', 'onblur', 'onchange', 'onclick', 'ondblclick', 'ondragdrop', 'onerror',  'onfocus', 'onkeydown', 'onkeypress', 'onload', 'onmouse', 'onmove', 'onreset', 'onresize', 'onselect', 'onsubmit', 'onunload', 'onreadystatechange', 'xmlhttp', 'uname%20', 'uname ',  '%2C', 'union+', 'select+', 'delete+', 'create+', 'bulk+', 'or+', 'and+', 'into+', 'kill+', '+echr', '+chr', 'cmd+', '+1', 'user_password', 'id%20', 'id ', 'ls%20', 'ls ', 'cat%20', 'cat ', 'rm%20', 'rm ', 'kill%20', 'kill ', 'mail%20', 'mail ', 'wget%20', 'wget ', 'wget(', 'pwd%20', 'pwd ', 'objectclass', 'objectcategory', '<!-%20', '<!- ', 'total%20', 'total ', 'http%20request', 'http request', 'phpb8b4f2a0', 'phpinfo', 'php:', 'globals', '%2527', '%27', '\'', 'chr(', 'chr=', 'chr%20', 'chr ', '%20chr', ' chr', 'cmd=', 'cmd%20', 'cmd', '%20cmd', ' cmd', 'rush=', '%20rush', ' rush', 'rush%20', 'rush ', 'union%20', 'union ', '%20union', ' union', 'union(', 'union=', '%20echr', ' echr', 'esystem', 'cp%20', 'cp ', 'cp(', '%20cp', ' cp', 'mdir%20', 'mdir ', '%20mdir', ' mdir', 'mdir(', 'mcd%20', 'mcd ', 'mrd%20', 'mrd ', 'rm%20', 'rm ', '%20mcd', ' mcd', '%20mrd', ' mrd', '%20rm', ' rm', 'mcd(', 'mrd(', 'rm(', 'mcd=', 'mrd=', 'mv%20', 'mv ', 'rmdir%20', 'rmdir ', 'mv(', 'rmdir(', 'chmod(', 'chmod%20', 'chmod ', 'cc%20', 'cc ', '%20chmod', ' chmod', 'chmod(', 'chmod=', 'chown%20', 'chown ', 'chgrp%20', 'chgrp ', 'chown(', 'chgrp(', 'locate%20', 'locate ', 'grep%20', 'grep ', 'locate(', 'grep(', 'diff%20', 'diff ', 'kill%20', 'kill ', 'kill(', 'killall', 'passwd%20', 'passwd ', '%20passwd', ' passwd', 'passwd(', 'telnet%20', 'telnet ', 'vi(', 'vi%20', 'vi ', 'nigga(', '%20nigga', ' nigga', 'nigga%20', 'nigga ', 'fopen', 'fwrite', '%20like', ' like', 'like%20', 'like ', '$_', '$get', '.system', 'http_php', '%20getenv', ' getenv', 'getenv%20', 'getenv ', 'new_password', '/password', 'etc/', '/groups', '/gshadow', 'http_user_agent', 'http_host', 'bin/', 'wget%20', 'wget ', 'uname%5c', 'uname', 'usr', '/chgrp', '=chown', 'usr/bin', 'g%5c', 'g\\', 'bin/python', 'bin/tclsh', 'bin/nasm', 'perl%20', 'perl ', '.pl', 'traceroute%20', 'traceroute ', 'tracert%20', 'tracert ', 'ping%20', 'ping ', '/usr/x11r6/bin/xterm', 'lsof%20', 'lsof ', '/mail', '.conf', 'motd%20', 'motd ', 'http/1.', '.inc.php', 'config.php', 'cgi-', '.eml', 'file%5c://', 'file\:', 'file://', 'window.open', 'img src', 'img%20src', 'img src', '.jsp', 'ftp.', 'xp_enumdsn', 'xp_availablemedia', 'xp_filelist', 'nc.exe', '.htpasswd', 'servlet', '/etc/passwd', '/etc/shadow', 'wwwacl', '~root', '~ftp', '.js', '.jsp', '.history', 'bash_history', '~nobody', 'server-info', 'server-status', '%20reboot', ' reboot', '%20halt', ' halt', '%20powerdown', ' powerdown', '/home/ftp', '=reboot', 'www/', 'init%20', 'init ','=halt', '=powerdown', 'ereg(', 'secure_site', 'chunked', 'org.apache', '/servlet/con', '/robot', 'mod_gzip_status', '.inc', '.system', 'getenv', 'http_', '_php', 'php_', 'phpinfo()', '<?php', '?>', '%3C%3Fphp', '%3F>', 'sql=', '_global', 'global_', 'global[', '_server', 'server_', 'server[', '/modules', 'modules/', 'phpadmin', 'root_path', '_globals', 'globals_', 'globals[', 'iso-8859-1', '?hl=', '%3fhl=', '.exe', '.sh', '%00', rawurldecode('%00'), '_env', '/*', '\\*');

		$query_string = strtolower($_SERVER['QUERY_STRING']);

		$hack = false;

		foreach($array_rules as $rules)
		{
			if (@ereg(quotemeta($rules), $query_string))
			{
				$_SERVER['QUERY_STRING'] = '';
				$hack = true;
			}
		}
		return $hack;
	}
	
	function page_header()
	{
		global $config;

		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>' . $config['title'] . '</title>
</head>
<body>';
	}

	function page_footer()
	{
		echo '</body>
</html>';
	}
}

$work = new work();
?>