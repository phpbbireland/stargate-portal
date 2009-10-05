<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   Saturday, April 1st, 2005
* @copyright (c) 2005-2008 phpbbireland
* @home    http://www.phpbbireland.com
* @source  Rework of code from functions.php @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_online_users.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* Updated:
*
*/

/**
* @ignore
*/

if ( !defined('IN_PHPBB') )
{
	exit;
}

$queries = 0;
$cached_queries = 0;

// Get users online list ... if required
$l_online_users = $online_userlist = $l_online_record = '';
$display_online_list = true;

if ($config['load_online'] && $config['load_online_time'] && $display_online_list)
{
	$logged_visible_online = $logged_hidden_online = $guests_online = $prev_user_id = 0;
	$prev_session_ip = $reading_sql = '';

	if (!empty($_REQUEST['f']))
	{
		$f = request_var('f', 0);

		// Do not change this (it is defined as _f_={forum_id}x within session.php)
		$reading_sql = " AND s.session_page LIKE '%\_f\_={$f}x%'";

		// Specify escape character for MSSQL
		if ($db->sql_layer == 'mssql' || $db->sql_layer == 'mssql_odbc')
		{
			$reading_sql .= " ESCAPE '\\' ";
		}
	}

	// Get number of online guests
	if (!$config['load_online_guests'])
	{
		if ($db->sql_layer === 'sqlite')
		{
			$sql = 'SELECT COUNT(session_ip) as num_guests
				FROM (
					SELECT DISTINCT s.session_ip
						FROM ' . SESSIONS_TABLE . ' s
						WHERE s.session_user_id = ' . ANONYMOUS . '
							AND s.session_time >= ' . (time() - ($config['load_online_time'] * 60)) .
							$reading_sql .
				')';
		}
		else
		{
			$sql = 'SELECT COUNT(DISTINCT s.session_ip) as num_guests
				FROM ' . SESSIONS_TABLE . ' s
				WHERE s.session_user_id = ' . ANONYMOUS . '
					AND s.session_time >= ' . (time() - ($config['load_online_time'] * 60)) .
				$reading_sql;
		}
		$result = $db->sql_query($sql, 200);
		$guests_online = (int) $db->sql_fetchfield('num_guests');
		$db->sql_freeresult($result);
	}

	$sql = 'SELECT u.username, u.username_clean, u.user_id, u.user_type, u.user_allow_viewonline, u.user_colour, s.session_ip, s.session_viewonline
		FROM ' . USERS_TABLE . ' u, ' . SESSIONS_TABLE . ' s
		WHERE s.session_time >= ' . (time() - (intval($config['load_online_time'] * 60))) .
			((!$config['load_online_guests']) ? ' AND s.session_user_id <> ' . ANONYMOUS : '') . '
			AND u.user_id = s.session_user_id
		ORDER BY u.username_clean ASC, s.session_ip ASC';
	$result = $db->sql_query($sql, 200);

	while ($row = $db->sql_fetchrow($result))
	{
		// User is logged in and therefore not a guest
		if ($row['user_id'] != ANONYMOUS)
		{
			// Skip multiple sessions for one user
			if ($row['user_id'] != $prev_user_id)
			{
				if ($row['user_colour'])
				{
					$user_colour = ' style="color:#' . $row['user_colour'] . ';"';
					$row['username'] = '<strong>' . $row['username'] . '</strong>';
				}
				else
				{
					$user_colour = '';
				}
					if ($row['user_allow_viewonline'] && $row['session_viewonline'])
				{
					$user_online_link = $row['username'];
					$logged_visible_online++;
				}
				else
				{
					$user_online_link = '<em>' . $row['username'] . '</em>';
					$logged_hidden_online++;
				}

				if (($row['user_allow_viewonline'] && $row['session_viewonline']) || $auth->acl_get('u_viewonline'))
				{
					if ($row['user_type'] <> USER_IGNORE)
					{
						$user_online_link = '<a href="' . append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=viewprofile&amp;u=' . $row['user_id']) . '"' . $user_colour . '>' . $user_online_link . '</a>';
					}
					else
					{
						$user_online_link = ($user_colour) ? '<span' . $user_colour . '>' . $user_online_link . '</span>' : $user_online_link;
					}
						$online_userlist .= ($online_userlist != '') ? ', ' . $user_online_link : $user_online_link;
				}
			}

			$prev_user_id = $row['user_id'];
		}
		else
		{
			// Skip multiple sessions for one user
			if ($row['session_ip'] != $prev_session_ip)
			{
				$guests_online++;
			}
		}

		$prev_session_ip = $row['session_ip'];
	}
	$db->sql_freeresult($result);

	if (!$online_userlist)
	{
		$online_userlist = $user->lang['NO_ONLINE_USERS'];
	}

	if (empty($_REQUEST['f']))
	{
		$online_userlist = $user->lang['REGISTERED_USERS'] . ' ' . $online_userlist;
	}
	else
	{
		$l_online = ($guests_online == 1) ? $user->lang['BROWSING_FORUM_GUEST'] : $user->lang['BROWSING_FORUM_GUESTS'];
		$online_userlist = sprintf($l_online, $online_userlist, $guests_online);
	}

	$total_online_users = $logged_visible_online + $logged_hidden_online + $guests_online;

	if ($total_online_users > $config['record_online_users'])
	{
		set_config('record_online_users', $total_online_users, true);
		set_config('record_online_date', time(), true);
	}

	// Build online listing
	$vars_online = array(
		'ONLINE'	=> array('total_online_users', 'l_t_user_s'),
		'REG'		=> array('logged_visible_online', 'l_r_user_s'),
		'HIDDEN'	=> array('logged_hidden_online', 'l_h_user_s'),
		'GUEST'		=> array('guests_online', 'l_g_user_s')
	);

	foreach ($vars_online as $l_prefix => $var_ary)
	{
		switch (${$var_ary[0]})
		{
			case 0:
				${$var_ary[1]} = $user->lang[$l_prefix . '_USERS_ZERO_TOTAL'];
			break;
				case 1:
				${$var_ary[1]} = $user->lang[$l_prefix . '_USER_TOTAL'];
			break;
				default:
				${$var_ary[1]} = $user->lang[$l_prefix . '_USERS_TOTAL'];
			break;
		}
	}
	unset($vars_online);

	$l_online_users = sprintf($l_t_user_s, $total_online_users);
	$l_online_users .= sprintf($l_r_user_s, $logged_visible_online);
	$l_online_users .= sprintf($l_h_user_s, $logged_hidden_online);
	$l_online_users .= ' and ';
	$l_online_users .= sprintf($l_g_user_s, $guests_online);
	$l_online_users .= '.';

	$l_online_record = sprintf($user->lang['RECORD_ONLINE_USERS'], $config['record_online_users'], $user->format_date($config['record_online_date']));

	$l_online_time = ($config['load_online_time'] == 1) ? 'VIEW_ONLINE_TIME' : 'VIEW_ONLINE_TIMES';
	$l_online_time = sprintf($user->lang[$l_online_time], $config['load_online_time']);
}
else
{
	$l_online_time = '';
}


$template->assign_vars(array(
	'TOTAL_USERS_ONLINE'	=> $l_online_users,
	'LOGGED_IN_USER_LIST'	=> $online_userlist,
	'L_ONLINE_EXPLAIN'		=> $l_online_time,
	'RECORD_USERS'			=> $l_online_record,
	'U_VIEWONLINE'			=> append_sid("{$phpbb_root_path}viewonline.$phpEx"),
	'OU_PORTAL_DEBUG'		=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0'),
));

$template->set_filenames(array(
	'body' => 'blocks/block_online_users.html',
	)
);

?>