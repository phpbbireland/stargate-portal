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
* @param string $txt, $length (truncate to length).
*
* If $options var true, return entire message if it contains attachments.
* Last updated: 28 September 2010 Mike
*/

if (!function_exists('sgp_truncate_message'))
{
	function sgp_truncate_message($txt, $length)
	{
		global $phpbb_root_path, $config;
		$buffer = $div_append = '';
		$extend = 0;

		if (strlen($txt) > $length)
		{
			$extend = correct_truncate_length($txt, $length);
		}

		if (stripos($txt, '</div>'))
		{
			$div_append = '</div>';
		}

		if (strlen($txt) > $length)
		{
			for ($i = 0; $i <= $extend; $i++)
			{
				$buffer .= $txt[$i];
			}
		}

		$buffer .= '...';

		return($buffer . $div_append);
	}
}

/*
* When truncating text or post message ensure we do not truncate in the middle
* of special text such as bbcode, smilies, attachments etc...
*
* The function is passed the text to truncate and the required lenth of the
* truncated text... 
*
* It returns the length of the truncated string altered to avoid splitting 
* special code... 
*
* 28 September 2010 Mike.... requires testing as usual...
*/
if (!function_exists('correct_truncate_length'))
{
	function correct_truncate_length($txt, $truncate)
	{
		$smile_start = $smile_end = $uid_start = $uid_end = 0;

		$return_val = $truncate;

		$len = strlen($txt);

		for ($i = 0; $i < $len; $i++)
		{

			if($txt[$i] == '<' && $txt[$i + 5] == 's' && $txt[$i + 6] == ':')
			{
				$smile_start = $i;
				while ($txt[$i] != '>' && $i < $len)
				{
					$i++;
				}
				$smile_end = $i;

				if($smile_start < $truncate && $smile_end < $truncate) // || $smile_start > $truncate)
				{
					$return_val = $truncate;

				}
				if($smile_start < $truncate && $smile_end > $truncate)
				{
					$return_val = $smile_end;
				}
			}
			
			if($txt[$i] == ':' && $txt[$i + 9] == ']')
			{
				$uid_start = $i;

				while($i < $len)
				{
					if($txt[$i] == '[' && $txt[$i+1] == '/')
					{
						while($txt[$i] != ']' && $i < $len)
						{
							$i++;
						}
						$uid_end = $i;
						break;
					}
					$i++;
				}
				$i++;

				if($uid_start < $truncate && $uid_end < $truncate)
				{
					$return_val = $truncate;

				}

				if($uid_start < $truncate && $uid_end > $truncate)
				{
					$return_val = $uid_end;
				}
			}
		}
		return($return_val);
	}
}
?>