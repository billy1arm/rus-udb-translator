<?php

class Themes_Work
{
	var $themes_path;
	var $themes_url;

	function Themes_Work($site_url, $site_dir, $theme)
	{
		$this->themes_path = $site_dir . 'themes/' . $theme . '/';
		$this->themes_url = $site_url . 'themes/' . $theme . '/';
	}

	function create_template($file_name, $array_data)
	{
		$content = file_get_contents($this->themes_path . $file_name);
		if (!$content) die ('Error template file!');

		while (list($key, $val) = each($array_data))
		{
			if (is_array($val))
			{
				$start = strpos($content, '<!-- ' . $key . '_BEGIN -->') + strlen('<!-- ' . $key . '_BEGIN -->');
				$length = strpos($content, '<!-- ' . $key . '_END -->') - $start;
				$temp_content = substr($content, $start, $length);
				$block_content = '';

				while (list($array_count, $array_val) = each($val))
				{
					$add_content = $temp_content;
					while (list($block_key, $block_val) = each($array_val))
					{
						if (substr($block_key, 0, 3) == 'IF_')
						{
							if ($block_val == false)
							{
								$add_content = ereg_replace('<!-- ' . $block_key . '_BEGIN -->.*<!-- ' . $block_key . '_END -->', '', $add_content);
							}
							else
							{
								$add_content = str_replace('<!-- ' . $block_key . '_BEGIN -->', '', $add_content);
								$add_content = str_replace('<!-- ' . $block_key . '_END -->', '', $add_content);
							}
						}
						else
						{
							$add_content = str_replace('{' . $block_key . '}', $block_val, $add_content);
						}
					}
					$block_content .= $add_content;
				}
				$content = ereg_replace('<!-- ' . $key . '_BEGIN -->.*<!-- ' . $key . '_END -->', $block_content, $content);
			}
			elseif (substr($key, 0, 3) == 'IF_')
			{
				if ($val == false)
				{
					$content = ereg_replace('<!-- ' . $key . '_BEGIN -->.*<!-- ' . $key . '_END -->', '', $content);
				}
				else
				{
					$content = str_replace('<!-- ' . $key . '_BEGIN -->', '', $content);
					$content = str_replace('<!-- ' . $key . '_END -->', '', $content);
				}
			}
			else
			{
				$content = str_replace('{' . $key . '}', $val, $content);
			}
		}

		$content = str_replace('{THEME_URL}', $this->themes_url, $content);

		if(get_magic_quotes_gpc())
		{
			$content = stripslashes($content);
		}

		return $content;
	}

	function page_header($title = '')
	{
		global $config;

		$array_data['TITLE'] = $config['title'];
		$array_data['THEME_URL'] = $this->themes_url;
		if ($title != '') $array_data['TITLE'] .= ' - ' . $title;

		return $this->create_template('header.tpl', $array_data);
	}

	function page_footer()
	{
		return $this->create_template('footer.tpl', array());
	}
}

$template = new Themes_Work($config['site_url'], $config['site_dir'], $config['theme']);
?>