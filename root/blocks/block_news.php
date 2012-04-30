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
* @version $Id: block_news.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* Updated: 17 March 2008
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

	$phpEx = substr(strrchr(__FILE__, '.'), 1);

	//-- Admin must create a News Forum and add news items to Forum. 
	//-- Note: The News Forum ID must be set in ACP -> Portal Config
	//-- News Items are seen by everyone! Reply is restricted...

	global $k_config;
	$block_cache_time = $k_config['block_cache_time_default'];

	$sql = 'SELECT config_name, config_value
		FROM ' . K_BLOCKS_CONFIG_VAR_TABLE . '';  

	$result = $db->sql_query($sql, $block_cache_time);
			
	while($row = $db->sql_fetchrow($result))
	{
		$config[$row['config_name']] = $row['config_value'];
	}
	$db->sql_freeresult($result);


	$number_of_news_items = $config['number_of_news_items_to_display'];
	$max_news_length = $config['max_news_item_length'];
	$news_forum = $config['news_forum_id'];
	$allow_news = $config['allow_news'];


	// Stargate Portal progress bar function + a useful function for creating text bar graph //
	$template->assign_vars(array('PORTAL_PROGRESS' => k_progress_bar(95))); // or for more use //$template->assign_block_vars('rept',array('PORTAL_PROGRESS' => progress_bar(65)));

	// Fetch Posts from News Forum code borrowed from MD's IM Portal news block //

	global $forum_id, $locked;
	
	$fetch_news = phpbb_fetch_news($news_forum, $number_of_news_items, $max_news_length, 0, 0 ? 'all' : 'normal');
	//$fetch_news = phpbb_fetch_news($news_forum, $number_of_news_items, $max_news_length, 0, true);

	if (count($fetch_news) == 0)
	{
		$template->assign_block_vars('news_row', array(
			'S_NO_TOPICS'	=> true,
			'S_NOT_LAST'	=> false
			)
    	);
	}
	else
	{
		for ($i = 0; $i < count($fetch_news); $i++)
		{
	  		if (isset($fetch_news[$i]['striped']) && $fetch_news[$i]['striped'] == true)
		    {
				$open_bracket = '[ ';
				$close_bracket = ' ]';
				$read_full = $user->lang['READ_FULL'];
			}
			else
			{
	    		$open_bracket = '';
		        $close_bracket = '';
    			$read_full = '';
			}

			$template->assign_block_vars('news_row', array(
				'ALLOW_REPLY'		=> ($auth->acl_get('f_reply', $news_forum) && !$locked) ? TRUE : FALSE,
				'ATTACH_ICON_IMG'	=> ($fetch_news[$i]['attachment']) ? $user->img('icon_attach', $user->lang['TOTAL_ATTACHMENTS']) : '',	
				'CLOSE'				=> $close_bracket,
				'MINI_POST_IMG'		=> $user->img('icon_post_target', 'POST'),				
				'OPEN'				=> $open_bracket,				
				'POSTER'			=> $fetch_news[$i]['username'],
				'READ_FULL'			=> $read_full,
				'REPLIES'			=> $fetch_news[$i]['topic_replies'],
				'TEXT'				=> $fetch_news[$i]['post_text'],
				'TIME'				=> $fetch_news[$i]['topic_time'],
				'TITLE'				=> $fetch_news[$i]['topic_title'],

				'U_POST_COMMENT'	=> append_sid($phpbb_root_path . 'posting.' . $phpEx . '?mode=reply&amp;t=' . $fetch_news[$i]['topic_id'] . '&amp;f=' . $fetch_news[$i]['forum_id']),
				'U_PRINT'			=> ($auth->acl_get('f_print', $fetch_news[$i]['forum_id'])) ? append_sid("{$phpbb_root_path}viewtopic.$phpEx", "f=" . $fetch_news[$i]['forum_id'] . " &amp;t=" . $fetch_news[$i]['topic_id'] . "&amp;view=print") : '',
				'U_USER_PROFILE'	=> (($fetch_news[$i]['user_type'] ==  USER_NORMAL || $fetch_news[$i]['user_type'] == USER_FOUNDER) && $fetch_news[$i]['user_id'] != ANONYMOUS) ? append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=viewprofile&amp;u=' . $fetch_news[$i]['user_id']) : '',
				'U_VIEW'			=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . (($fetch_news[$i]['forum_id']) ? $fetch_news[$i]['forum_id'] : $forum_id) . '&amp;t=' . $fetch_news[$i]['topic_id']),

				'U_COMMENT_IMG'		=> '<img src="' . $phpbb_root_path . 'styles/' . $user->theme['imageset_path'] . '/imageset/portal/post_comment.png'  . '" title="' . $user->lang['POST_COMMENTS']  . '" alt="' . $user->lang['POST_COMMENTS']  . '" />',
				'U_PRINT_IMG' 		=> '<img src="' . $phpbb_root_path . 'styles/' . $user->theme['imageset_path'] . '/imageset/portal/post_print.png' . '" title="' . $user->lang['PRINT_IT']  . '" alt="' . $user->lang['PRINT_IT']  . '" />',
				'U_VIEW_IMG'		=> '<img src="' . $phpbb_root_path . 'styles/' . $user->theme['imageset_path'] . '/imageset/portal/post_view.png' . '" title="' . $user->lang['VIEW_FULL_ARTICLE']  . '" alt="' . $user->lang['VIEW_FULL_ARTICLE']  . '" />',

				'S_NOT_LAST'		=> ($i < count($fetch_news) - 1) ? true : false,
				'S_POLL_TITLE'		=> $fetch_news[$i]['poll_title'],
				'S_ROW_COUNT'		=> $i,

				//'S_HAS_ATTACHMENTS'	=> (!empty($fetchposts[$i]['has_attachments'])) ? true : false,
				//'S_POST_UNAPPROVED'	=> ($fetchposts[$i]['post_approved']) ? false : true,
				//'S_DISPLAY_NOTICE'	=> $fetchposts[$i]['display_notice'] && $fetchposts[$i]['post_attachment'],
				)
        	); 
		}
	}

	$template->assign_vars(array(
		'S_DISPLAY_NEWS_LIST'	=> ($allow_news) ? true : false,
		'NEWS_DEBUG'			=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0', ($total_queries) ? $total_queries : '0'),
		)
	);

?>