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
* @version $Id$
*
* Updated: 14th Oct 2008 NeXur / 6th September 2008 michaelo
* Rem: 23 of the portal's queries take less that 0.00000s each
* NeXur:
*   Added X num Topics per Forum to show
*   Changed SQL query to LEFT instead of INNER JOIN
*/

/**
* @ignore
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

$phpEx = substr(strrchr(__FILE__, '.'), 1);

$auth->acl($user->data);

$queries = $cached_queries = 0;

// URL PARAMETERS
@define('POST_TOPIC_URL', 't');
@define('POST_CAT_URL', 'c');
@define('POST_FORUM_URL', 'f');
@define('POST_USERS_URL', 'u');
@define('POST_POST_URL', 'p');
@define('POST_GROUPS_URL', 'g');

global $user, $forum_id, $phpbb_root_path, $phpEx, $SID, $config, $template, $k_config, $k_blocks, $db;
//global $web_path;

foreach ($k_blocks as $blk)
{
	if ($blk['html_file_name'] == 'block_recent_topics_wide.html')
	{
		$block_cache_time = $blk['block_cache_time'];
	}
}
$block_cache_time = (isset($block_cache_time) ? $block_cache_time : $k_config['block_cache_time_default']);


// set up variables used //
$display_this_many = $k_config['number_of_recent_topics_to_display'];
$forum_count = $row_count = 0;
$except_forum_id = $k_config['recent_topics_search_exclude'];
$forum_id_ary = '';
$search_days = $k_config['search_days'];
$post_types = $k_config['post_types'];
$number_of_topics_per_forum = $k_config['number_of_topics_per_forum'];

static $last_forum = 0;

$forum_data = array();

$sql = "SELECT html_file_name, scroll, position
	FROM " . K_BLOCKS_TABLE . "
	WHERE html_file_name = 'block_recent_topics_wide.html' ";

if ($result = $db->sql_query($sql, $block_cache_time))
{
	$row = $db->sql_fetchrow($result);
	$scroll = $row['scroll'];
	$display_center = $row['position'];
}
else
{
	trigger_error($user->lang['ERROR_PORTAL_RECENT_TOPICS'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
}
$db->sql_freeresult($result);

$style_row = ($scroll) ? 'scrollwide_' : 'staticwide_';

// get all forums //
$sql = "SELECT * FROM ". FORUMS_TABLE . " ORDER BY forum_id";
if (!$result = $db->sql_query($sql, $block_cache_time))
{
	trigger_error($user->lang['ERROR_PORTAL_FORUMS'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
}

while ($row = $db->sql_fetchrow($result))
{
	$forum_data[] = $row;
	$forum_count++;
}
$db->sql_freeresult($result);

for ($i = 0; $i < $forum_count; $i++)
{
	if (!$auth->acl_gets('f_list', 'f_read', $forum_data[$i]['forum_id']))
	{
		$except_forum_id .= "'" . $forum_data[$i]['forum_id'] . "'";
		$except_forum_id .= ",";
	}

	if ($auth->acl_gets('f_list', 'f_read', $forum_data[$i]['forum_id']))
	{
		$forum_id_ary .= $forum_data[$i]['forum_id'];
		$forum_id_ary .= ", ";
	}
}
$except_forum_id = rtrim($except_forum_id,",");

//($except_forum_id == '') ? $where_sql = "WHERE t.forum_id " : $where_sql = "WHERE t.forum_id NOT IN (" . $except_forum_id . ")";
$where_sql = (($except_forum_id == '')) ? $where_sql = "WHERE t.forum_id " : $where_sql = "WHERE t.forum_id NOT IN (" . $except_forum_id . ")";

if ($k_config['post_types'])
{
	$types_sql = '';
}
else
{
	$types_sql = "AND t.topic_type = 0";
}


if ($except_forum_id == '')
{
	$except_forum_id = '0';
}

$sql = 'SELECT SQL_CACHE p.post_id, t.topic_id, t.topic_time, t.topic_title, t.topic_replies, t.forum_id, t.topic_last_post_time, t.topic_last_post_id, t.topic_last_poster_id, t.topic_last_poster_name, t.topic_last_poster_colour, t.topic_type, f.forum_name, p.post_edit_time, p.post_subject, p.post_text, p.post_time, p.bbcode_bitfield, p.bbcode_uid, f.forum_desc
		FROM ' . FORUMS_TABLE . ' f
			LEFT JOIN ' . TOPICS_TABLE . ' t ON (f.forum_id = t.forum_id)
			LEFT JOIN ' . POSTS_TABLE . ' p ON (t.topic_id = p.topic_id)
				' . $where_sql . '
					AND t.topic_approved = 1
					AND p.post_approved = 1
					' . $types_sql . '
					AND p.post_id = t.topic_first_post_id
					AND t.topic_last_post_time >= (unix_timestamp(date_add(now(), interval - ' . $search_days . ' day)))
		ORDER BY t.forum_id, t.topic_last_post_time DESC';

$result = $db->sql_query_limit($sql, $display_this_many, 0, $block_cache_time);

$row = $db->sql_fetchrowset($result);

$db->sql_freeresult($result);

$row_count = count($row);

// display_this_many do we have them?
if ($row_count < $display_this_many)
{
	$display_this_many = $row_count;
}

/*
We need a way to disable scrolling (of any block) if the information retrieved
is less that can be properly displayed in the block. The minimum height of all
blocks that support scrolling is currently set to 160px.
Note as this affects scrolling it is read by the portal.html page...
*/

// Don't scroll recent-topics(RT) if less that 5 posts returned. //
if ($scroll)
{
	if($row_count > 5)
	{
		$template->assign_vars(array(
			'DISABLE_RT_SCROLL'	=> false,
	    ));
	}
	else
	{
		$template->assign_vars(array(
			'DISABLE_RT_SCROLL'	=> true,
	    ));
	}
}

// get the little image if it exists else we will use the default (backward compatibility is a must) ;)
if (file_exists($phpbb_root_path . "{$web_path}styles/" . $user->theme['theme_path'] . '/theme/images/next_line.gif'))
{
	$next_img = '<img src="' . $phpbb_root_path . "{$web_path}styles/" . $user->theme['theme_path'] . '/theme/images/next_line.gif" height="9px" width="11px" alt="" />';
}
else
{
	$next_img = '<img src="' . $phpbb_root_path . 'images/next_line.gif" height="9px" width="11px" alt="" />';
}

for ($i = 0; $i < $display_this_many; $i++)
{
	$unique = ($row[$i]['forum_id'] == $last_forum) ? false : true;

	//echo 'Forum ID = ' . $row[$i]['forum_id'] . ' Compare to: '; echo $row[$i - $number_of_topics_per_forum]['forum_id'] . '<br />';
	if ($i >= $number_of_topics_per_forum && $row[$i]['forum_id'] == $row[$i - $number_of_topics_per_forum]['forum_id'])
	{
		continue;
	}

	// reduce length and pad with ... if too long //
	$my_title = smilies_pass($row[$i]['topic_title']);
	if (strlen($my_title) > 25)
	{
		sgp_checksize ($my_title, 25);
	}

	// reduce length and pad with ... if too long //
	$forum_name = smilies_pass($row[$i]['forum_name']);
	if (strlen($forum_name) > 25)
	{
		sgp_checksize ($forum_name, 25);
	}

	//$view_topic_url = append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . (($row[$i]['forum_id']) ? $row[$i]['forum_id'] : $forum_id) );
	$view_topic_url = append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . $row[$i]['forum_id']);

	if ($row[$i]['post_edit_time'] > $row[$i]['topic_last_post_time'])
	{
		$this_post_time = '*<span style="font-style:italic">' . $user->format_date($row[$i]['post_edit_time']) . '</span>';
	}
	else
	{
		$this_post_time = $user->format_date($row[$i]['topic_last_post_time']);
	}


	$template->assign_block_vars($style_row . 'recent_topic_row', array(
		'LAST_POST_IMG_W'	=> $user->img('icon_topic_newest', 'VIEW_LATEST_POST'),
		'LAST_POST_IMG_W'	=> $next_img,
		'FORUM_W'			=> $forum_name,
		'U_FORUM_W'			=> append_sid("viewforum.$phpEx?" . POST_FORUM_URL . '=' . $row[$i]['forum_id']),
		'TITLE_W'			=> censor_text($my_title),
		'U_TITLE_W'			=> $view_topic_url . '&amp;p=' . $row[$i]['topic_last_post_id'] . '#p' . $row[$i]['topic_last_post_id'],
		'POSTER_FULL_W'		=> get_username_string('full', $row[$i]['topic_last_poster_id'], $row[$i]['topic_last_poster_name'], $row[$i]['topic_last_poster_colour']),
		'POSTTIME_W'		=> $this_post_time,
		'S_ROW_COUNT_W'		=> $i,
		'S_UNIQUE_W'		=> $unique,
		'S_TYPE_W'			=> $row[$i]['topic_type'],
		'TOOLTIP_W'			=> bbcode_strip($row[$i]['post_text']),
		'TOOLTIP2_W'		=> bbcode_strip($row[$i]['forum_desc']),
	));

	$last_forum = $row[$i]['forum_id'];
}

$template->assign_vars(array(
	'S_COUNT_RECENT'	=> ($i > 0) ? true : false,
	'SEARCH_TYPE'		=> (!$search_days) ? $user->lang['FULL_SEARCH'] : $user->lang['SEARCH_DAYS'] . $search_days,
	'SEARCH_LIMIT'		=> $user->lang['T_LIMITS'] . $number_of_topics_per_forum . $user->lang['TOPICS_PER_FORUM_DISPLAY'] . $display_this_many . ' ' . $user->lang['POSTS'],

	'RECENT_TOPICS_WIDE_DEBUG'	=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0', ($total_queries) ? $total_queries : '0'),
));

?>