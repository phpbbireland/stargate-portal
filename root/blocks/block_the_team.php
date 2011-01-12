<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   Thursday, January 1st, 2006
* @copyright (c) 2005-2008 phpbbireland
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_the_team.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* Updated: 29 July 2008
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
* 30 September 2010 Mike
* Avoid reprocessing data if already available... every little helps ;) 
**/

global $k_config, $phpbb_root_path, $web_path, $k_blocks;

foreach ($k_blocks as $blk)
{
	if ($blk['html_file_name'] == 'block_the_team.html')
	{
		$block_cache_time = $blk['block_cache_time']; 
	}
}

$block_cache_time = (isset($block_cache_time) ? $block_cache_time : $k_config['block_cache_time_default']);

$block_cache_time = $k_config['block_cache_time_default'];
$queries = $cached_queries = 0;
$store = '';
$change = true;

// Rework of memberlist.php to create blook_team.
// The aim is to display an image to reflect the user default group

// initialise variables
$poster_image_icon = '';

$admin_ary = $auth->acl_get_list(false, array('a_', 'm_'), false);

$admin_id_ary = $global_mod_id_ary = array();

foreach ($admin_ary as $auth_id => $auth_ary)
{
	foreach ($auth_ary as $auth_option => $id_ary)
	{
		if (!$auth_id)
		{
			if ($auth_option == 'a_')
			{
				$admin_id_ary = array_merge($admin_id_ary, $id_ary);
			}
			else
			{
				$global_mod_id_ary = array_merge($global_mod_id_ary, $id_ary);
			}
			continue;
		}
	}
}

$admin_id_ary = array_unique($admin_id_ary);
$global_mod_id_ary = array_unique($global_mod_id_ary);
		
// Admin group id...
$sql = 'SELECT group_id, group_colour, group_name
	FROM ' . GROUPS_TABLE . "
	WHERE group_name = 'ADMINISTRATORS' || group_name ='STAFF'";
$result = $db->sql_query($sql, $block_cache_time);

$admin_group_id = (int) $db->sql_fetchfield('group_id');
$db->sql_freeresult($result);

$sql = $db->sql_build_query('SELECT', array(
		'SELECT' => 'u.user_id, u.group_id as default_group, u.username, u.user_colour, u.username_clean,  g.group_id, g.group_name, g.group_colour, g.group_type',

		'FROM' => array(
			USERS_TABLE		=> 'u',
			GROUPS_TABLE	=> 'g'
		),

		'WHERE' => $db->sql_in_set('u.user_id', array_unique(array_merge($admin_id_ary, $global_mod_id_ary)), false, true) . '
			AND u.group_id = g.group_id',
		'ORDER_BY'	=> 'g.group_name ASC, u.username_clean ASC'
));
$result = $db->sql_query($sql, $block_cache_time);

while ($row = $db->sql_fetchrow($result))
{
	$which_row = (in_array($row['user_id'], $admin_id_ary)) ? 'admin' : 'mod';

	// We sort out admins not having the admin group as default
	// The drawback is that only those admins are displayed which are within
	// the special group 'Administrators' and also having it assigned as their default group.
	// - might change
	if ($which_row == 'admin' && $row['default_group'] != $admin_group_id)
	{
		// Remove from admin_id_ary, because the user may be a mod instead
		unset($admin_id_ary[array_search($row['user_id'], $admin_id_ary)]);

		if (!in_array($row['user_id'], $global_mod_id_ary))
		{
			continue;
		}
		else
		{
			$which_row = 'mod';
		}
	}

	// The person is moderating several "public" forums, therefore the person should be listed, but not giving the real group name if hidden.
	if ($row['group_type'] == GROUP_HIDDEN && !$auth->acl_gets('a_group', 'a_groupadd', 'a_groupdel') && $row['ug_user_id'] != $user->data['user_id'])
	{
		$group_name = $user->lang['GROUP_UNDISCLOSED'];
		$u_group = '';
	}
	else
	{
		$group_name = ($row['group_type'] == GROUP_SPECIAL) ? $user->lang['G_' . $row['group_name']] : $row['group_name'];
		$u_group = append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=group&amp;g=' . $row['group_id']);
	}

	$group_img = strtolower($group_name);
	$group_img = str_replace(' ' , '_', $group_img);

	// Use the code below to check for team images in the user style... If they don’t exist use default in ./image/teams //
	if(file_exists($phpbb_root_path . 'styles/' . $user->theme['theme_path'] . '/theme/images/teams/' . $group_img . '.png'))
	{
		$group_image_path = $phpbb_root_path . 'styles/' . $user->theme['theme_path'] . '/theme/images/teams/';
	}
	else
	{
		$group_image_path = $phpbb_root_path . 'images/teams/';

		if (!file_exists($group_image_path . $group_img . '.png'))
		{
			$group_img = 'default';
		}
	}


	if($store != $group_name)
	{
		$change = true;
	}
	else
	{
		$change = false;
	}

	$template->assign_block_vars('sgp_' . $which_row, array(
		'S_CHANGE'			=> $change,

		'GROUP_IMG_PATH'	=> $group_image_path,
		'GROUP_IMG'			=> $group_img,
		'GROUP_NAME'		=> $group_name,
		'GROUP_COLOR'		=> $row['group_colour'],
		'USER_ID'			=> $row['user_id'],
		'USERNAME_FULL'		=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
	));

	$store = $group_name;

}
$db->sql_freeresult($result);

$template->assign_vars(array(
	'THE_TEAM_DEBUG'	=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0', ($total_queries) ? $total_queries : '0'),
));

?>