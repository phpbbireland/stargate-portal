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

$queries = 0;
$cached_queries = 0;

// rework of code from memberlist.php and memberlist.php + to create blook_team. Still under construction
// The aim is to display an image to reflect the user default group 

// initialise variables
$poster_image_icon = '';

// What do you want to do today? ... oops, I think that line is taken ...
// Display a listing of board admins, moderators
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
		$sql = 'SELECT group_id, group_colour
			FROM ' . GROUPS_TABLE . "
			WHERE group_name = 'ADMINISTRATORS' || group_name ='STAFF'";
		$result = $db->sql_query($sql, 600);
		$admin_group_id = (int) $db->sql_fetchfield('group_id');
		$db->sql_freeresult($result);

		$sql = $db->sql_build_query('SELECT', array(
			'SELECT'	=> 'u.user_id, u.group_id as default_group, u.username, u.user_colour, g.group_id, g.group_name',

			'FROM'		=> array(
				USERS_TABLE		=> 'u',
				GROUPS_TABLE	=> 'g'
			),

			'WHERE'		=> $db->sql_in_set('u.user_id', array_unique(array_merge($admin_id_ary, $global_mod_id_ary)), false, true) . '
				AND u.group_id = g.group_id',

			'ORDER_BY'	=> 'g.group_name ASC, u.username_clean ASC'
		));
		$result = $db->sql_query($sql, 600);

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

			$template->assign_block_vars($which_row, array(
				'USER_ID'		=> $row['user_id'],
				'USERNAME_FULL'		=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
				//'COUNTRY_FLAG_IMG' => '<img src="' .(sgp_get_user_country_flag($row['user_id'])). '" alt="" />',
			));
		}
		$db->sql_freeresult($result);

$template->assign_vars(array(
	'T_PORTAL_DEBUG'	=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0'),
));

?>