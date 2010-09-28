<?php
/**
*
* @package phpBB3
* @version $Id: sgp_admin_functions.php 336 2009-01-23 02:06:37Z Michealo $
* @copyright (c) Michael O'Toole 2005 phpBBireland
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* Last updated: 03 August 2010 by Mike
* Do not remove copyright from any file.
*/


if (!defined('IN_PHPBB'))
{
	exit;
}

if (!function_exists('get_reserved_words'))
{
	function get_reserved_words()
	{
		global $reserved_words, $db, $template;
		$reserved_words = array();
		$i = 0;

		$sql = 'SELECT *
			FROM ' . K_RESOURCE_TABLE . "
			WHERE type = 'R' ";

		$result = $db->sql_query($sql, 300);

		while ($row = $db->sql_fetchrow($result))
		{
			$reserved_words[] = $row['word'];

			$template->assign_block_vars('reserved_words', array(
				'RESERVED_WORDS'	=> $row['word'],
			));

		}
		$db->sql_freeresult($result);

		return($reserved_words);

	}
}
?>