<?php
/**
*
* @package phpBB3
* @version $Id: sgp_functions.php 336 2009-01-23 02:06:37Z Michealo $
* @copyright (c) Michael O'Toole 2005 phpBBireland
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* Last updated: 10 November 2008 by NeXur
* Do not remove copyright from any file.
*/

/* 
* A couple of functions rescued from functions.php
* Part of the Acronym code @based on the original Acronym © 2005 CodeMonkeyX
* @copyright (c) 2007 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/

if ( !defined('IN_PHPBB') )
{
	exit;
}

global $phpbb_root_path;

/***
* Stargate functions starts 
*/

if(!function_exists('stargate_init'))
{
	function stargate_init()
	{
		// cache is set in common.php

		if(STARGATE)
		{
			global $user, $template, $auth, $phpbb_root_path, $config, $phpEx, $SID, $k_config;

			// support for stereo logos (where left and right images are mirror images) //
			// I introduced this for Startrek style but may use it in others... //
			$logo_right = $logo = sgp_get_rand_logo();
			$logo_right  = str_replace('logos', 'logos/right_images', $logo);

			$template->assign_vars(array(
				'STARGATE'			=> true,
				'L_PORTAL'			=> $user->lang['FORUM_PORTAL'],
				'U_PORTAL'			=> append_sid("{$phpbb_root_path}portal.$phpEx"),
				'U_PORTAL_ARRANGE'	=> append_sid("{$phpbb_root_path}portal.$phpEx"."?arrange=1"), 
				'U_HOME'			=> append_sid("{$phpbb_root_path}portal.$phpEx"),
				'U_IMPRINT'			=> append_sid("{$phpbb_root_path}imprint.$phpEx"),
				'U_DISCLAIMER'		=> append_sid("{$phpbb_root_path}disclaimer.$phpEx"),

				'SITE_LOGO_IMG'			=> $logo,
				'SITE_LOGO_IMG_RIGHT'	=> $logo_right,
			));
		}
	}
}


/***
* stargate hardcoded acronyms function, replaces acronyms. Started: 14 February 2007
*/
if(!function_exists('sgp_local_acronyms'))
{
	function sgp_local_acronyms($message) 
	{
		global $user;
		$message = str_replace("[you!]", '<span title="This means you!" style="font-style:italic; border-bottom:1px #BD5121 dashed ; cursor: help; color:#' . $user->data['user_colour'] . ';">' . $user->data['username'] . '</span>', $message);
		$message = str_replace("[day-time]", $user->format_date(time()), $message);
		$message = str_replace("[date-now]", date( "d-m-Y", time() ), $message);
		return($message);
	}
}

/***
* generate random logo
*/

if(!function_exists('sgp_get_rand_logo'))
{
	function sgp_get_rand_logo() 
	{
		// initalise variables //
		global $user, $phpbb_root_path, $k_config;
		$rand_logo = "";
		$imglist = "";
		$imgs ="";

		// Random logos are disabled config, so return default logo //
		if($k_config['allow_rotating_logos'] == 0)
			return $user->img('site_logo');

		mt_srand((double)microtime()*1000001);

		$logos_dir = "{$phpbb_root_path}styles/" . $user->theme['theme_path'] . '/theme/images/logos';

		@$handle=opendir($logos_dir);

		// for logo in default directory 	//@$handle=opendir('images/logos');

		if(!$handle) // no handle so we don't have logo directory or we are attempting to login to ACP so we need to return the default logo //
			return($user->img('site_logo'));

		while (false!==($file = readdir($handle)))
		{
			if(stripos($file, ".gif") || stripos($file, ".jpg") || stripos($file, ".png") && stripos($file ,"ogo_"))
				$imglist .= "$file ";

			/*
			if (eregi("gif", $file) || eregi("jpg", $file) || eregi("png", $file) && eregi("logo_", $file))
			{
				$imglist .= "$file ";
			}
			*/
		}
		closedir($handle);

		$imglist = explode(" ", $imglist);

		$random = mt_rand(0, (mt_rand(0, (sizeof($imglist)-2))));

		$image = $imglist[$random];

		$rand_logo .= '<img src="' . $logos_dir . '/' . $image . '" alt="" /><br />';

		// uncomment next line if template assignment is required //
		//$template->assign_vars(array('RAND_LOGO' => $rand_logo));

		return ($rand_logo);
	}
}

/***
* set config value phpbb code reused
*/
if(!function_exists('sgp_acp_set_config'))
{
	function sgp_acp_set_config($config_name, $config_value, $is_dynamic = false)
	{
		global $db, $cache, $k_config;

		$sql = 'UPDATE ' . K_BLOCKS_CONFIG_VAR_TABLE . "
			SET config_value = '" . $db->sql_escape($config_value) . "'
			WHERE config_name = '" . $db->sql_escape($config_name) . "'";
		$db->sql_query($sql);

		if (!$db->sql_affectedrows() && !isset($k_config[$config_name]))
		{
			$sql = 'INSERT INTO ' . K_BLOCKS_CONFIG_VAR_TABLE . ' ' . $db->sql_build_array('INSERT', array(
				'config_name'	=> $config_name,
				'config_value'	=> $config_value,
				'is_dynamic'	=> ($is_dynamic) ? 1 : 0));
			$db->sql_query($sql);
		}

		$k_config[$config_name] = $config_value;

		if (!$is_dynamic)
		{
			$cache->destroy('config');
		}
	}
}
/***
* return a k_config value (may not be required)
*/
if(!function_exists('get_k_config_var'))
{
	function get_k_config_var($item)
	{
		if(isset($item))
			return($item);

		$sql = 'SELECT config_name, config_value
			FROM ' . K_BLOCKS_CONFIG_VAR_TABLE . '
			WHERE config_name = $item';

		$row = $db->sql_fetchrow($result);
		//$k_config[$row['config_name']] = $row['config_value'];
		return $row['config_value'];
	}
}

/***
* little function to create text version for a comnpletion bar 0-100%
*/
if(!function_exists('k_progress_bar'))
{
	function k_progress_bar($percent)
	{
		// $percent = number between 0 and 100 //

		$ss = "";

		// define these in css
		$start = '<b class="green">';	// green
		$middl = '<b class="orange">';	// orange
		$endss = '<b class="red">';		// red

		$tens = $percent / 10; // how many tens //

		if($percent % 10) $i = 1; else $i = 0;

		for($i; $i < ($percent / 10); $i++) $ss .= '|';

		$start .= $ss . '</b>';

		if($percent % 10) { $start .= $middl . '|' . '</b>' . $endss; }
			else { $start .= '' . $endss; }

		while($i++ < 10)
		{	$start .= '|';	}

		$start .= '</b>';

		return ' [' . $start . ']';
	}
}


/***
* create a date (old code)
*/
if(!function_exists('create_date'))
{
	function create_date($format, $gmepoch, $tz)
	{
		global $board_config, $lang;
		static $translate;
		global $userdata, $db;

		$switch_summer_time = ( $userdata['user_summer_time'] && $board_config['summer_time'] ) ? true : false;
		if ($switch_summer_time) $tz++;

		if(empty($translate) && $board_config['default_lang'] != 'english')
		{
			@reset($lang['datetime']);
			while ( list($match, $replace) = @each($lang['datetime']) )
			{
				$translate[$match] = $replace;
			}
		}
		return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + (3600 * $tz)), $translate) : @gmdate($format, $gmepoch + (3600 * $tz));
	}
}


/***
* Smilie processing.
*/
if(!function_exists('smilie_text'))
{
	function smilie_text($text, $force_option = false)
	{
		global $config, $user, $phpbb_root_path;

		// could redirect to style based smilies //
		$userstylepath = $phpbb_root_path . $config['smilies_path'] . '/';

		$phpbb_root_path = './';

		return ($force_option || !$config['allow_smilies'] || !$user->optionget('viewsmilies')) ? preg_replace('#<!\-\- s(.*?) \-\-><img src="\{SMILIES_PATH\}\/.*? \/><!\-\- s\1 \-\->#', '\1', $text) : str_replace('<img src="{SMILIES_PATH}', '<img src="' . $userstylepath, $text);
	}
}


/***
* same as truncate_string() with ...
*/

if(!function_exists('sgp_checksize'))
{
	function sgp_checksize($txt,$len)
	{
		if(strlen($txt) > $len)
		{
			$txt = truncate_string($txt, $len);
			$txt .= '...';
		}
		return($txt);
	}
}


/**
* Truncates post while retaining special characters if going over the max allowed length of announcements or news items
* @param string $txt The text to truncate to the given length. String is specialchared.
* Last updated: 18 February 2009 Mike
*/

if(!function_exists('sgp_truncate_message'))
{
	function sgp_truncate_message($txt, $length)
	{
		global $phpbb_root_path, $config;

		$buffer = '';
		$div_append = '';
		$extend = 0;
		$start_tag = $end_tag = 0;
		$len = $length;
		$notice = '';
		$is_image = false;

		$txt = preg_replace('#<!\-\- s(.*?) \-\-><img src="\{SMILIES_PATH\}\/(.*?) \/><!\-\- s\1 \-\->#', '<img src="' . $phpbb_root_path . $config['smilies_path'] . '/\2 />', $txt);

		if(strlen($txt) > $len)
		{
			if(stripos($txt, '</div>'))
				$div_append = '</div>';

			for($i = 0; $i <= $len; $i++)
			{
				// skip bbcodes by using a token '[' //
				if($txt[$i] == '[')
				{
					$extend++;
					$buffer .= $txt[$i]; $i++;

					if($txt[$i] == '/')
					{
						$end_tag++;
					}
					else
					{
						$start_tag++;
					}

					while($txt[$i] != ']')
					{
						$buffer .= $txt[$i++];
						$len++;
						$extend++;
					}
					//$extend++;
				}
				// check for images using a token '<' //
				if($txt[$i] == '<')
				{
					$extend++;
					$buffer .= $txt[$i]; $i++;

					// confirm this is an image by testing for next char == i ( <img... )//
					if($txt[$i] != 'i')
					{
						$is_image = true;
					}
					// loop till end of image ///
					while($txt[$i] != '>' && $is_image)
					{
						$buffer .= $txt[$i++];
						$len++;
						$extend++;
					}
					$is_image = false;
				}


				$buffer .= $txt[$i];
				if($end_tag < $start_tag) $len++;

				if($end_tag == $start_tag && $i + $extend >= $length) 
				{
					break;
				}
				else
				{
					if($i + $extend >= $length)
					{
						$notice = '<div><br /><strong><span style="color:#FF0000;">Note!</span> Please avoid using square braces \'[ ]\' in Announcements or News Posts...</strong></div>';
						break;
					}
				}
			}
		}
		else
		{
			return($txt);
		}

		$buffer .= '...';
		$buffer .= $notice;
		return($buffer . $div_append);
	}
}

/***
*
*/

if(!function_exists('smilies_pass'))
{
	function smilies_pass($message)
	{
		static $orig, $repl;

		if (!isset($orig))
		{
		
			global $db, $images, $portal_config, $var_cache, $phpbb_root_path, $config;

			$orig = $repl = array();

			if(!$orig)
			{
				$sql = 'SELECT * FROM ' . SMILIES_TABLE;
				if( !$result = $db->sql_query($sql) )
				{
					trigger_error("Couldn't obtain smilies data", "", __LINE__, __FILE__, $sql);
				}
				$smilies = $db->sql_fetchrowset($result);

				if (count($smilies))
				{
					usort($smilies, "smiley_sort");
				}

				for ($i = 0; $i < count($smilies); $i++)
				{
					$orig[] = "/(?<=.\W|\W.|^\W)" . phpbb_preg_quote($smilies[$i]['code'], "/") . "(?=.\W|\W.|\W$)/";
					$repl[] = '<img src="'. $phpbb_root_path . $config['smilies_path'] . '/' . $smilies[$i]['smiley_url'] . '" alt="' . $smilies[$i]['emotion'] . '" border="0" />';
				}

				if($portal_config['cache_enabled'])
				{
					$var_cache->save($orig, 'orig2', 'smilies');
					$var_cache->save($repl, 'repl2', 'smilies');
				}
			}
		}

		if (count($orig))
		{
			$message = preg_replace($orig, $repl, ' ' . $message . ' ');
			$message = substr($message, 1, -1);
		}

		return $message;
	}
}

/***
* sort smilies
*/

if(!function_exists('smiley_sort'))
{
	function smiley_sort($a, $b)
	{
		if ( strlen($a['code']) == strlen($b['code']) )
		{
			return 0;
		}

		return ( strlen($a['code']) > strlen($b['code']) ) ? -1 : 1;
	}
}
/***
* phpbb pregs quote reused
*/

if(!function_exists('phpbb_preg_quote'))
{
	function phpbb_preg_quote($str, $delimiter)
	{
		$text = preg_quote($str);
		$text = str_replace($delimiter, '\\' . $delimiter, $text);

		return $text;
	}
}

/***
* search block search
*/

if(!function_exists('search_block_func'))
{
	function search_block_func()
	{
		global $lang, $template, $portal_config, $board_config, $keywords, $phpbb_root_path;

		$phpEx = substr(strrchr(__FILE__, '.'), 1);

		$template->assign_vars(array(
			"L_SEARCH_ADV" => $lang['SEARCH_ADV'],
			"L_SEARCH_OPTION" => (!empty($portal_config['search_option_text'])) ? $portal_config['search_option_text'] : $board_config ['sitename'],
			'U_SEARCH'		=> append_sid("{$phpbb_root_path}search.$phpEx", 'keywords=' . urlencode($keywords)),
			)
		);
	}
}

/**
*	returns the users group name
*/

if(!function_exists('which_group'))
{
	function which_group($id)
	{
		global $db, $template;

		// Get group name for this user
		$sql = 'SELECT group_name
			FROM ' . GROUPS_TABLE . '
			WHERE group_id = ' . $id;

		$result = $db->sql_query($sql,650);

		$name = $db->sql_fetchfield('group_name');

		$db->sql_freeresult($result);

		// mb_convert_case is not available in some versions //
		//$name = mb_convert_case($name, MB_CASE_TITLE, "UTF-8");

		if($name == '')
			return('None');
		else
			return ($name);
	}
}

/***
* get all group names (used to avoid problems with group ID's changing)
*/

if(!function_exists('get_all_groups'))
{
	function get_all_groups()
	{

		global $db, $template, $k_groups, $k_group_id, $k_group_name_id;

		// Get us all the groups
		$sql = 'SELECT group_id, group_name
			FROM ' . GROUPS_TABLE . '
			ORDER BY group_id ASC, group_name';
		$result = $db->sql_query($sql,600);
		$i = 0;
		while ($row = $db->sql_fetchrow($result))
		{
			$k_groups[$i++] = $row['group_name'];
			$k_group_id[$row['group_id']] = $row;
			$k_group_name_id[$row['group_name']] = $row['group_id'];
		}
		$db->sql_freeresult($result);
	}
}

/**
* acronym code by: Frold phpbb.com ref: http://www.phpbb.com/community/viewtopic.php?p=3243523#p3243523
*/

if(!function_exists('acronym_pass'))
{
	function acronym_pass($text)
	{
		global $k_config;

		if(!$k_config['allow_acronyms'])
			return $text;

		$acronym_cache = new acronym_cache();
		static $acronyms;
		global $cache;

		if (!isset($acronyms) || !is_array($acronyms))
		{
			$acronyms = $acronym_cache->obtain_acronym_list();
		}

		if (sizeof($acronyms))
		{
			$text = sgp_local_acronyms($text);
			$acronyms_match = $acronyms['match'];
			$acronyms_repl = $acronyms['replace'];
			// should be modified to include '/' as it will replace 'forum' in www.mysite/forum/index.php when it shouldn't //
			$text =  substr(preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "preg_replace(\$acronyms_match, \$acronyms_repl, '\\0')", '>' . $text . '<'), 1, -1);
			return str_replace('\\"', '"', $text);
		}
		return $text;
	}
}

/**
* Class for grabbing/handling acronym cached entries, extends acm_file or acm_db depending on the setup
* @package acm
*/

if (!class_exists('acronym_cache')) 
{
	class acronym_cache extends acm
	{
		/**
		* Obtain list of acronyms and build preg style replacement arrays for use by the calling script
		*/
		function obtain_acronym_list()
		{
			global $k_config, $user, $db;

			if (($acronyms = $this->get('_word_acronyms')) === false)
			{
				$sql = 'SELECT acronym, meaning
					FROM ' . K_ACRONYMS_TABLE . "
						WHERE lang = '" . $user->data['user_lang'] . "'
							ORDER BY LENGTH(TRIM(acronym))	DESC";

				$result = $db->sql_query($sql, 600);

				$acronyms = array();

				while ($row = $db->sql_fetchrow($result))
				{
					$acronyms['match'][] = '#(' . phpbb_preg_quote($row['acronym'], '#') . ')#';
					$acronyms['replace'][] = '<acronym title="' . $row['meaning'] . '">\\1</acronym>';
				}
				$db->sql_freeresult($result);
				$this->put('_word_acronyms', $acronyms);
			}
			return $acronyms;
		}
	}
}

if(!function_exists('process_for_vars'))
{
	function process_for_vars($data)
	{
		global $config;

		//later ad to database to allow a bigger range and var to be used in other sections.. 29 March 2009
		/*
		if($in)
		{
			$search = array('$portal_version', '$phpbb_version', '$your_site');
			$replace = array($config['portal_version'], $config['version'], $config['sitename']);
		}
		else
		{
			$replace = array($config['portal_version'], $config['version'], $config['sitename']);
			$search = array('$portal_version', '$phpbb_version','$your_site');
		}
		*/

		$search = array('$portal_version', '$phpbb_version', '$your_site');
		$replace = array($config['portal_version'], $config['version'], $config['sitename']);

		$data = str_replace($search, $replace, $data);

		return($data);
	}
}

// Stargate Random Banner mod //
global $k_config, $template, $phpbb_root_path, $user;


if($k_config['rand_banner'] != 0)
{
	$image = get_random_image($phpbb_root_path . 'images/rand_banner', true);
	$template->assign_vars(array(
		'RAND_BANNER' => $image,
		'RAND_BANNER_POSITION' => $k_config['rand_banner'],
	));
}

if($k_config['rand_header'] == 1)
{
	global $user, $template, $config, $k_config;

	// get an image but don't parse it... 
	//  we now use the styles own folder...

	// as this file may be called for one or more functions the $user->theme['theme_path'] may not be visible so hide errors //
	@$path = $phpbb_root_path . 'styles/' . $user->theme['theme_path'] . '/theme/images/headers';

 	$image = get_random_image($path, false, 'header_', true);

	$template->assign_vars(array(
		'RAND_HEADER_IMG' => $image,
		'RAND_HEADER_OPT' => $k_config['rand_header'], 
	));
}

/* Stargate functions ends */

/*
function report($avar)
{
	trigger_error("Report" . $avar);
}
*/

if(!function_exists('sgp_delete_cookies'))
{
function sgp_delete_cookies()
	{
		// Delete Cookies with dynamic names (do NOT delete poll cookies)
		if (confirm_box(true))
		{
			set_cookie('sgp_im3_LB', '', 1);
			set_cookie('sgp_im3_CB', '', 1);
			set_cookie('sgp_im3_RB', '', 1);
			set_cookie('sgp_style_colour', '', 1);
		}
		else
		{
			confirm_box(false, 'DELETE_COOKIES', '');
		}
		meta_refresh(3, append_sid("{$phpbb_root_path}index.$phpEx"));

		$message = $user->lang['COOKIES_DELETED'] . '<br /><br />' . sprintf($user->lang['RETURN_INDEX'], '<a href="' . append_sid("{$phpbb_root_path}index.$phpEx") . '">', '</a>');
		trigger_error($message);
	}
}
?>