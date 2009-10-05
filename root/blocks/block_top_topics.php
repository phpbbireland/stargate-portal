<?php
/**
*
* @package Stargate Portal
* @author  Martin Larsson - aka NeXur
* @begin   Thursday, 28 October, 2008
* @copyright (c) 2008 Martin Larsson - aka NeXur
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_top_topics.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* Updated: 4 November 2008
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
$page_title = $user->lang['BLOCK_TOP_TOPICS'];

global $k_config;
$queries = 0;
$cached_queries = 0;

$max_top_topics = $k_config['max_top_topics'];

$sql = 'SELECT topic_id, topic_title, topic_replies, forum_id
	FROM ' . TOPICS_TABLE . '
	WHERE topic_approved = 1
	AND topic_replies <> 0
	ORDER BY topic_replies DESC';

$result = $db->sql_query_limit($sql, $max_top_topics);

while($row = $db->sql_fetchrow($result))
{

    if (!$row['topic_title'])
    {
        continue;
    }
	
	if ($auth->acl_gets('f_list', 'f_read', $row['forum_id']))
	{
		// reduce length and pad with ... if too long //
		$my_title = smilies_pass($row['topic_title']);
		if(strlen($my_title) > 16)
		{
			$my_title = sgp_checksize ($my_title, 14);
		}
		
		$template->assign_block_vars('top_topics', array(
			'TOPIC_TITLE'		=> $my_title,
			'FULL_T_TITLE'		=> smilies_pass($row['topic_title']),
			'S_SEARCH_ACTION'	=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . $row['forum_id'] . '&amp;t=' . $row['topic_id']),
			'TOPIC_REPLIES'		=> $row['topic_replies'],
			)
		);
	}       
}
$db->sql_freeresult($result);

$template->assign_vars(array(
	'TT_PORTAL_DEBUG'	=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0'),
));

?>