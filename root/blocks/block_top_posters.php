<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   24 September 2007
* @copyright (c) 2005-2008 phpbbireland
* @home    http://www.phpbbireland.com
* additional code taken from various core files
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_top_posters.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
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

$queries = 0;
$cached_queries = 0;

$max_top_posters = 10; // add to acp later...

//MOD//$sql = 'SELECT user_id, username, user_posts, user_colour, user_type, group_id, user_avatar, user_avatar_type, user_avatar_width , user_avatar_height, user_website, user_country_flag
$sql = 'SELECT user_id, username, user_posts, user_colour, user_type, group_id, user_avatar, user_avatar_type, user_avatar_width , user_avatar_height, user_website
	FROM ' . USERS_TABLE . '
	WHERE user_type <> 2
	AND user_posts <> 0
	ORDER BY user_posts DESC';

$result = $db->sql_query_limit($sql, $max_top_posters);

while($row = $db->sql_fetchrow($result))
{
    if (!$row['username'])
    {
        continue;
    }

    $template->assign_block_vars('top_posters', array(
        'S_SEARCH_ACTION'	=> append_sid("{$phpbb_root_path}search.$phpEx", 'author_id=' . $row['user_id'] . '&amp;sr=posts'),
		'USERNAME_FULL'		=> get_username_string('full', $row['user_id'], sgp_checksize($row['username'],15), $row['user_colour']),
        'POSTER_POSTS'		=> $row['user_posts'],
        'USER_AVATAR_IMG'	=> sgp_get_user_avatar($row['user_avatar'], $row['user_avatar_type'], '16', '16', $user->lang['USER_AVATAR']),
        'URL'				=> $row['user_website'],
        //MOD//'COUNTRY_FLAG_IMG' =>  $row['user_country_flag'], 
        //MOD//'COUNTRY_FLAG_IMG' => '<img src="' .(sgp_get_user_country_flag($row['user_id'])). '" alt="" />',
        )
    );

$template->assign_vars(array(
	'TP_PORTAL_DEBUG'	=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0'),
));

}
$db->sql_freeresult($result);
?>