<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   Sun Feb 13, 2005
* @copyright (c) 2008 phpbbireland
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: portal.php 291 2009-10-23 13:14:56Z Michaelo $
* Updated: 01 September 2010
*
*/

/**
*/

/**
* @ignore
*/
	define('IN_PHPBB', true);

	$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
	$phpEx = substr(strrchr(__FILE__, '.'), 1);
	include($phpbb_root_path . 'common.' . $phpEx);
	include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

	if (!STARGATE)
	{
		redirect(append_sid("{$phpbb_root_path}index.$phpEx"));
	}

	// Start session management
	$user->session_begin();
	$auth->acl($user->data);
	$user->setup('portal/portal');

	global $k_config;
	$sgp_cache_time = $k_config['sgp_cache_time'];

	$sgp_cache_time = 0;

	$portal_page = request_var('portal_page', 0);

	$sql = "SELECT id, body, page_name, page_desc 
		FROM ". K_WEB_PAGES_TABLE . " 
		WHERE id = '$portal_page' ";

	if (!$result = $db->sql_query($sql, $sgp_cache_time)) 
	{ 
		trigger_error($user->lang['COULD_NOT_QUERY_K_MODULES'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__); 
	}
	$row = $db->sql_fetchrow($result);

	$idone = $row['id'];
	$portal_body = $row['body'];
	$p_page_name = $row['page_name'];
	$p_page_desc = $row['page_desc'];

	$db->sql_freeresult($result);

	display_forums('', $config['load_moderators']);

//	$user->add_lang('portal/portal');
//	include_once($phpbb_root_path . 'includes/sgp_functions.'. $phpEx );
//	include_once($phpbb_root_path . 'includes/sgp_portal_blocks.' . $phpEx);

	// Set some stats, get posts count from forums data if we... hum... retrieve all forums data
	$total_posts	= $config['num_posts'];
	$total_topics	= $config['num_topics'];
	$total_users	= $config['num_users'];

	$l_total_user_s = ($total_users == 0) ? 'TOTAL_USERS_ZERO' : 'TOTAL_USERS_OTHER';
	$l_total_post_s = ($total_posts == 0) ? 'TOTAL_POSTS_ZERO' : 'TOTAL_POSTS_OTHER';
	$l_total_topic_s = ($total_topics == 0) ? 'TOTAL_TOPICS_ZERO' : 'TOTAL_TOPICS_OTHER';

	// Do we want to arrange the blocks ? //
	$arrange = (int)request_var('arrange', false);
	if ($arrange)
	{
		$cookie_name = '';
		$cookie_name = str_replace($config['cookie_name'] . '_', '', $cookie_name);
	}

	// Grab group details for legend display
	if ($auth->acl_gets('a_group', 'a_groupadd', 'a_groupdel'))
	{
		$sql = 'SELECT group_id, group_name, group_colour, group_type
			FROM ' . GROUPS_TABLE . '
			WHERE group_legend = 1
			ORDER BY group_name ASC';
	}
	else
	{
		$sql = 'SELECT g.group_id, g.group_name, g.group_colour, g.group_type
			FROM ' . GROUPS_TABLE . ' g
			LEFT JOIN ' . USER_GROUP_TABLE . ' ug
				ON (
					g.group_id = ug.group_id
					AND ug.user_id = ' . $user->data['user_id'] . '
					AND ug.user_pending = 0
				)
			WHERE g.group_legend = 1
				AND (g.group_type <> ' . GROUP_HIDDEN . ' OR ug.user_id = ' . $user->data['user_id'] . ')
			ORDER BY g.group_name ASC';
	}
	$result = $db->sql_query($sql, $sgp_cache_time);

	$legend = array();

	while ($row = $db->sql_fetchrow($result))
	{
		$colour_text = ($row['group_colour']) ? ' style="color:#' . $row['group_colour'] . '"' : '';
		$group_name = ($row['group_type'] == GROUP_SPECIAL) ? $user->lang['G_' . $row['group_name']] : $row['group_name'];

		if ($row['group_name'] == 'BOTS' || ($user->data['user_id'] != ANONYMOUS && !$auth->acl_get('u_viewprofile')))
		{
			$legend[] = '<span' . $colour_text . '>' . $group_name . '</span>';
		}
		else
		{
			$legend[] = '<a' . $colour_text . ' href="' . append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=group&amp;g=' . $row['group_id']) . '">' . $group_name . '</a>';
		}
	}
	$db->sql_freeresult($result);

	$legend = implode(', ', $legend);

	// Generate birthday list if required ...
	$birthday_list = '';
	if ($config['load_birthdays'] && $config['allow_birthdays'])
	{
		$now = getdate(time() + $user->timezone + $user->dst - date('Z'));
		$sql = 'SELECT user_id, username, user_colour, user_birthday
			FROM ' . USERS_TABLE . "
			WHERE user_birthday LIKE '" . $db->sql_escape(sprintf('%2d-%2d-', $now['mday'], $now['mon'])) . "%'
				AND user_type IN (" . USER_NORMAL . ', ' . USER_FOUNDER . ')';
		$result = $db->sql_query($sql, $sgp_cache_time);

		while ($row = $db->sql_fetchrow($result))
		{
			$birthday_list .= (($birthday_list != '') ? ', ' : '') . get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']);

			if ($age = (int) substr($row['user_birthday'], -4))
			{
				$birthday_list .= ' (' . ($now['year'] - $age) . ')';
			}
		}
		$db->sql_freeresult($result);
	}

	// Assign index specific vars
	$template->assign_vars(array(
		'BIRTHDAY_LIST'	=> $birthday_list,

		'FORUM_IMG'				=> $user->img('forum_read', 'NO_NEW_POSTS'),
		'FORUM_NEW_IMG'			=> $user->img('forum_unread', 'NEW_POSTS'),
		'FORUM_LOCKED_IMG'		=> $user->img('forum_read_locked', 'NO_NEW_POSTS_LOCKED'),
		'FORUM_NEW_LOCKED_IMG'	=> $user->img('forum_unread_locked', 'NO_NEW_POSTS_LOCKED'),

		'LEGEND'		=> $legend,
		'NEWEST_USER'	=> sprintf($user->lang['NEWEST_USER'], get_username_string('full', $config['newest_user_id'], $config['newest_username'], $config['newest_user_colour'])),

		'P_PAGE_DESC'	=> htmlspecialchars_decode($p_page_desc),
		'P_PAGE_NAME'	=> htmlspecialchars_decode($p_page_name),
		'PORTAL_BODY'	=> htmlspecialchars_decode($portal_body),

		'MOVE_IMG'		=> '<img src="./images/move.png"  alt="move" title="' . $user->lang['MOVE'] . '" height="13px" width="13px" />',
		'HIDE_IMG'		=> '<img src="./images/hide.png"  alt="hide" title="' . $user->lang['HIDE'] . '" height="13px" width="13px"/>',
		'SHOW_IMG'		=> '<img src="./images/show.png"  alt="show" title="' . $user->lang['SHOW'] . '" height="13px" width="13px"/>',

		'TOTAL_POSTS'	=> sprintf($user->lang[$l_total_post_s], $total_posts),
		'TOTAL_TOPICS'	=> sprintf($user->lang[$l_total_topic_s], $total_topics),
		'TOTAL_USERS'	=> sprintf($user->lang[$l_total_user_s], $total_users),

		'S_ARRANGE' 				=> $arrange,
		'S_DISPLAY_BIRTHDAY_LIST'	=> ($config['load_birthdays']) ? true : false,
		'S_IS_PORTAL'				=> true,
		'S_LOGIN_ACTION'			=> append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=login'),

		'U_MARK_FORUMS'		=> ($user->data['is_registered'] || $config['load_anon_lastread']) ? append_sid("{$phpbb_root_path}index.$phpEx", 'hash=' . generate_link_hash('global') . '&amp;mark=forums') : '',
		'U_MCP'				=> ($auth->acl_get('m_') || $auth->acl_getf_global('m_')) ? append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=main&amp;mode=front', true, $user->session_id) : '')
	);

	// Output page
	page_header($user->lang['PORTAL']);

	$template->set_filenames(array(
		'body' => 'portal_page.html')
	);

	page_footer();

?>