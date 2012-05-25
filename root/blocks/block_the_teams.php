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

global $k_config, $phpbb_root_path, $web_path, $k_blocks, $k_groups;

// initialise variables //

$queries = $cached_queries = 0;
$store = '';
$change = true;
$i = 0;
$poster_image_icon = '';
$group_names = array();

$limit_reached = $team_count = 0;
$team_max_count = $k_config['number_of_team_members_to_display'];
$sql_in = explode(",", $k_config['teams_to_display']);

foreach ($k_blocks as $blk)
{
	if ($blk['html_file_name'] == 'block_the_team.html')
	{
		$block_cache_time = $blk['block_cache_time'];
	}
}
$block_cache_time = (isset($block_cache_time) ? $block_cache_time : $k_config['block_cache_time_default']);

$sql = 'SELECT DISTINCT u.user_id, u.group_id, u.username, u.user_colour, u.username_clean, g.group_id, g.group_name, g.group_colour, g.group_type, ug.group_id
		FROM ' . USERS_TABLE . ' u, ' . GROUPS_TABLE . ' g, ' . USER_GROUP_TABLE . ' ug
			WHERE ug.group_id = g.group_id and u.user_id = ug.user_id
				AND ' . $db->sql_in_set('g.group_id', $sql_in) . '
				ORDER BY g.group_name ASC, u.group_id ASC, u.username_clean ASC';

$result = $db->sql_query($sql, $block_cache_time);

while ($row = $db->sql_fetchrow($result))
{
	$group_name = $row['group_name'];

	$which_row = strtolower($group_name);
	$which_row = str_replace(' ' , '_', $which_row);
	$group_img = strtolower($row['group_name']);
	$group_img = str_replace(' ' , '_', $group_img);

	// Use the code below to check for team images in the user style... If they don�t exist use default in ./image/teams //
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


	// conver to proper case and remove underscores //
	$group_name = mb_convert_case($group_name, MB_CASE_TITLE, "UTF-8");
	$group_name	= str_replace('_' , ' ', $group_name);

	if($store != $group_name)
	{
		$change = true;
		$team_count = 0;
	}
	else
	{
		$change = false;
		$team_count = $team_count + 1;
	}

	if($team_count < $team_max_count)
	{
		$template->assign_block_vars('loop', array(
			'FIRST'				=> $i++,
			'S_CHANGE'			=> $change,

			'GROUP_IMG_PATH'	=> $group_image_path,
			'GROUP_IMG'			=> $group_img,
			'GROUP_NAME'		=> $group_name,
			'GROUP_COLOR'		=> $row['group_colour'],
			'USER_ID'			=> $row['user_id'],
			'USERNAME_FULL'		=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
		));
	}
	else
	{
		$limit_reached = $limit_reached + 1;
	}

	$store = $group_name;

	$template->assign_vars(array(
		'L_TEAM_MAX_COUNT'	=> ($limit_reached) ? sprintf($user->lang['TEAM_MAX_COUNT'], $team_max_count) : '',
	));
}

$db->sql_freeresult($result);

$template->assign_vars(array(
	'THE_TEAM_DEBUG'	=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0', ($total_queries) ? $total_queries : '0'),
));

?>