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

	$queries = $cached_queries = 0;

	include($phpbb_root_path . 'includes/sgp_functions.'. $phpEx );

	global $k_config, $k_blocks;

	foreach ($k_blocks as $blk)
	{
		if ($blk['html_file_name'] == 'block_bot_tracker.html')
		{
			$block_cache_time = $blk['block_cache_time']; 
		}
	}
	$block_cache_time = (isset($block_cache_time) ? $block_cache_time : $k_config['block_cache_time_default']);

	$number_of_bots_to_show = $k_config['number_of_bots_to_display'];
	$show_bot_tracker = $k_config['allow_bot_display'];
	$after_date = $config['board_startdate'];
	$loop_count = 0;

	$sql = 'SELECT username, user_colour, user_lastvisit
		FROM ' . USERS_TABLE . '
		WHERE user_type = ' . USER_IGNORE . '
		AND user_lastvisit > ' . $after_date . '
		ORDER BY user_lastvisit DESC';

	$result = $db->sql_query_limit($sql, $number_of_bots_to_show, 0, $block_cache_time);

	while ($row = $db->sql_fetchrow($result))
	{
		$bot_name = get_username_string('full', '', sgp_checksize($row['username'],23), $row['user_colour']);

		$template->assign_block_vars('bot_tracker', array(
			'BOT_NAME'					=> $bot_name,
			'BOT_TRACKER_VISIT_DATE'	=> $user->format_date($row['user_lastvisit'], 'D. M. d Y, H:i'),
		));
		$loop_count = $loop_count + 1;
	}
	$db->sql_freeresult($result);

	// assign vars
	$template->assign_vars(array(
		'NO_DATA'				=> ($loop_count == 0) ? true : false,
		'BOT_TRACKER'			=> sprintf($user->lang['BOT_TRACKER'], $number_of_bots_to_show),
		'S_BOT_TRACKER_SHOW'	=> ($show_bot_tracker) ? true : false,
		'BOT_TRACKER_DEBUG'		=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0', ($total_queries) ? $total_queries : '0'),
	));

?>