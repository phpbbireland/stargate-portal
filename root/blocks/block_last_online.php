<?php
/**
*
* @package Stargate Portal
* @author  Martin Larsson - aka NeXur
* @co-author Michaelo - Michael O'Toole
* @begin   Wed, Oct 14, 2008
* @copyright (c) 2008 Martin Larsson - aka NeXur
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id$
*
* Updated: 17th October 2008 NeXu
* UPDATE INFO (these comments can be removed when we reach final draft)
* fixed problem with multiple sessions by checking code in memberlist.php
* changed block html layout - thanks nGAGE!
* Auth check added & throws 2 differnt messages if you are logged in/browsing as guest
*/

/**
* @ignore
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

global $k_config, $k_blocks;

foreach ($k_blocks as $blk)
{
	if ($blk['html_file_name'] == 'block_last_online.html')
	{
		$block_cache_time = $blk['block_cache_time'];
	}
}
$block_cache_time = (isset($block_cache_time) ? $block_cache_time : $k_config['block_cache_time_default']);

$max_last_online = $k_config['max_last_online']; //Numbers of users to show in the lisat configurable via ACP

$queries = $cached_queries = 0;

// Can this user view profiles/memberlist/onlinelist?
if ($auth->acl_gets('u_viewprofile'))
{
	$template->assign_vars(array(
		'VIEWONLINE' => true,
	));

	//Fetch all the block data
	$sql = 'SELECT u.user_id, u.username, u.user_colour, u.user_type, u.user_avatar, u.user_avatar_type, u.user_lastvisit, s.session_user_id, MAX(s.session_time) AS session_time
		FROM ' . USERS_TABLE . ' u
		LEFT JOIN ' . SESSIONS_TABLE . ' s ON (u.user_id = s.session_user_id AND session_time >= ' . (time() - $config['session_length']) . ')
		WHERE u.user_type <> 2
			AND u.user_lastvisit <> 0
		GROUP BY s.session_user_id, u.user_id
		ORDER BY session_time DESC, u.user_lastvisit DESC' ;

	$result = $db->sql_query_limit($sql, $max_last_online, 0, $block_cache_time);

	$session_times = array();
	while($row = $db->sql_fetchrow($result))
	{
		if (!$row['username'])
		{
			continue;
		}

		$session_times[$row['session_user_id']] = $row['session_time'];
		$row['session_time'] = (!empty($session_times[$row['user_id']])) ? $session_times[$row['user_id']] : 0;
		$row['last_visit'] = (!empty($row['session_time'])) ? $row['session_time'] : $row['user_lastvisit'];
		$last_visit = (!empty($row['session_time'])) ? $row['session_time'] : $row['user_lastvisit'];

		$template->assign_block_vars('last_online', array(
			'USERNAME_FULL'		=> get_username_string('full', $row['user_id'], sgp_checksize($row['username'],15), $row['user_colour']),
			'ONLINE_TIME'		=> (empty($last_visit)) ? ' - ' : $user->format_date($last_visit),
			'USER_AVATAR_IMG'	=> sgp_get_user_avatar($row['user_avatar'], $row['user_avatar_type'], '16', '16'),
			'U_REGISTER'		=> 'append_sid("{$phpbb_root_path}ucp.$phpEx", mode=register)',
		));
	}
	$db->sql_freeresult($result);
}

//Is user logged in and have no auth  to view profiles/memberlist/onlinelist?
if ($user->data['user_type'] <> 2 && !$auth->acl_gets('u_viewprofile'))
{
	$template->assign_vars(array(
		'NO_VIEWONLINE_R' => true,
	));
}

//Is user not logged in and have no auth to view profiles/memberlist/onlinelist?
if ($user->data['user_id'] == ANONYMOUS && !$auth->acl_gets('u_viewprofile'))
{
	$template->assign_vars(array(
		'NO_VIEWONLINE_A' => true,
		'LAST_ONLINE_DEBUG' => sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0', ($total_queries) ? $total_queries : '0'),
	));
}
else
{
	$template->assign_vars(array(
		'LAST_ONLINE_DEBUG' => sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0', ($total_queries) ? $total_queries : '0'),
	));
}


?>