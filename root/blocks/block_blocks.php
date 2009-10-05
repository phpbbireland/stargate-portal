<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   Saturday, April 1st, 2005
* @copyright (c) 2005-2008 phpbbireland
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_blocks.php 336 2009-01-23 02:06:37Z Michealo $
* Updated:
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

global $db, $theme, $php_root_path;
$i = 0;

//$user->add_lang('portal_blocks/block_blocks_vars');	

$blocks = array();
$sql = "SELECT * FROM ". K_BLOCKS_TABLE . " 
	WHERE active = 1 && view_by != 0
	ORDER BY 'ndx' ASC ";
$result = $db->sql_query($sql);

while($row = $db->sql_fetchrow($result))
{
	$title = strtoupper($row['title']);
	$title = str_replace(' ','_', $row['title']);
	$title = (!empty($user->lang[$title])) ? $user->lang[$title] : $title;

	
	$template->assign_block_vars('blocks', array(
		'BLOCK_ID'           => $row['id'],
		'BLOCK_NAME'         => $title,
		'BLOCK_ALLOW_VIEW'   => ($row['view_by'] != 0) ? true : false,
		'BLOCK_FILENAME'     => $row['html_file_name'],			
		'BLOCK_POSITION'     => $row['position'],
	
	));							
}	
$db->sql_freeresult($result);

$template->assign_vars(array(
	'T_IMAGESET_PATH'		=> "{$phpbb_root_path}styles/" . $user->theme['imageset_path'] . '/imageset',
	'T_THEME_PATH'			=> "{$phpbb_root_path}styles/" . $user->theme['theme_path'] . '/theme',
	
	'S_USER_LOGGED_IN'	=> ($user->data['user_id'] != ANONYMOUS) ? true : false,	
		'SITE_NAME'          => $config['sitename'],
		'AVATAR'             => get_user_avatar($user->data['user_avatar'], $user->data['user_avatar_type'], $user->data['user_avatar_width'], $user->data['user_avatar_height']),
		'USER_NAME'          => $user->data['username'],
		'USERNAME_FULL'	     => get_username_string('full', $user->data['user_id'], $user->data['username'], $user->data['user_colour']),

		'READ_ARTICLE_IMG'	 => $user->img('btn_read_article', 'READ_ARTICLE'),	
		'POST_COMMENTS_IMG'	 => $user->img('btn_post_comments', 'POST_COMMENTS'),
		'VIEW_COMMENTS_IMG'	 => $user->img('btn_view_comments', 'VIEW_COMMENTS'),
		'U_INDEX'	         => "{$phpbb_root_path}index.$phpEx$SID",
		'U_PORTAL' 	         => "{$phpbb_root_path}portal.$phpEx$SID",
		'U_STAFF'	         => append_sid("{$phpbb_root_path}memberlist.$phpEx", '?mode=leaders'),
		'U_SEARCH_BOOKMARKS' => append_sid("{$phpbb_root_path}ucp.$phpEx", '&amp;i=main&mode=bookmarks'),
));

?>