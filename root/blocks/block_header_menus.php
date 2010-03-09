<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   Sunday, 04th November, 2007
* @copyright (c) 2005-2008 phpbbireland
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_header_menus.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* Updated: November 4, 2007  13:34
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

// Retrieve Styles Status items from database //

	global $db, $user;

	// menu_type 0 = Header Menu,
	// menu type 1 = Main Nav blocks,
	// menu type 2 = Sub Nav Block

	// view_by with value of 5 is hidden i.e. not returned //
	// use auth to find if user can view each of the menu options //
	// not sure how this will work once the auth is complete but something like this //
	// 0 - 6 = none,all,guest,reg,staff,mod,admin
	/*
		'VIEW_BY'	=> $auth->acl_get('v_menu',$portal_header_menus[$i]['view_by'])
	*/

	$sql = "SELECT * FROM ". K_MENUS_TABLE . "
		WHERE menu_type = 0 && view_by != 0
		ORDER BY ndx ASC ";
	if (!$result1 = $db->sql_query($sql, 1200))
	{
		trigger_error('Error! Could not query portal menus information: ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
	}

	$portal_header_menus = array();

	while( $row1 = $db->sql_fetchrow($result1) )
	{
		$portal_header_menus[] = $row1;
	}


for ($i = 0; $i < count($portal_header_menus); $i++)
{
	//$user->add_lang('portal_blocks/block_menu_vars');

	$name = strtoupper($portal_header_menus[$i]['name']);						// convert to uppercase //
	$name = str_replace(' ','_', $portal_header_menus[$i]['name']);			// replace spaces with underscore //
	$name = (!empty($user->lang[$name])) ? $user->lang[$name] : $name;	// get language equivalent //


	$s_id = ''; 														// initiate our var session id, if we need to pass session id
	$u_id = ''; 														// initiate our var user id, if we need to pass user id

	if($portal_header_menus[$i]['append_u_id'] == 1)							// do we need to pass user id //
		$u_id = $user->data['user_id'];
	if($portal_header_menus[$i]['append_sid'] == 1)							// do we need to pass user session id //
		$s_id = $user->session_id;

	if($portal_header_menus[$i]['view_by'] != 0 ) // assign all if not hidden
	{
		if($portal_header_menus[$i]['view_by'] == 1) // view by all
		{
			$template->assign_block_vars('portal_header_menus_row', array(
				'PORTAL_HEADER_MENU_NAME' => $name,
				'U_PORTAL_HEADER_MENU_LINK' => append_sid($phpbb_root_path . $portal_header_menus[$i]['link_to'], '',true, $s_id),
				'PORTAL_HEADER_MENU_ICON' => ( $portal_header_menus[$i]['menu_icon'] == '') ? '' :  $portal_header_menus[$i]['menu_icon'],
			));
		}
		else
		if($portal_header_menus[$i]['view_by'] == 2 && $user->data['is_registered']) //view by registered
		{

			$template->assign_block_vars('portal_header_menus_row', array(
				'PORTAL_HEADER_MENU_NAME' => $name,
				'U_PORTAL_HEADER_MENU_LINK' => append_sid($phpbb_root_path . $portal_header_menus[$i]['link_to'] . $u_id, '',true, $s_id),
				'PORTAL_HEADER_MENU_ICON' => ( $portal_header_menus[$i]['menu_icon'] == '') ? '' :  $portal_header_menus[$i]['menu_icon'],
			));
		}
		else
		if($user->data['user_type'] == 3 && $user->data['is_registered']) // admin only
		{
			$template->assign_block_vars('portal_header_menus_row', array(
				'PORTAL_HEADER_MENU_NAME' => $name,
				'U_PORTAL_HEADER_MENU_LINK' => append_sid($phpbb_root_path."{$portal_header_menus[$i]['link_to']}", '',true, $user->session_id),
				'PORTAL_HEADER_MENU_ICON' => ($portal_header_menus[$i]['menu_icon'] == '') ? '' :  $portal_header_menus[$i]['menu_icon'],
			));
		}
		else
		if($portal_header_menus[$i]['view_by'] == 4 && $user->data['is_registered']) //view by moderators & staff
		{
			$template->assign_block_vars('portal_header_menus_row', array(
				'PORTAL_HEADER_MENU_NAME' => $name,
				'PORTAL_HEADER_MENU_LINK' => append_sid($phpbb_root_path . $portal_header_menus[$i]['link_to'], '',true, $user->session_id),
				'PORTAL_HEADER_MENU_ICON' => ($portal_header_menus[$i]['menu_icon'] == '') ? '' :  $portal_header_menus[$i]['menu_icon'],
			));
		}
	}
}

$template->assign_vars(array(
	'T_IMAGESET_PATH'		=> "{$phpbb_root_path}styles/" . $user->theme['imageset_path'] . '/imageset',
	'T_THEME_PATH'			=> "{$phpbb_root_path}styles/" . $user->theme['theme_path'] . '/theme',
	'S_USER_LOGGED_IN'		=> ($user->data['user_id'] != ANONYMOUS) ? true : false,
	'S_AUTOLOGIN_ENABLED'	=> ($config['allow_autologin']) ? true : false,
	'U_INDEX'				=> "{$phpbb_root_path}index.$phpEx$SID",
	'U_PORTAL'				=> "{$phpbb_root_path}portal.$phpEx$SID",
	'U_STAFF'				=> append_sid("{$phpbb_root_path}memberlist.$phpEx", '?mode=leaders'),
	'U_SEARCH_BOOKMARKS'	=> append_sid("{$phpbb_root_path}ucp.$phpEx", '&amp;i=main&mode=bookmarks'),
	'HM_PORTAL_DEBUG'		=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0'),
));
?>