<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   Saturday, 15th November, 2005
* @copyright (c) 2005-2008 phpbbireland
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_sub_menus.php 324 2009-01-17 01:23:22Z Michealo $
* Updated: 15 November 2008 by NeXur
*
*/

/**
* @ignore
*/

	if (!defined('IN_PHPBB'))
	{
		exit;
	}

	$phpEx = substr(strrchr(__FILE__, '.'), 1);

	$queries = $cached_queries = 0;

	$user->add_lang('portal/portal_blocks_variables');

	include($phpbb_root_path . 'includes/sgp_functions.'. $phpEx );

	global $db, $user, $_SID, $_EXTRA_URL, $k_config, $k_blocks, $k_groups;

	foreach ($k_blocks as $blk)
	{
		if ($blk['html_file_name'] == 'block_sub_menus.html')
		{
			$block_cache_time = $blk['block_cache_time']; 
		}
	}
	$block_cache_time = (isset($block_cache_time) ? $block_cache_time : $k_config['block_cache_time_default']);

	// menu_type 0 = Header Menu,
	// menu type 1 = Main Nav blocks,
	// menu type 2 = Sub Nav Block

	$j = 0;
	$is_sub_heading = false;

	$loop_count = array();
	$portal_sub_menus = array();
	$my_names = array();

	$sql = "SELECT * FROM ". K_MENUS_TABLE . "
		WHERE menu_type = 2 && view_by != 0
		ORDER BY ndx ASC";

	if (!$result = $db->sql_query($sql, $block_cache_time))
	{
		trigger_error($user->lang['ERROR_PORTAL_SUB_MENU'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
	}

	$portal_sub_menus = array();

	while ($row = $db->sql_fetchrow($result))
	{
		$portal_sub_menus[] = $row;
	}
	$db->sql_freeresult($result);

	// $group_name = which_group($user->data['group_id']);  // change to get_group_name - do we need this one anymore? see below...

	//get_all_groups();

	$memberships = array();
	$memberships = sgp_group_memberships(false, $user->data['user_id'], false);

	for ($i = 0; $i < count($portal_sub_menus); $i++)
	{
		$name = strtoupper($portal_sub_menus[$i]['name']);						// convert to uppercase //
		$tmp_name = str_replace(' ','_', $portal_sub_menus[$i]['name']);        // replace spaces with underscore //

		$name = (!empty($user->lang[$tmp_name])) ? $user->lang[$tmp_name] : $portal_sub_menus[$i]['name'];   // get language equivalent //

		//$menu_item_view_by = $portal_sub_menus[$i]['view_by'];

		$s_id = ''; 														// initiate our var session s_id, if we need to pass session id
		$u_id = ''; 														// initiate our var user u_id, if we need to pass user id
		$isamp = '';														// initiate our var isamp, if we need to use it

		$process_menu_item = false;

		$menu_item_view_by = $portal_sub_menus[$i]['view_by'];

		// Advanced group options...
		if ($menu_item_view_by == 0)
		{
			$process_menu_item = false;
		}
		else
		{
			if ($memberships)
			{
				foreach ($memberships as $member)
				{
					$group_name = $k_groups[$member['group_id']]['group_name'];

					if($menu_item_view_by == $member['group_id'])// || $member['group_id'] == $k_group_name_id['ADMINISTRATORS'])
					{
						$process_menu_item = true;
					}
					else
					{
						$loop_count++;
						switch($group_name)
						{
							case 'Guests':
							case 'GUESTS':
							case 'Anonymous':
							case 'ANONYMOUS':			if($menu_item_view_by == 1 || $menu_item_view_by == $k_group_name_id['GUESTS']) $process_menu_item = true;
							break;
							case 'Registered':
							case 'REGISTERED':			if($menu_item_view_by < 4 || $menu_item_view_by < $k_group_name_id['GLOBAL_MODERATORS']) $process_menu_item = true;
							break;
							case 'Registered Coppa':
							case 'REGISTERED_COPPA':	if($menu_item_view_by < 4 || $menu_item_view_by < $k_group_name_id['GLOBAL_MODERATORS']) $process_menu_item = true;
							break;
							case 'Global Moderators':
							case 'GLOBAL_MODERATORS':	if($menu_item_view_by < 5 || $menu_item_view_by < $k_group_name_id['ADMINISTRATORS']) $process_menu_item = true;
							break;
							case 'Bots':
							case 'BOTS':				if($menu_item_view_by ==  1 || $menu_item_view_by ==  6 || $menu_item_view_by ==  $k_group_name_id['GUESTS'] || $menu_item_view_by ==  $k_group_name_id['BOTS']) $process_menu_item = true;
							break;
							
							default:					if($menu_item_view_by == $loop_count || $menu_item_view_by < 3 || $menu_item_view_by < $k_group_name_id['REGISTERED_COPPA']) $process_menu_item = true;
						}
					}
				}
				$loop_count = 0;
			}
			else
			{
				$process_menu_item = false;
			}
		}
		
		if ($portal_sub_menus[$i]['append_uid'] == 1)							// do we need to pass user id //
		{
			$isamp = '&amp';
			$u_id = $user->data['user_id'];
		}
		else
		{
			$u_id = '';
			$isamp = '';
		}

		if ($portal_sub_menus[$i]['append_sid'] == 1)							// do we need to pass user session id //
		{
			$s_id = '?sid=';
			$s_id .= $user->session_id;
		}
		else
		{
			$s_id = '';
		}

		if ($process_menu_item && $portal_sub_menus[$i]['sub_heading'])
		{
			$j++;
		}

		if ($process_menu_item)
		{

			if (strstr($portal_sub_menus[$i]['link_to'], 'http'))
			{
				$link = ($portal_sub_menus[$i]['link_to']) ? $portal_sub_menus[$i]['link_to'] : '';
			}
			else
			{
				$link = ($portal_sub_menus[$i]['link_to']) ? append_sid("{$phpbb_root_path}" . $portal_sub_menus[$i]['link_to'] . $s_id . $u_id) : '';
			}

			$is_sub_heading = ($portal_sub_menus[$i]['sub_heading']) ? true : false;

			$template->assign_block_vars('portal_sub_menus_row', array(
				'EXTERN'					=> $portal_sub_menus[$i]['extern'],
				'PORTAL_SUB_MENU_HEAD_NAME'	=> ($is_sub_heading) ? $name : '',
				'PORTAL_SUB_MENU_NAME'		=> ($is_sub_heading) ? '' : $name,
				'U_PORTAL_SUB_MENU_LINK'	=> ($is_sub_heading) ? '' : $link,
				'PORTAL_SUB_MENU_ICON'		=> ($portal_sub_menus[$i]['menu_icon'] == 'NONE') ? '' : '<img src="' . $phpbb_root_path . 'images/block_images/small/' . $portal_sub_menus[$i]['menu_icon'] . '" alt="" />',
				'S_SOFT_HR'					=> ($is_sub_heading) ? $portal_sub_menus[$i]['soft_hr'] : '',
				'S_SUB_HEADING' 			=> ($is_sub_heading) ? true : false,
			));
		}
	}

	$template->assign_vars(array(
		'S_USER_LOGGED_IN'	=> ($user->data['user_id'] != ANONYMOUS) ? true : false,
		'U_INDEX'			=> append_sid("{$phpbb_root_path}index.$phpEx"),
		'U_PORTAL'			=> append_sid("{$phpbb_root_path}portal.$phpEx"),
		'SUB_MENUS_DEBUG'	=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0', ($total_queries) ? $total_queries : '0'),
	));

?>