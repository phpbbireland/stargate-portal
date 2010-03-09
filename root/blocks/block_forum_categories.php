<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   Saturday, June 23rd, 2007
* @copyright (c) 2005-2008 phpbbireland
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_forum_categories.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* Some code taken from functions_display.php copyright (c) 2005 phpBB Group
* Updated: 14 Oct 08- NeXur / 10 October 2007 - michaelo
* NeXur: old code didn't count subforums/posts
*
* This code may be overkill but will do for now... additional data can now be
* passed to block_forum_categories.html block...
* UPDATE INFO (these comments can be removed when we reach final draft)
*/

/**
* @ignore
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

// for bots test //
//$page_title = $user->lang['BLOCK_CATEGORIES'];

$queries = 0;
$cached_queries = 0;

global $db, $auth, $user, $template;
global $phpbb_root_path, $phpEx, $config;

$tot_forum_posts = $tot_forum_topics = $cat_count = 0;
$process = false;
$j = 0;

$sql = 'SELECT right_id, left_id, forum_id, forum_name, forum_type, forum_desc, forum_image, forum_desc_uid, forum_desc_bitfield, forum_desc_options, forum_posts, forum_flags, forum_link, forum_password
	FROM ' . FORUMS_TABLE . ' WHERE forum_type = 0 OR forum_type = 2
	ORDER BY forum_type, left_id ASC';
$result = $db->sql_query($sql);

while ($row = $db->sql_fetchrow($result))
{
	$tot_forum_topics = 0;
	$tot_forum_posts = 0;
	$forum_id = $row['forum_id'];

	$sql2 = 'SELECT forum_id, forum_topics, forum_posts
		FROM ' . FORUMS_TABLE . ' WHERE left_id > ' . $row['left_id'] . ' AND right_id < ' . $row['right_id'] . '
		ORDER BY left_id ASC';
	$result2 = $db->sql_query($sql2, 600);
	$forum_count = 0;
	
	while ($row2 = $db->sql_fetchrow($result2))
	{
		if ($auth->acl_get('f_read', $row2['forum_id']))
		{
			$forum_count++;
			$forum_topics = $row2['forum_topics'];
			$forum_posts = $row2['forum_posts'];
			$tot_forum_topics = $tot_forum_topics + $forum_topics;
			$tot_forum_posts = $tot_forum_posts + $forum_posts;
		}
	}
	$db->sql_freeresult($result2);
	
	if($row['forum_type'] == 0)
	$cat_count++;

	if ($row['forum_type'] != FORUM_LINK && $auth->acl_get('f_read', $forum_id))
	{
		$u_viewforum = append_sid("{$phpbb_root_path}viewforum.$phpEx", 'f=' . $row['forum_id']);
	}
	else
	{
		// If the forum is a link and we count redirects we need to visit it
		// If the forum has a password or no read access we do not expose the link, but instead handle it in viewforum
		if (($row['forum_flags'] & FORUM_FLAG_LINK_TRACK) || $row['forum_password'] || !$auth->acl_get('f_read', $forum_id))
		{
			$u_viewforum = append_sid("{$phpbb_root_path}viewforum.$phpEx", 'f=' . $row['forum_id']);
		}
		else
		{
			$u_viewforum = $row['forum_link'];
		}
	}

	if($forum_count > 0 || $row['forum_type'] == 2)
	{
		//only dispaly main categories...
		if($u_viewforum && $row['forum_type'] == 0 && $auth->acl_get('f_list', $forum_id) || $row['forum_type'] == 2 && $auth->acl_get('f_list', $forum_id)) 
		{
			//$row['forum_name'] = sgp_checksize ($row['forum_name'],20);

			$template->assign_block_vars('iforumrow', array(
				'S_IS_CAT'				=> ($row['forum_type'] == FORUM_LINK) ? '' : 'POSTS',
				'S_IS_LINK'				=> ($row['forum_type'] == FORUM_LINK) ? 'CLICKS' : '',
				'FORUM_ID'				=> $row['forum_id'],
				'FORUM_NAME'			=> $row['forum_name'],
				'FORUM_DESC'			=> generate_text_for_display($row['forum_desc'], $row['forum_desc_uid'], $row['forum_desc_bitfield'], $row['forum_desc_options']),
				'FORUM_TOPICS'			=> $tot_forum_topics,
				'FORUM_POSTS'			=> $tot_forum_posts,
				'CLICKS'				=> ($row['forum_type'] != FORUM_LINK || $row['forum_flags'] & FORUM_FLAG_LINK_TRACK) ? $row['forum_posts'] : '',
				'FORUM_IMAGE_SRC'		=> ($row['forum_image']) ? $phpbb_root_path . $row['forum_image'] : $phpbb_root_path . 'images/forum_icons/default.png ' . '" height="25px" width="25px" alt="' . $user->lang['FORUM_CAT'] . '"',
				'U_VIEWFORUM'			=> $u_viewforum,
				'S_CAT_COUNT'			=> $cat_count,
				'FORUM_TYPE'			=> $row['forum_type'],
				'UNIQUE'				=> $j++,
				)
			);
	    }
	}
}
$db->sql_freeresult($result);


$template->assign_vars(array(
	'S_CAT_FORUM_COUNT'	=> $forum_count,
	'S_TOTAL_CATS' 		=> $cat_count,
	'FC_PORTAL_DEBUG'	=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0'),
));

$template->set_filenames(array(
	'body' => 'blocks/block_forum_categories.html',
	)
);

?>