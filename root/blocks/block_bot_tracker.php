<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   Saturday, Jan 22, 2005
* @copyright (c) 2005-2008 phpbbireland
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_bot_tracker.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* Updated: 28 August 2008
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
*/
	$page_title = $user->lang['BLOCK_BOT_TRACKER'];

	$queries = 0;
	$cached_queries = 0;

	global $k_config;

	$number_of_bots_to_show = $k_config['number_of_bots_to_display'];
	$show_bot_tracker = $k_config['allow_bot_display'];

	$sql = 'SELECT username, user_colour, user_lastvisit
		FROM ' . USERS_TABLE . '
		WHERE user_type = ' . USER_IGNORE . ' 
		ORDER BY user_lastvisit DESC';

	$result = $db->sql_query_limit($sql, $number_of_bots_to_show, 0, 600);

	while ($row = $db->sql_fetchrow($result))
	{
		$bot_name = get_username_string('full', '', sgp_checksize($row['username'],23), $row['user_colour']);

		$template->assign_block_vars('bot_tracker', array(
			'BOT_NAME'					=> $bot_name,
			'BOT_TRACKER_VISIT_DATE'	=> $user->format_date($row['user_lastvisit'], 'D. M. d Y, H:i'),
		));
	}
	$db->sql_freeresult($result);

	// assign vars
	$template->assign_vars(array(
		'BOT_TRACKER'		=> sprintf($user->lang['BOT_TRACKER'], $number_of_bots_to_show),
		'S_BOT_TRACKER_SHOW'	=> ($show_bot_tracker) ? true : false,
		'BT_PORTAL_DEBUG'		=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0'),
	));

?>