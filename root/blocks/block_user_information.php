<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   Saturday, Jan 22, 2005
* @copyright (c) 2005-2008 phpbbireland
* @home    http://www.phpbbireland.com
* Code segments from various phpBB core copyright phpBB team.
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_user_information.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* Updated: 17 January 2008 03:39
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

global $user, $ranks, $config, $phpbb_root_path;

// allow auto login
$s_display = true;
$s_last_visit = '';

// initialise variables
//$flag = "images/flags/--.gif";

$rank_title = $rank_img = $rank_img_src = '';

if ($user->data['user_id'] != ANONYMOUS)
{
	$u_login_logout = append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=logout', true, $user->session_id);
	$l_login_logout = sprintf($user->lang['LOGOUT_USER'], $user->data['username']);
	$s_last_visit = ($user->data['user_id'] != ANONYMOUS) ? $user->format_date($user->data['session_last_visit']) : '';
}
else
{
	$u_login_logout = append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=login');
	$l_login_logout = $user->lang['LOGIN'];
	
	$template->assign_vars(array(
    	'S_LOGIN_ACTION'      => append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=login'),
	));
}


$template->assign_vars(array(
	'L_LOGIN_LOGOUT'		=> $l_login_logout,
	'U_LOGIN_LOGOUT'		=> $u_login_logout,
	'U_SEARCH_SELF'			=> append_sid("{$phpbb_root_path}search.$phpEx", 'search_id=egosearch'),
	'U_SEARCH_NEW'			=> append_sid("{$phpbb_root_path}search.$phpEx", 'search_id=newposts'),
	'U_SEARCH_UNANSWERED'	=> append_sid("{$phpbb_root_path}search.$phpEx", 'search_id=unanswered'),
	'U_SEARCH_ACTIVE_TOPICS'=> append_sid("{$phpbb_root_path}search.$phpEx", 'search_id=active_topics'),	
));

//$flag = 'images/flags/' . $user->data['user_country_flag'];

//sgp_get_user_rank($user->data['user_rank'], (($user->data['user_id'] == ANONYMOUS) ? false : $user->data['user_posts']), $rank_title, $rank_img, $rank_img_src);

// First we try the default code but if no image we use the sgp code //
$avatar_img = ($user->data['user_avatar']) ? sgp_get_user_avatar($user->data['user_avatar'], $user->data['user_avatar_type'], $user->data['user_avatar_width'], $user->data['user_avatar_height'], 'USER_AVATAR', true) : '';

$template->assign_vars(array(
	'T_IMAGESET_PATH'		=> "{$phpbb_root_path}styles/" . $user->theme['imageset_path'] . '/imageset',
	'T_THEME_PATH'			=> "{$phpbb_root_path}styles/" . $user->theme['theme_path'] . '/theme',
	//'USER_COUNTRY_FLAG'		=> $flag,
	
	'S_USER_LOGGED_IN'		=> ($user->data['user_id'] != ANONYMOUS) ? true : false,
	'SITE_NAME'				=> $config['sitename'],
	'AVATAR'				=> ($avatar_img) ? $avatar_img : sgp_get_user_avatar($user->data['user_avatar'], $user->data['user_avatar_type']),
	'USER_NAME'				=> $user->data['username'],
	'USERNAME_FULL'			=> get_username_string('full', $user->data['user_id'], $user->data['username'], $user->data['user_colour']),
	'WELCOME_SITE'			=> sprintf($user->lang['WELCOME_SITE'], $config['sitename']),	
	'S_DISPLAY_FULL_LOGIN'	=> ($s_display) ? true : false,
	'S_AUTOLOGIN_ENABLED'	=> ($config['allow_autologin']) ? true : false,
	'LAST_VISIT_DATE'		=> sprintf($user->lang['YOU_LAST_VISIT'], $s_last_visit),
	'UI_PORTAL_DEBUG'		=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0'),
	'DEBUG_QUERIES'			=> (DEBUG_QUERIES) ? true : false,
	//'USR_RANK_TITLE'		=> $rank_title,
	//'USR_RANK_IMG'		=> $rank_img,
));

?>