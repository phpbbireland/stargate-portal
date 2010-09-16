<?php
/**
*
* @package phpBB3
* @version $Id: sgp_functions_content.php 336 2009-01-23 02:06:37Z Michealo $
* @copyright (c) Michael O'Toole 2005 phpBBireland
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* Last updated: 10 November 2008 by Michaelo
* Do not remove copyright from any file.
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* acronym_pass()
* acronym_cache()
* sgp_local_acronyms()
*/


/**
* acronym code by: Frold phpbb.com ref:
* http://www.phpbb.com/community/viewtopic.php?p=3243523#p3243523
*/

if (!function_exists('acronym_pass'))
{
	function acronym_pass($text)
	{
		global $k_config;

		if (!$k_config['allow_acronyms'])
		{
			return $text;
		}

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

			//Fix ref: http://www.stargate-portal.com/forum/viewtopic.php?f=29&t=591&p=6857 syntron //
			if (!class_exists('acm'))
			{
				global $phpbb_root, $phpEx;
				require($phpbb_root_path . 'includes/acm/acm_file.' . $phpEx);
			}

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

/***
* stargate hardcoded acronyms function, replaces acronyms. Started: 14 February 2007
*/
if (!function_exists('sgp_local_acronyms'))
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
* phpbb pregs quote reused
*/

if (!function_exists('phpbb_preg_quote'))
{
	function phpbb_preg_quote($str, $delimiter)
	{
		$text = preg_quote($str);
		$text = str_replace($delimiter, '\\' . $delimiter, $text);

		return $text;
	}
}



/**
* Truncates post while retaining special characters
* Length set in ACP for Announcements or News items
* @param string $txt and $length (truncate to length).
* Last updated: 25 March 2010 Mike
*/

if (!function_exists('sgp_truncate_message'))
{
	function sgp_truncate_message($txt, $length)
	{
		global $phpbb_root_path, $config;

		//$txt = bbcode_strip($txt);

		$buffer = $div_append = $uid = '';

		$start_positions = $end_positions = array();
		$j = $i = $new_len = 0;
		$off_set = 1;

		$len = $length;

		if (strlen($txt) > $len)
		{
			$uid = get_post_bbcode_uid($txt);
		}

		if ($uid)
		{
			//bbcode_strip($txt);
			//$uid = false;
			return($txt);
		}

		if ($uid)
		{
			while ($off_set != 0)
			{
				$start_positions[$j] = stripos($txt, $uid, $off_set);
				$end_positions[$j] = stripos($txt, $uid, ($start_positions[$j]+1));
				$off_set = $end_positions[$j];
				$j++;
			}

			for ($i = 0; $i < $j - 1; $i++)
			{
				if($len > $start_positions[$i])
				{
					$new_len = $end_positions[$i];
				}
			}

			// Allow for bbcode length //
			$len = $new_len + 9;
			// fudge colour length //
			if (stripos($txt, 'color=#')) $len += 20;
		}

		if (stripos($txt, '</div>'))
		{
			$div_append = '</div>';
		}

		if (strlen($txt) > $len)
		{
			for ($i = 0; $i <= $len; $i++)
			{
				$buffer .= $txt[$i];
			}
		}

		$buffer .= '...';
		return($buffer . $div_append);
	}
}

// get and return bbcode_uid from any text Mike 25 March 2010 //
if (!function_exists('get_post_bbcode_uid'))
{
	function get_post_bbcode_uid($txt)
	{
		$start = false;
		$uid = '';

		$len = strlen($txt);

		for ($i = 0; $i < strlen($txt); $i++)
		{
			if ($i + 9 >= $len)
			{
				return($uid);
			}

			if ($txt[$i] == ':')
			{
				if($txt[$i + 9] == ']')
				{
					$start = true;
				}
			}

			if ($start)
			{
				while ($txt[$i] != ']')
				{
					$i++;
					$uid .= $txt[$i];
				}
				return($uid);
			}
		}
	}
}
?>