<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   Sunday, 20th May, 2007
* @copyright (c) 2005-2008 phpbbireland
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_recent_topics.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* Updated: 21 February 2008
*
*/

/**
* @ignore
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

// for bots test //
//$page_title = $user->lang['BLOCK_RECENT_TOPICS'];

//$phpEx = substr(strrchr(__FILE__, '.'), 1);

$auth->acl($user->data);

// URL PARAMETERS
@define('POST_TOPIC_URL', 't');
@define('POST_CAT_URL', 'c');
@define('POST_FORUM_URL', 'f');
@define('POST_USERS_URL', 'u');
@define('POST_POST_URL', 'p');
@define('POST_GROUPS_URL', 'g');

$queries = $cached_queries = 0;

	global $user, $forum_id, $phpbb_root_path, $phpEx, $SID, $config , $template, $k_config, $k_blocks, $userdata, $config, $k_config, $db, $k_blocks;

	$last_forum_name = '';

	foreach ($k_blocks as $blk)
	{
		if ($blk['html_file_name'] == 'block_recent_topics.html')
		{
			$block_cache_time = $blk['block_cache_time'];
		}
	}
	$block_cache_time = (isset($block_cache_time) ? $block_cache_time : $k_config['block_cache_time_default']);

	// set up variables used //
 	$display_this_many = $k_config['number_of_recent_topics_to_display'];
	$forum_count = $row_count = 0;

	$except_forum_id = $k_config['recent_topics_search_exclude'];
	$forum_data = array();
	$recent_topic_row = array();

	// get all forums //
	$sql = "SELECT * FROM ". FORUMS_TABLE . " ORDER BY forum_id";

	if (!$result = $db->sql_query($sql, $block_cache_time))
	{
		trigger_error($user->lang['ERROR_FORUM_INFO'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
	}

	while( $row = $db->sql_fetchrow($result) )
	{
		$forum_data[] = $row;
		$forum_count++;
	}
	$db->sql_freeresult($result);

	for ($i = 1; $i < $forum_count; $i++)
	{
		if (!$auth->acl_gets('f_list', 'f_read', $forum_data[$i]['forum_id']))
		{
			$except_forum_id .= "'" . $forum_data[$i]['forum_id'] . "'";
			$except_forum_id .= ",";
		}
	}

	$except_forum_id = rtrim($except_forum_id,",");

	if ($except_forum_id == '')
	{
		$except_forum_id = '0';
	}

	
	$sql = "SELECT t.topic_id, t.topic_title, t.topic_last_post_id, t.forum_id, p.post_id, p.poster_id, p.post_time, u.user_id, u.username, u.user_colour, f.forum_name, f.forum_id, f.forum_image
		FROM " . TOPICS_TABLE . " AS t, " . POSTS_TABLE . " AS p, " . USERS_TABLE . " AS u, " . FORUMS_TABLE . " AS f
		WHERE t.forum_id NOT IN (" . $except_forum_id . ")
			AND t.topic_status <> 2
			AND p.post_id = t.topic_last_post_id
			AND p.poster_id = u.user_id
			AND f.forum_id = t.forum_id 
		ORDER BY p.post_time DESC
		LIMIT " . $display_this_many;



/*ORDER BY p.forum_id, p.post_time DESC
	$search_days = $k_config['search_days'];

	$sql = "SELECT t.topic_id, t.topic_title, t.topic_last_post_id, t.forum_id, t.topic_last_post_time, p.post_id, p.poster_id, p.post_time, u.user_id, u.username, u.user_colour, f.forum_name, f.forum_id, f.forum_image
		FROM " . TOPICS_TABLE . " AS t, " . POSTS_TABLE . " AS p, " . USERS_TABLE . " AS u, " . FORUMS_TABLE . " AS f
		WHERE t.forum_id NOT IN (" . $except_forum_id . ")
			AND t.topic_status <> 2
			AND p.post_id = t.topic_last_post_id
			AND p.poster_id = u.user_id
			AND f.forum_id = t.forum_id 
			AND t.topic_last_post_time >= (unix_timestamp(date_add(now(), interval - ' . $search_days . ' DAY)))
		ORDER BY p.post_time ASC
		LIMIT " . $display_this_many;
*/

	if (!$result = $db->sql_query($sql, $block_cache_time))
	{
		trigger_error('ERROR_PORTAL_RECENT_TOPICS' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
	}

	while ($row = $db->sql_fetchrow($result))
	{
		$recent_topic_row[] = $row;

		if ($row['forum_id'] > 0)
		{
			$row_count++;
		}
	}

	$db->sql_freeresult($result);

	foreach ($k_blocks as $blk)
	{
		if ($blk['html_file_name'] == 'block_recent_topics.html')
		{
			$scroll = $blk['scroll'];
			$display_center = $blk['position'];
			break;
		}
	}

	$style_row = ($scroll) ? 'scroll' : 'static';

	if ($display_this_many > $row_count)
	{
		$display_this_many = $row_count;
	}

	if ($scroll)
	{
		$display_this_many = $row_count;

		if($row_count <= 6)
		{
			$style_row = 'static';
			$template->assign_vars(array(
				'PROCESS'	=> false,
		    ));
		}
		else
		{
			$template->assign_vars(array(
				'PROCESS'	=> true,
		    ));
		}
	}

	for ($i = 0; $i < $display_this_many; $i++)
	{
		if ($recent_topic_row[$i]['user_id'] != -1)
		{
			// this is a left or right block ? //
			if($display_center != 'C')
			{
				$my_title_long = $recent_topic_row[$i]['topic_title'];
				$recent_topic_row[$i]['topic_title'] = sgp_checksize ($recent_topic_row[$i]['topic_title'],20); // Michaelo's function to stop page from stretching due to long names in form select options... Names are truncated//
			}

			$view_topic_url = append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . (($recent_topic_row[$i]['forum_id']) ? $recent_topic_row[$i]['forum_id'] : $forum_id) );

			// add spaces for nice scrolling
			$my_title = smilies_pass($recent_topic_row[$i]['topic_title']);

			$length = strlen($my_title);

			// Truncate title and padd with ... if too long
			if ($length > 25)
			{
				sgp_checksize ($my_title, 25);
			}

			$my_forum = smilies_pass($recent_topic_row[$i]['forum_name']);

			$length = strlen($my_forum);

			if ($length > 25)
			{
				sgp_checksize ($my_forum, 25);
			}

			$forum_image = (isset($recent_topic_row[$i]['forum_image'])) ? $recent_topic_row[$i]['forum_image'] : 'images/forum_icons/default.png';

			$template->assign_block_vars($style_row . '_recent_topic_row', array(
				'U_FORUM'		=> append_sid("viewforum.$phpEx", POST_FORUM_URL . '=' . $recent_topic_row[$i]['forum_id']),
				'U_TITLE'		=> append_sid("viewtopic.$phpEx", POST_POST_URL  . '=' . $recent_topic_row[$i]['post_id']),

				'U_LAST_POST'	=> append_sid($view_topic_url . '&amp;p=' . $recent_topic_row[$i]['topic_last_post_id'] . '#p' . $recent_topic_row[$i]['topic_last_post_id']),

				'S_POSTER'		=> get_username_string('full', $recent_topic_row[$i]['user_id'], $recent_topic_row[$i]['username'], $recent_topic_row[$i]['user_colour']),
				'S_POSTTIME'	=> $user->format_date($recent_topic_row[$i]['post_time']),
				'S_ROW_COUNT'	=> $i,

				'S_FORUM'		=> ($last_forum_name == $my_forum) ? '' : $my_forum,
				'S_TITLE'		=> $my_title,
				'S_TITLE_LONG'	=> $my_title_long,
				'LAST_POST_IMG'	=> $user->img('icon_topic_newest', 'VIEW_LATEST_POST'),
				'FORUM_IMG'		=> '', //$forum_image,
				'FORUM_LNK'		=> append_sid("{$phpbb_root_path}viewforum.$phpEx", 'f=' . $recent_topic_row[$i]['forum_id'])
			));
			$last_forum_name = $my_forum;
		}
	}

	$template->assign_vars(array(
		'S_DISPLAY_CENTRE'			=> $display_center,
		'S_COUNT'					=> $display_this_many,
		'RECENT_TOPICS_DEBUG'		=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0', ($total_queries) ? $total_queries : '0'),
	));

?>