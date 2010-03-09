<?php
if (!defined('IN_PHPBB'))
{
	exit;
}

/* MENUS [English] */
/* DO NOT CHANGE */

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// phpbbportal profile fields
$lang = array_merge($lang, array(

	'TITLE' 			=> 'Stargate (aka Kiss) Menu Manager (Administration)',
	'TITLE_EXPLAIN'		=> 'Here you can Add, Edit and Delete Menus. Header Menu (type 0, at top of page/header), Navigation Menu (type 1, in main Nav block, and Sub Menu (type 2, in Sub menu block).<br />Legend: NDX = Index or sort order, Icon = Menu Icon (each menu item can have a different icon), Alt = Alternative text, Link = Link to whatever... Menu icons are located in images/block_images directory.<br />',
	'ACP_MENUS' 		=> 'Menus',
		
	'MENUS_HEADER_ADMIN'	=> 'Menu Management',
	'MENUS_ADD_HEADER'		=> 'Add a menu item: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; [Select Type: 0 = Header Menu, &nbsp; 1 = Nav Menu, &nbsp;  2 = Sub Menu]',
	'MENUS_EDIT'			=> 'Edit Menu.',
	'MENU_ICONS_HEADER'		=> 'Manage Menu Icons ',
	'MENU_DISABLED'			=> 'Dis',
	'MENU_DISABLED_BIG'		=> 'MENU is Disabled',
	'MENU_ACTIVE'			=> 'A',
	'MENU_ACTIVE_BIG'		=> 'MENU is Active',
	'MENU_TYPE_BIG'			=> 'File Type',
	'MENU_VIEW_BY_SHORT'	=> 'Allow View By',
	'MENU_VIEWED_BY' 			=> 'Which groups can view this menu item?',
	'MENU_VIEWED_BY_EXPLAINED'	=> '<br />For additional groups, obtain group ID\'s from ACP, Manage Groups',
	'MENU_ITEM_NAME'			=> 'Menu item name',
	'MENU_ITEM_NAME_EXPLAIN'	=> 'The menu item title will be replaced by the appropriate lang var if they exist in the lang block_menus_vars.php, else the value shown here will be used.',
	'MENU'					=> 'Menu',
	'MENUID' 				=> 'ID',
	'MENU_ID' 				=> 'ID',
	'MENU_ID_BIG'			=> 'Menu ID (Auto)',
	'MENU_ADD'				=> 'Add',
	'MENU_ADD_NEW'			=> 'Add a New Menu Option',	
	'MENU_ADDED'			=> 'Menu added!',	
	'MENU_EDIT'				=> 'Edit',
	'MENU_EDITED'			=> 'Menu edited!',	
	'MENU_DELETE' 			=> 'Del.',
	'MENU_UP' 				=> 'Up',
	'MENU_DOWN' 			=> 'Dn',
	'MENU_LINK'				=> 'Menu link',
	'MENU_LINK_BIG'			=> 'Link to file',
	'MENU_LINK_EXPLAIN'		=> 'Link associated with this menu item.',
	'MENU_ICON_ALT_TEXT'	=> 'Image alt text',
	'MENU_ICON_THIS'		=> ' current icon = ',
	'MENU_ICON'				=> 'Menu Icon',
	'MENU_ICONS'			=> 'Menu icon images found',
	'MENU_ICON_BIG'			=> 'Menu item image',
	'MENU_NDX'				=> 'NDX',
	'MENU_NDX_BIG'			=> 'Menu Index (for sort order)',
	'MENU_TYPE'				=> 'Type',
	'MENU_TYPE_HEADER'		=> 'Header Menu',
	'MENU_TYPE_BLOCK_NAV'	=> 'Nav Menu',
	'MENU_TYPE_BLOCK_SUB'	=> 'Sub Menu',
	'MENU_TYPE_FOOTER'		=> 'Footer Menu',
	'MENU_TYPE_OTHER'		=> 'Unassigned',
	'MENU_UPDATED'			=> 'Menu updated',
	'MENU_TYPE_EXPLAIN'		=> 'The position of the menu.',
	'MENU_VIEW_BY'			=> 'View by',
	'DO_NOT_EDIT'			=> 'Note: Do not edit this value',
	'PROCESS'				=> 'process',
	'ICON'					=> 'Icon',
	'MENU_ICON_COUNT'		=> 'Available Icons ',
	'MENU_ICON_EXPLAIN'		=> 'Icon for this menu item. ',
	'MANAGE_MENU_ICONS'	=> 'Manage Menu Icons: ',
	
	'HEADER_MENU'		=> 'Header Menu',
	'NAV_MENU'			=> 'Navigation Menu',
	'SUB_MENU'			=> 'Sub Menu',
	'MENUS_ALL_ITEMS'	=> 'All Menus and Items',
	'OTHER_MENUS'		=> 'Other Menus',
	'UNKNOW_MENU'		=> 'Unknown Menu/Option',	
	'CREATE'			=> 'Create Menu',
	'ALL_MENUS'			=> 'Show All Menu Items',
	'MISC'				=> 'Manage Unallocated Items',
	
	'MENU_NAME_1'		=> 'Header Menu',
	'MENU_NAME_2'		=> 'Navigation Menu',
	'MENU_NAME_3'		=> 'Sub Menu',
	'MENU_ICON_IMG'		=> 'available icon images',
	
	'CONFIRM_OPERATION_MENUS'		=> 'Do you wish to delete this Menu?',
	'MUST_SELECT_VALID_MENU_DATA'	=> 'Invalid menu ID.',

	'MENU_APPEND_SID_BIG'	=> 'Append SID to link.',
	'MENU_APPEND_UID_BIG'	=> 'Append UID to link.',
	'MENU_APPEND_SID'	=> 'SID',
	'MENU_APPEND_UID'	=> 'UID',
	'MENU_APPEND_SID_EXPLAIN'	=> 'The SID, may be required by code/blocks.',
	'MENU_APPEND_UID_EXPLAIN'	=> 'The user ID may be required by code/blocks.',
	'SOFT_HR'					=> 'Add a soft return (image or spacer) between this and the next menu item',
	'SOFT_HR_EXPLAIN'			=> 'You can use this to group menu items...',
	'SUB_HEADING'				=> '<span style="font-style:italic"> Menu Sub Heading</span>',
	'SUB_HEADING_EXPLAIN'		=> 'This is a Menu Sub Heading... no links allowed.',
	'HEAD'	=> 'Header',
	'NAV'	=> 'Nav',
	'SUB'	=> 'Sub',
	'FOOT'	=> 'Footer',
	'ADD_ICON'	=> 'Add new icon',
	'MENU_MOVE_ERROR' => 'The ndx\'s values are not consecutive, or you are trying to move a menu item out of its group...<br />Go back and manually correct the ndx values, then try again. ',
));
// Message Settings
$lang = array_merge($lang, array(
	'ACP_MESSAGE_SETTINGS_EXPLAIN'	=> 'Here you can set all default settings for private messaging',
));

?>