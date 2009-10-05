<?php
/*************************************************************************************
* block_header_menus.php
* -------------------
* begin : Sunday, 04th November, 2007
* copyright : (C) 2007 Michael O'Toole - aka Michaelo
* website : http://www.phpbbireland.com
* email : o2l@eircom.net
* last update : July 24, 2008 19:39
*
* licence : GPL vs2.0 [ see /docs/COPYING ]
* note: Do not remove this copyright. Just append yours if you have modified it.
************************************************************************************/

/************************************************************************************
*
* This program is free software; you can redistribute it and/or modify it under
* the terms of the GNU General Public License as published by the Free Software
* Foundation; either version 2 of the License, or any later version.
*
************************************************************************************/

if ( !defined('IN_PHPBB') )
{
	exit;
}
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';

$phpEx = substr(strrchr(__FILE__, '.'), 1);

$user->add_lang('portal/portal_blocks_variables');

include_once($phpbb_root_path . 'includes/sgp_functions.'. $phpEx );

global $db, $user, $_SID, $_EXTRA_URL;
global $group_name, $k_groups;

// menu_type 0 = Header Menu,
// menu type 1 = Main Nav blocks,
// menu type 2 = Sub Nav Block

$j = 0;
$k_groups = '';
$loop_count = 0;
$portal_header_menus = array();
$my_names = array();

$sql = "SELECT * FROM ". K_MENUS_TABLE . "
WHERE menu_type = 0 && view_by != 0
ORDER BY ndx ASC ";

if (!$result = $db->sql_query($sql))
{
trigger_error("Could not query portal menus information");
}

while( $row = $db->sql_fetchrow($result) )
{
$portal_header_menus[] = $row;
}
$db->sql_freeresult($result);

$group_name = which_group($user->data['group_id']); // change to get_group_name

get_all_groups();

for ($i = 0; $i < count($portal_header_menus); $i++)
{
$name = strtoupper($portal_header_menus[$i]['name']); // convert to uppercase //
$tmp_name = str_replace(' ','_', $portal_header_menus[$i]['name']); // replace spaces with underscore //

$name = (!empty($user->lang[$tmp_name])) ? $user->lang[$tmp_name] : $portal_header_menus[$i]['name']; // get language equivalent //

$menu_item_view_by = $portal_header_menus[$i]['view_by'];

$s_id = ''; // initiate our var session s_id, if we need to pass session id
$u_id = ''; // initiate our var user u_id, if we need to pass user id
$isamp = ''; // initiate our var isamp, if we need to use it

$process_menu_item = false;

$menu_item_view_by = $portal_header_menus[$i]['view_by'];

// Advanced group options...

foreach ($k_groups as $group)
{
$loop_count++;
if(strtoupper($group) == strtoupper($group_name))
{
switch($group_name)
{
case 'Guests':
case 'GUESTS': if($menu_item_view_by == 1) $process_menu_item = true;
break;
case 'Registered':
case 'REGISTERED': if($menu_item_view_by < 4) $process_menu_item = true;
break;
case 'Registered Coppa':
case 'REGISTERED_COPPA': if($menu_item_view_by < 4) $process_menu_item = true;
break;
case 'Global Moderators':
case 'GLOBAL_MODERATORS': if($menu_item_view_by < 5) $process_menu_item = true;
break;
case 'Administrators':
case 'ADMINISTRATORS': if($menu_item_view_by != 0) $process_menu_item = true;
break;
case 'Bots':
case 'BOTS': if($menu_item_view_by == 1 || $menu_item_view_by == 6) $process_menu_item = true;
break;

default: if($menu_item_view_by == $loop_count || $menu_item_view_by < 3) $process_menu_item = true;
}
}
}
$loop_count = 0;

if($portal_header_menus[$i]['append_uid'] == 1) // do we need to pass user id //
{
$isamp = '&amp';
$u_id = $user->data['user_id'];
}
else
{
$u_id = '';
$isamp = '';
}

if($portal_header_menus[$i]['append_sid'] == 1) // do we need to pass user session id //
{
$s_id = '?sid=';
$s_id .= $user->session_id;
}
else
$s_id = '';


if($process_menu_item && $portal_header_menus[$i]['sub_heading']) $j++;

if($process_menu_item)
{
$template->assign_block_vars('portal_header_menus_row_' . $j, array(
'PORTAL_HEADER_MENU_NAME' => $name,
'U_PORTAL_HEADER_MENU_LINK' => ($portal_header_menus[$i]['sub_heading']) ? '' : append_sid("{$phpbb_root_path}" . $portal_header_menus[$i]['link_to'] . $s_id . $u_id),
'PORTAL_HEADER_MENU_ICON' => ($portal_header_menus[$i]['menu_icon'] == 'NONE') ? '' : $portal_header_menus[$i]['menu_icon'],
'S_SOFT_HR' => $portal_header_menus[$i]['soft_hr'],
'S_SUB_HEADING' => ($portal_header_menus[$i]['sub_heading']) ? true : false,
'S_COUNT' => $i,
'S_MENU' => $j,
));

// save the menu name for processing later //
if(($portal_header_menus[$i]['sub_heading']))
$my_names[$j] = $name;
}
}

$template->assign_vars(array(
'T_IMAGESET_PATH' => "{$phpbb_root_path}styles/" . $user->theme['imageset_path'] . '/imageset',
'T_THEME_PATH' => "{$phpbb_root_path}styles/" . $user->theme['theme_path'] . '/theme',
'S_USER_LOGGED_IN' => ($user->data['user_id'] != ANONYMOUS) ? true : false,
'U_INDEX' => "{$phpbb_root_path}index.$phpEx$SID",
'U_PORTAL' => "{$phpbb_root_path}portal.$phpEx$SID",
'S_NO_OF_MENUS' => $j,
'S_MAIN_H_1' => !empty($my_names[1]) ? $my_names[1] : '',
'S_MAIN_2' => !empty($my_names[2]) ? $my_names[2] : '',
'S_MAIN_3' => !empty($my_names[3]) ? $my_names[3] : '',
'S_MAIN_4' => !empty($my_names[4]) ? $my_names[4] : '',
'S_MAIN_5' => !empty($my_names[5]) ? $my_names[5] : '',
));
?>