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
* @version $Id: block_recent_topics_wide.php 307 2009-01-01 16:05:35Z Michealo $
* Updated: 14th Oct 2008 NeXur / 6th September 2008 michaelo
* Rem: 23 of the portal's queries take less that 0.00000s each
* NeXur:
*   Added X num Topics per Forum to show
*   Changed SQL query to LEFT instead of INNER JOIN
*/

/**
* @ignore
*/

if ( !defined('IN_PHPBB') )
{
	exit;
}

$phpEx = substr(strrchr(__FILE__, '.'), 1);

$auth->acl($user->data);
$queries = 0;
$cached_queries = 0;

// URL PARAMETERS
@define('POST_TOPIC_URL', 't');
@define('POST_CAT_URL', 'c');
@define('POST_FORUM_URL', 'f');
@define('POST_USERS_URL', 'u');
@define('POST_POST_URL', 'p');
@define('POST_GROUPS_URL', 'g');

global $user, $forum_id, $phpbb_root_path, $phpEx, $SID, $config , $template, $portal_config, $db;

// set up variables used //
$display_this_many = $k_config['number_of_recent_topics_to_display'];
$forum_count = $row_count = 0;
$except_forum_id = '';
$forum_id_ary = '';
$search_days = $k_config['search_days'];
$post_types = $k_config['post_types'];
$number_of_topics_per_forum = $k_config['number_of_topics_per_forum'];


static $last_forum = 0;

$forum_data = array();

$sql = "SELECT scroll, position
	FROM " . K_BLOCKS_TABLE . "
	WHERE title = 'Recent Topics' ";

if($result = $db->sql_query($sql, 100))
{
	$rowx = $db->sql_fetchrow($result);
	$scroll = $rowx['scroll'];
	$display_center = $rowx['position'];
}
else
	trigger_error("Could not query <strong>" . $recent_topics . "</strong> information");
$db->sql_freeresult($result,300);

($scroll) ? $style_row = 'scrollwide' : $style_row = 'staticwide';

$template->assign_block_vars($style_row, array());

// get all forums //
$sql = "SELECT * FROM ". FORUMS_TABLE . " ORDER BY forum_id";
if (!$result = $db->sql_query($sql, 100))
{
	trigger_error('Error! Could not query forums information: ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
}

while( $row = $db->sql_fetchrow($result) )
{
	$forum_data[] = $row;
	$forum_count++;
}
$db->sql_freeresult($result,320);

for ($i = 1; $i < $forum_count; $i++)
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


($except_forum_id == '') ? $where_sql = "WHERE t.forum_id " : $where_sql = "WHERE t.forum_id NOT IN (" . $except_forum_id . ")";

if ($k_config['post_types']) 
	$types_sql = '';
else
	$types_sql = "AND t.topic_type = 0";


if($except_forum_id == '')
	$except_forum_id = '0';

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

$result = $db->sql_query_limit($sql, $display_this_many);
$row = $db->sql_fetchrowset($result);
$db->sql_freeresult($result);

$row_count = count($row);

// display_this_many do we have them?
if($row_count < $display_this_many)
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
if($scroll)
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

for($i = 0; $i < $display_this_many; $i++)
{

	if($i >= $number_of_topics_per_forum && $row[$i]['forum_id'] == $row[$i - $number_of_topics_per_forum]['forum_id'])
	{
		continue;
	}

	// reduce length and pad with ... if too long //
	$my_title = smilies_pass($row[$i]['topic_title']);
	if(strlen($my_title) > 25)
		sgp_checksize ($my_title, 25);

	// reduce length and pad with ... if too long //
	$my_forum = smilies_pass($row[$i]['forum_name']);
	if(strlen($my_forum) > 25)
		sgp_checksize ($my_forum, 25);

	//$view_topic_url = append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . (($row[$i]['forum_id']) ? $row[$i]['forum_id'] : $forum_id) );
	$view_topic_url = append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . $row[$i]['forum_id']);

	$unique = ($row[$i]['forum_id'] == $last_forum) ? false : true;

	if($row[$i]['post_edit_time'] > $row[$i]['topic_last_post_time'])
	{
		$this_post_time = '*<span style="font-style:italic">' . $user->format_date($row[$i]['post_edit_time']) . '</span>';
	}
	else
		$this_post_time = $user->format_date($row[$i]['topic_last_post_time']);

	$template->assign_block_vars($style_row . '.recent_topic_row', array(
		'LAST_POST_IMG'	=> $user->img('icon_topic_newest', 'VIEW_LATEST_POST'),
		'LAST_POST_IMG'	=>	'<img src="' . $phpbb_root_path . 'images/next_line.gif" alt="" />',

		'S_FORUM'		=> $my_forum,
		'U_FORUM'		=> append_sid("viewforum.$phpEx?" . POST_FORUM_URL . '=' . $row[$i]['forum_id']),

		'S_TITLE'		=> $my_title,
		'U_TITLE'		=> $view_topic_url . '&amp;p=' . $row[$i]['topic_last_post_id'] . '#p' . $row[$i]['topic_last_post_id'],

		'S_POSTER'		=> get_username_string('full', $row[$i]['topic_last_poster_id'], $row[$i]['topic_last_poster_name'], $row[$i]['topic_last_poster_colour']),
		'S_POSTTIME'	=> $this_post_time,
		'S_ROW_COUNT'	=> $i,
		'S_UNIQUE'		=> $unique,
		'S_TEST'		=> 'Wide Version',
		'S_TYPE'		=> $row[$i]['topic_type'],
		'TOOLTIP'		=> sgp_truncate_message(bbcode_strip(($row[$i]['post_text'])), 500),
		'TOOLTIP2'		=> sgp_truncate_message(bbcode_strip(($row[$i]['forum_desc'])), 500),
	));

	$last_forum = $row[$i]['forum_id'];
}

$db->sql_freeresult($result);

$template->assign_vars(array(
	'S_COUNT_RECENT'	=> ($i > 0) ? true : false,
	'SEARCH_TYPE'		=> (!$search_days) ? 'Full Search' : 'Search days: ' . $search_days,
	'SEARCH_LIMIT'		=> 'Limits: ' . $number_of_topics_per_forum . ' topics per forum, Display: ' . $display_this_many . ' posts.', //add to lang var later
	'RT_PORTAL_DEBUG'		=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0'),
));

?>