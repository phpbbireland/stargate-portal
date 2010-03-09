<?php
/**
*
* @package Stargate Portal
* @author  Martin - aka NeXur
* @begin   24 November 2008
* @copyright (c) 2008 NeXur
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: sgp_refresh.php 315 2009-01-10 05:43:06Z nexur $
* Updated: SGP Refres ALL
* A rework of Stu's remove calendar mod by Martin (NeXur)
* Last modified: 25 November 2008 by NeXur
*/

/**
* @ignore
*/
define('IN_PHPBB', true);

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/acp/acp_modules.' . $phpEx);
include_once($phpbb_root_path . "includes/acm/acm_file.$phpEx");
include_once($phpbb_root_path . "includes/functions_admin.$phpEx");
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

// Report all errors, except notices
error_reporting(E_ALL ^ E_NOTICE);

$user->session_begin();
$auth->acl($user->data);
$user->setup('common');
$user->setup('acp/styles');

//$user->add_lang('portal/portal');
include_once($phpbb_root_path . 'includes/sgp_functions.'. $phpEx );
include_once($phpbb_root_path . 'includes/portal_blocks.' . $phpEx);

global $db, $lang, $template, $phpbb_root_path, $phpEx, $cache, $config, $language, $table_prefix;
$current_version = '1.0.0';
$page_title = 'SGP Refresh ALL - version: ' . $current_version;
$no_exeptions = true;

// Output page
page_header($page_title);

$template->set_filenames(array(
	'body' => 'sgp_refresh.html')
);

if( $user->data['is_registered'] && $auth->acl_get('a_') ) 	 
{
	$template->assign_vars(array(
		'S_IS_ADMIN' => true,
	));
	
	//Refresh all styles templates
	$sql = 'SELECT *
		FROM ' . STYLES_TEMPLATE_TABLE . "
		WHERE template_id > 0";
	$result = $db->sql_query($sql);

	if (!$result)
	{
		$template->assign_block_vars('template_row', array(
			'S_SGPRA_TEMPLATE' => false,
			'SGPRA_TEMPLATE_ERROR' => $user->lang['NO_INFO_FOUND'] . STYLES_TEMPLATE_TABLE . $user->lang['DATABASE_TABLE'],
		));
		$no_exeptions = false;
	}
	
	while($template_row = $db->sql_fetchrow($result))
	{
		$template_refreshed = '';

		// Only refresh database if the template is stored in the database
		if ($template_row['template_storedb'] && file_exists("{$phpbb_root_path}styles/{$template_row['template_path']}/template/"))
		{
			$filelist = array('' => array());

			$sql2 = 'SELECT template_filename, template_mtime
				FROM ' . STYLES_TEMPLATE_DATA_TABLE . "
				WHERE template_id = " . $template_row['template_id'];
			$result2 = $db->sql_query($sql2);
			if (!$result2)
			{
				$template->assign_block_vars('template_row', array(
					'S_SGPRA_TEMPLATE' => true,
					'S_SGPRA_TEMPLATE_DATA' => false,
					'SGPRA_TEMPLATE_DATA_ERROR' => $user->lang['NO_INFO_FOUND'] . STYLES_TEMPLATE_DATA_TABLE . $user->lang['DATABASE_TABLE'],
				));
				$no_exeptions = false;
			}
			while ($row = $db->sql_fetchrow($result2))
			{

					// get folder info from the filename
					if (($slash_pos = strrpos($row['template_filename'], '/')) === false)
					{
						$filelist[''][] = $row['template_filename'];
					}
					else
					{
						$filelist[substr($row['template_filename'], 0, $slash_pos + 1)][] = substr($row['template_filename'], $slash_pos + 1, strlen($row['template_filename']) - $slash_pos - 1);
					}

			}
			$db->sql_freeresult($result2);

			store_templates('update', $style_id, $template_row['template_path'], $filelist);
			unset($filelist);

			$template_refreshed = $user->lang['TEMPLATE_REFRESHED'] . '<br />';
			add_log('admin', 'LOG_TEMPLATE_REFRESHED', $template_row['template_name']);
		}

		clear_template_cache($template_row);
		
		$template->assign_block_vars('template_row', array(
			'S_SGPRA_TEMPLATE' => true,
			'SGRA_TEMPLATE_REFRESHED' => "<br /> &nbsp;  &#187; &nbsp; " . $template_row['template_name'] . $user->lang['REFRESHED'],
		));
	}
	$db->sql_freeresult($result);
	
	//Refresh all styles themes
	$sql = 'SELECT *
		FROM ' . STYLES_THEME_TABLE . "
		WHERE theme_id > 0";
	$result = $db->sql_query($sql);

	if (!$result)
	{
		$template->assign_block_vars('theme_row', array(
			'S_SGPRA_THEME' => false,
			'SGPRA_THEME_ERROR' => $user->lang['NO_INFO_FOUND'] . STYLES_THEME_TABLE . $user->lang['DATABASE_TABLE'],
		));
		$no_exeptions = false;
	}
	while($theme_row = $db->sql_fetchrow($result))
	{
		if (!$theme_row['theme_storedb'])
		{
			$template->assign_block_vars('theme_row', array(
				'S_SGPRA_THEME' => true,
				'S_SGPRA_THEME_TABLE' => true,
				'SGRA_THEME_REFRESHED' => "<br /> &nbsp;  &#187; &nbsp; " . $theme_row['theme_name'] . " - " . $user->lang['THEME_ERR_REFRESH_FS'],
			));
			continue;
		}

		if ($theme_row['theme_storedb'] && file_exists("{$phpbb_root_path}styles/{$theme_row['theme_path']}/theme/stylesheet.css"))
		{
			// Save CSS contents
			$sql_ary = array(
				'theme_mtime'	=> (int) filemtime("{$phpbb_root_path}styles/{$theme_row['theme_path']}/theme/stylesheet.css"),
				'theme_data'	=> db_theme_data($theme_row)
			);

			$sql2 = 'UPDATE ' . STYLES_THEME_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . "
				WHERE theme_id = " . $theme_row['theme_id'];
			$result2 = $db->sql_query($sql2);
			if (!$result2)
			{
				$template->assign_block_vars('theme_row', array(
					'S_SGPRA_THEME' => true,
					'S_SGPRA_THEME_TABLE' => false,
					'SGPRA_THEME_TABLE_ERROR' => $user->lang['FAILED_UPDATE'] . STYLES_THEME_TABLE . $user->lang['DATABASE_TABLE'],
				));
				$no_exeptions = false;
			}
			
			$cache->destroy('sql', STYLES_THEME_TABLE);

			add_log('admin', 'LOG_THEME_REFRESHED', $theme_row['theme_name']);
			
			$template->assign_block_vars('theme_row', array(
				'S_SGPRA_THEME' => true,
				'SGRA_THEME_REFRESHED' => "<br /> &nbsp;  &#187; &nbsp; " . $theme_row['theme_name'] . $user->lang['REFRESHED'],
			));

			$db->sql_freeresult($result2);
		}
	}
	$db->sql_freeresult($result);
/* Disabled for the time being
	//Refresh all styles imagesets
	$sql = 'SELECT *
		FROM ' . STYLES_IMAGESET_TABLE . "
		WHERE imageset_id > 0";
	$result = $db->sql_query($sql);

	if (!$result)
	{
		$template->assign_block_vars('imageset_row', array(
			'S_SGPRA_IMAGESET' => false,
			'SGPRA_IMAGESET_ERROR' => $user->lang['NO_INFO_FOUND'] . STYLES_IMAGESET_TABLE . $user->lang['DATABASE_TABLE'],
		));
		$no_exeptions = false;
	}
	
	$imageset_keys = array(
			'logos' => array(
				'site_logo',
			),
			'buttons'	=> array(
				'icon_back_top', 'icon_contact_aim', 'icon_contact_email', 'icon_contact_icq', 'icon_contact_jabber', 'icon_contact_msnm', 'icon_contact_pm', 'icon_contact_yahoo', 'icon_contact_www', 'icon_post_delete', 'icon_post_edit', 'icon_post_info', 'icon_post_quote', 'icon_post_report', 'icon_user_online', 'icon_user_offline', 'icon_user_profile', 'icon_user_search', 'icon_user_warn', 'button_pm_forward', 'button_pm_new', 'button_pm_reply', 'button_topic_locked', 'button_topic_new', 'button_topic_reply', 'button_topic_qreply', 'button_topic_qreply_no',
			),
			'icons'		=> array(
				'icon_post_target', 'icon_post_target_unread', 'icon_topic_attach', 'icon_topic_latest', 'icon_topic_newest', 'icon_topic_reported', 'icon_topic_unapproved', 'icon_friend', 'icon_foe',
			),
			'forums'	=> array(
				'forum_link', 'forum_read', 'forum_read_locked', 'forum_read_subforum', 'forum_unread', 'forum_unread_locked', 'forum_unread_subforum', 'subforum_read', 'subforum_unread'
			),
			'folders'	=> array(
				'topic_moved', 'topic_read', 'topic_read_mine', 'topic_read_hot', 'topic_read_hot_mine', 'topic_read_locked', 'topic_read_locked_mine', 'topic_unread', 'topic_unread_mine', 'topic_unread_hot', 'topic_unread_hot_mine', 'topic_unread_locked', 'topic_unread_locked_mine', 'sticky_read', 'sticky_read_mine', 'sticky_read_locked', 'sticky_read_locked_mine', 'sticky_unread', 'sticky_unread_mine', 'sticky_unread_locked', 'sticky_unread_locked_mine', 'announce_read', 'announce_read_mine', 'announce_read_locked', 'announce_read_locked_mine', 'announce_unread', 'announce_unread_mine', 'announce_unread_locked', 'announce_unread_locked_mine', 'global_read', 'global_read_mine', 'global_read_locked', 'global_read_locked_mine', 'global_unread', 'global_unread_mine', 'global_unread_locked', 'global_unread_locked_mine', 'pm_read', 'pm_unread', 'news_read', 'news_unread', 'news_read_mine', 'news_unread_mine', 'news_unread_locked', 'news_unread_locked_mine',
			),
			'polls'		=> array(
				'poll_left', 'poll_center', 'poll_right',
			),
			'ui'		=> array(
				'upload_bar',
			),
			'user'		=> array(
				'user_icon1', 'user_icon2', 'user_icon3', 'user_icon4', 'user_icon5', 'user_icon6', 'user_icon7', 'user_icon8', 'user_icon9', 'user_icon10',
			),
	);

	//Cleaning out old styles_imageset_data table (temporarly fix before auto_increment is fixed by phpBB3 team)
	$sql2 = 'TRUNCATE  ' . STYLES_IMAGESET_DATA_TABLE;
	$result2 = $db->sql_query($sql2);

	if (!$result2)
	{
		$template->assign_block_vars('imageset_row', array(
			'S_SGPRA_IMAGESET' => true,
			'S_SGPRA_IMAGESET_DATA' => false,
			'SGPRA_IMAGESET_DATA_ERROR' => $user->lang['NO_INFO_FOUND'] . STYLES_IMAGESET_DATA_TABLE . $user->lang['DATABASE_TABLE'],
		));
		$no_exeptions = false;
	}	
	$db->sql_freeresult($result2);
	
	while($imageset_row = $db->sql_fetchrow($result))
	{
		$sql_ary = array();

		$imageset_definitions = array();
		foreach ($imageset_keys as $topic => $key_array)
		{
			$imageset_definitions = array_merge($imageset_definitions, $key_array);
		}

		$cfg_data_imageset = parse_cfg_file("{$phpbb_root_path}styles/{$imageset_row['imageset_path']}/imageset/imageset.cfg");

		$db->sql_transaction('begin');
		
		foreach ($cfg_data_imageset as $image_name => $value)
		{
			if (strpos($value, '*') !== false)
			{
				if (substr($value, -1, 1) === '*')
				{
					list($image_filename, $image_height) = explode('*', $value);
					$image_width = 0;
				}
				else
				{
					list($image_filename, $image_height, $image_width) = explode('*', $value);
				}
			}
			else
			{
				$image_filename = $value;
				$image_height = $image_width = 0;
			}

			if (strpos($image_name, 'img_') === 0 && $image_filename)
			{
				$image_name = substr($image_name, 4);
				if (in_array($image_name, $imageset_definitions))
				{
					$sql_ary[] = array(
						'image_name'		=> (string) $image_name,
						'image_filename'	=> (string) $image_filename,
						'image_height'		=> (int) $image_height,
						'image_width'		=> (int) $image_width,
						'imageset_id'		=> (int) $imageset_row['imageset_id'],
						'image_lang'		=> '',
					);
				}
			}
		}
				
		$sql3 = 'SELECT lang_dir
			FROM ' . LANG_TABLE;
		$result3 = $db->sql_query($sql3);
		if (!$result3)
		{
			$template->assign_block_vars('imageset_row', array(
				'S_SGPRA_IMAGESET' => true,
				'S_SGPRA_IMAGESET_DATA' => true,
				'S_SGPRA_IMAGESET_LANG' => false,
				'SGPRA_IMAGESET_LANG_ERROR' => $user->lang['NO_INFO_FOUND'] . LANG_TABLE . $user->lang['DATABASE_TABLE'],
			));
			$no_exeptions = false;
		}
		
		while ($row3 = $db->sql_fetchrow($result3))
		{
			if (@file_exists("{$phpbb_root_path}styles/{$imageset_row['imageset_path']}/imageset/{$row3['lang_dir']}/imageset.cfg"))
			{
				$cfg_data_imageset_data = parse_cfg_file("{$phpbb_root_path}styles/{$imageset_row['imageset_path']}/imageset/{$row3['lang_dir']}/imageset.cfg");
				foreach ($cfg_data_imageset_data as $image_name => $value)
				{
					if (strpos($value, '*') !== false)
					{
						if (substr($value, -1, 1) === '*')
						{
							list($image_filename, $image_height) = explode('*', $value);
							$image_width = 0;
						}
						else
						{
							list($image_filename, $image_height, $image_width) = explode('*', $value);
						}
					}
					else
					{
						$image_filename = $value;
						$image_height = $image_width = 0;
					}

					if (strpos($image_name, 'img_') === 0 && $image_filename)
					{
						$image_name = substr($image_name, 4);
						if (in_array($image_name, $imageset_definitions))
						{
							$sql_ary[] = array(
								'image_name'		=> (string) $image_name,
								'image_filename'	=> (string) $image_filename,
								'image_height'		=> (int) $image_height,
								'image_width'		=> (int) $image_width,
								'imageset_id'		=> (int) $imageset_row['imageset_id'],
								'image_lang'		=> (string) $row3['lang_dir'],
							);
						}
					}
				}
			}
		}
		$db->sql_freeresult($result3);

		$db->sql_multi_insert(STYLES_IMAGESET_DATA_TABLE, $sql_ary);

		$db->sql_transaction('commit');

		$cache->destroy('sql', STYLES_IMAGESET_DATA_TABLE);

		add_log('admin', 'LOG_IMAGESET_REFRESHED', $imageset_row['imageset_name']);
			
		$template->assign_block_vars('imageset_row', array(
			'S_SGPRA_IMAGESET' => true,
			'S_SGPRA_IMAGESET_DATA' => true,
			'SGRA_IMAGESET_REFRESHED' => "<br />&nbsp;:&nbsp;" . $imageset_row['imageset_name'] . $user->lang['REFRESHED'],
		));
	}
	$db->sql_freeresult($result);
*/
	// purge cache
	$cache->purge();
	
	// Clear permissions
	$auth->acl_clear_prefetch();
	cache_moderators();

	add_log('admin', 'LOG_PURGE_CACHE');
	$template->assign_vars(array(
		'S_PURGE_CACHE'				=> true,
	));
	
	//RSS Newsfeeds files
	$desired_extension = 'dat'; //extension we're looking for 
	$dirname = $phpbb_root_path . 'cache/'; //path to cache directory
	$dir = opendir($dirname);
	
	while(false != ($file = readdir($dir))) 
	{
		if(($file != ".") and ($file != ".."))
		{
			$fileChunks = explode(".", $file);
			if($fileChunks[1] == $desired_extension)
			{
				@unlink($dirname . $file); //remove file
			}
		}
	}
	closedir($dir);
	$log_file_list = $user->lang['ALL_FILES'];

	add_log('admin', 'LOG_RSS_CACHE_CLEANED', $log_file_list);
	$template->assign_vars(array(
		'S_RSS_CACHE'				=> true,
	));
	
	/**
	* Result output
	*/
	if ($no_exeptions)
	{
		$template->assign_vars(array(
			'S_NO_EXEPTIONS' => true,
		));
	}
	else
	{
		$template->assign_vars(array(
			'S_NO_EXEPTIONS' => false,
		));
	}
}
else
{
		$template->assign_vars(array(
			'S_IS_ADMIN' => false,
			'S_LOGININFO' => '<br /><a href="' . $phpbb_root_path . 'ucp.php?mode=login">' . $user->lang['SGPRA_LOG_IN'],
		));
}
page_footer();

	/**
	* Destroys cached versions of template files
	*
	* @param array $template_row contains the template's row in the STYLES_TEMPLATE_TABLE database table
	* @param mixed $file_ary is optional and may contain an array of template file names which should be refreshed in the cache.
	*	The file names should be the original template file names and not the cache file names.
	*/
	function clear_template_cache($template_row, $file_ary = false)
	{
		global $phpbb_root_path, $phpEx, $user;

		$cache_prefix = 'tpl_' . str_replace('_', '-', $template_row['template_path']);

		if (!$file_ary || !is_array($file_ary))
		{
			$file_ary = template_cache_filelist($template_row['template_path']);
			$log_file_list = $user->lang['ALL_FILES'];
		}
		else
		{
			$log_file_list = implode(', ', $file_ary);
		}

		foreach ($file_ary as $file)
		{
			$file = str_replace('/', '.', $file);

			$file = "{$phpbb_root_path}cache/{$cache_prefix}_$file.html.$phpEx";
			if (file_exists($file) && is_file($file))
			{
				@unlink($file);
			}
		}
		unset($file_ary);

		add_log('admin', 'LOG_TEMPLATE_CACHE_CLEARED', $template_row['template_name'], $log_file_list);
	}
	/**
	* Store template files into db
	*/
	function store_templates($mode, $style_id, $template_path, $filelist)
	{
		global $phpbb_root_path, $phpEx, $db;

		$template_path = $template_path . '/template/';
		$includes = array();
		foreach ($filelist as $pathfile => $file_ary)
		{
			foreach ($file_ary as $file)
			{
				if (!($fp = @fopen("{$phpbb_root_path}styles/$template_path$pathfile$file", 'r')))
				{
					trigger_error("Could not open {$phpbb_root_path}styles/$template_path$pathfile$file", E_USER_ERROR);
				}
				$template_data = fread($fp, filesize("{$phpbb_root_path}styles/$template_path$pathfile$file"));
				fclose($fp);

				if (preg_match_all('#<!-- INCLUDE (.*?\.html) -->#is', $template_data, $matches))
				{
					foreach ($matches[1] as $match)
					{
						$includes[trim($match)][] = $file;
					}
				}
			}
		}

		foreach ($filelist as $pathfile => $file_ary)
		{
			foreach ($file_ary as $file)
			{
				// Skip index.
				if (strpos($file, 'index.') === 0)
				{
					continue;
				}

				// We could do this using extended inserts ... but that could be one
				// heck of a lot of data ...
				$sql_ary = array(
					'template_id'			=> (int) $style_id,
					'template_filename'		=> "$pathfile$file",
					'template_included'		=> (isset($includes[$file])) ? implode(':', $includes[$file]) . ':' : '',
					'template_mtime'		=> (int) filemtime("{$phpbb_root_path}styles/$template_path$pathfile$file"),
					'template_data'			=> (string) file_get_contents("{$phpbb_root_path}styles/$template_path$pathfile$file"),
				);

				if ($mode == 'insert')
				{
					$sql = 'INSERT INTO ' . STYLES_TEMPLATE_DATA_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
				}
				else
				{
					$sql = 'UPDATE ' . STYLES_TEMPLATE_DATA_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . "
						WHERE template_id = $style_id
							AND template_filename = '" . $db->sql_escape("$pathfile$file") . "'";
				}
				$db->sql_query($sql);
			}
		}
	}
	/**
	* Returns an array containing all template filenames for one template that are currently cached.
	*
	* @param string $template_path contains the name of the template's folder in /styles/
	*
	* @return array of filenames that exist in /styles/$template_path/template/ (without extension!)
	*/
	function template_cache_filelist($template_path)
	{
		global $phpbb_root_path, $phpEx, $user;

		$cache_prefix = 'tpl_' . str_replace('_', '-', $template_path);

		if (!($dp = @opendir("{$phpbb_root_path}cache")))
		{
			trigger_error($user->lang['TEMPLATE_ERR_CACHE_READ'] . adm_back_link($this->u_action), E_USER_WARNING);
		}

		$file_ary = array();
		while ($file = readdir($dp))
		{
			if ($file[0] == '.')
			{
				continue;
			}

			if (is_file($phpbb_root_path . 'cache/' . $file) && (strpos($file, $cache_prefix) === 0))
			{
				$file_ary[] = str_replace('.', '/', preg_replace('#^' . preg_quote($cache_prefix, '#') . '_(.*?)\.html\.' . $phpEx . '$#i', '\1', $file));
			}
		}
		closedir($dp);

		return $file_ary;
	}
	/**
	* Returns a string containing the value that should be used for the theme_data column in the theme database table.
	* Includes contents of files loaded via @import
	*
	* @param array $theme_row is an associative array containing the theme's current database entry
	* @param mixed $stylesheet can either be the new content for the stylesheet or false to load from the standard file
	* @param string $root_path should only be used in case you want to use a different root path than "{$phpbb_root_path}styles/{$theme_row['theme_path']}"
	*
	* @return string Stylesheet data for theme_data column in the theme table
	*/
	function db_theme_data($theme_row, $stylesheet = false, $root_path = '')
	{
		global $phpbb_root_path;

		if (!$root_path)
		{
			$root_path = $phpbb_root_path . 'styles/' . $theme_row['theme_path'];
		}

		if (!$stylesheet)
		{
			$stylesheet = '';
			if (file_exists($root_path . '/theme/stylesheet.css'))
			{
				$stylesheet = file_get_contents($root_path . '/theme/stylesheet.css');
			}
		}

		// Match CSS imports
		$matches = array();
		preg_match_all('/@import url\(["\'](.*)["\']\);/i', $stylesheet, $matches);

		if (sizeof($matches))
		{
			foreach ($matches[0] as $idx => $match)
			{
				$stylesheet = str_replace($match, load_css_file($theme_row['theme_path'], $matches[1][$idx]), $stylesheet);
			}
		}

		// adjust paths
		return str_replace('./', 'styles/' . $theme_row['theme_path'] . '/theme/', $stylesheet);
	}
	/**
	* Load css file contents
	*/
	function load_css_file($path, $filename)
	{
		global $phpbb_root_path;

		$file = "{$phpbb_root_path}styles/$path/theme/$filename";

		if (file_exists($file) && ($content = file_get_contents($file)))
		{
			$content = trim($content);
		}
		else
		{
			$content = '';
		}
		if (defined('DEBUG'))
		{
			$content = "/* BEGIN @include $filename */ \n $content \n /* END @include $filename */ \n";
		}

		return $content;
	}

	$template->assign_vars(array(
		'STARGATE'				=> (STARGATE) ? true : false,
		'S_SHOW_ON_PORTAL_R'	=> true,
	));
?>