<?php
/**
*
* @package acp Stargate Portal
* @version $Id: acp_k_vars.php 335 2009-01-18 15:01:12Z Michealo $
* @copyright (c) 2007 Michael O'Toole aka michaelo
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* Last Updated: 31 August 2010 Mike
*/

/**
* @ignore
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package acp
*/

class acp_k_vars
{
	var $u_action;

	function main($id, $mode)
	{

		global $db, $user, $auth, $template, $cache;
		global $k_config, $SID, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		include($phpbb_root_path . 'includes/sgp_functions.'.$phpEx);
		include($phpbb_root_path . 'includes/sgp_functions_admin.'.$phpEx);

		$user->add_lang('acp/k_vars');
		$this->tpl_name = 'acp_k_vars';
		$this->page_title = 'ACP_K_VARS_CONFIG';

		$form_key = 'acp_k_vars';
		add_form_key($form_key);

		$choice = request_var('switch', '');
		$block = request_var('block', '');
		$mode	= request_var('mode', '');
		$switch = request_var('switch', '');

		if ($block == '')
		{
			$block = 0;
		}

		if ($mode = 'config' && $choice == '')
		{
			$choice = 'config';
		}

		if (isset($block))
		{
			$sql = "SELECT id, title, var_file_name
				FROM ". K_BLOCKS_TABLE . "
				WHERE id = " . (int)$block;
			$result = $db->sql_query($sql);

			$row = $db->sql_fetchrow($result);

			$title = strtoupper($row['title']);
			$title = str_replace(' ','_', $row['title']);

			$block_id = $row['id'];
			$var_file_name = $row['var_file_name'];

			$db->sql_freeresult($result);
			get_all_groups();
		}

		$block = !empty($block) ? $block : 0;
		$action = request_var('action', '');
		$submit = (isset($_POST['submit'])) ? true : false;

		// swicth to other var setups 11 March 2010
		if ($switch)
		{
			get_reserved_words();
			$var_file_name = $switch;
		}

		$template->assign_vars(array( 'S_SWITCH' => $var_file_name ));


		if ($submit && !check_form_key($form_key))
		{
			$submit = false;
			$mode = '';
			trigger_error($user->lang['FORM_INVALID']);
		}

		//$wheresql = ' WHERE block_id = ' .  $block;
		$wheresql = '';

		$sql = 'SELECT config_name, config_value
			FROM ' . K_BLOCKS_CONFIG_VAR_TABLE . $wheresql;

		$result = $db->sql_query($sql);

		while($row = $db->sql_fetchrow($result))
		{
			$k_config[$row['config_name']] = $row['config_value'];

			$template->assign_var('S_' . (strtoupper($row['config_name'])), $row['config_value']);
		}
		$db->sql_freeresult($result);

		$template->assign_vars(array(
			'S_OPT' => 'config',
			'MESSAGE' => '',
		));

		if ($submit)
		{
			$mode = 'save';
		}
		else
		{
			$mode = 'reset';
		}

		switch ($mode)
		{
			case 'save':
			{
				//$news_forum_id							= $_POST['news_forum_id'];
				$allow_acronyms							= request_var('allow_acronyms', 1);
				$allow_announce							= request_var('allow_announce', '');
				$allow_bot_display						= request_var('allow_bot_display', '');
				$allow_footer_images					= request_var('allow_footer_images', '');
				$allow_news								= request_var('allow_news', '');
				$allow_rotating_logos					= request_var('allow_rotating_logos', '');
				$announce_type							= request_var('announce_type', '');
				$display_blocks_global					= request_var('display_blocks_global', '');
				$link_forum_id							= request_var('link_forum_id', '');
				$link_to_us_image						= request_var('link_to_us_image', '');
				$max_announce_item_length				= request_var('max_announce_item_length', '');
				$max_news_item_length					= request_var('max_news_item_length', '');
				$news_type								= request_var('news_type', '');
				$number_of_announce_items_to_display	= request_var('number_of_announce_items_to_display', '');
				$number_of_bots_to_display				= request_var('number_of_bots_to_display', '');
				$number_of_links_to_display				= request_var('number_of_links_to_display', '');
				$number_of_news_items_to_display		= request_var('number_of_news_items_to_display', '');
				$number_of_recent_topics_to_display		= request_var('number_of_recent_topics_to_display', '');
				$number_of_topics_per_forum				= request_var('number_of_topics_per_forum', '');
				$number_of_team_members_to_display		= request_var('number_of_team_members_to_display', '');
				$number_of_top_posters_to_display		= request_var('number_of_top_posters_to_display', '');
				$number_of_top_referrals_to_display		= request_var('number_of_top_referrals_to_display', '');

				$teams_to_display						= request_var('teams_to_display', '');

				$recent_topics_search_exclude			= request_var('recent_topics_search_exclude', '');
				$mini_mod_style_count					= request_var('mini_mod_style_count', '');
				$mini_mod_block_count					= request_var('mini_mod_block_count', '');
				$mini_mod_mod_count						= request_var('mini_mod_mod_count', '');

				$teamspeak_pw							= request_var('teamspeak_pw', '');
				$teamspeak_connection					= request_var('teamspeak_connection', '');

				$k_show_smilies							= request_var('k_show_smilies', 1);
				$rand_banner							= request_var('rand_banner', '');
				$rand_header							= request_var('rand_header', '');

				$use_cookies							= request_var('use_cookies', '');
				$opt_irc_channels						= request_var('opt_irc_channels', '');
				$search_days							= request_var('search_days', '');
				$post_types								= request_var('post_types', '');
				$max_last_online						= request_var('max_last_online', '');
				$max_top_topics							= request_var('max_top_topics', '');
				$days_top_topics						= request_var('days_top_topics', '');
				$age_range_interval						= request_var('age_range_interval', '');
				$age_range_start						= request_var('age_range_start', '');
				$age_upper_limit						= request_var('age_upper_limit', '');

				$cloud_max_tags							= request_var('cloud_max_tags', '');
				$cloud_movie							= request_var('cloud_movie', '');
				$cloud_tcolour							= request_var('cloud_tcolour', '');
				$cloud_tcolour2							= request_var('cloud_tcolour2', '');
				$cloud_hicolour							= request_var('cloud_hicolour', '');
				$cloud_width							= request_var('cloud_width', '');
				$cloud_height							= request_var('cloud_height', '');
				$cloud_bg_colour						= request_var('cloud_bg_colour', '');
				$cloud_speed							= request_var('cloud_speed', '');
				$cloud_mode								= request_var('cloud_mode', '');
				$cloud_wmode							= request_var('cloud_wmode', '');
				$cloud_distr							= request_var('cloud_distr', '');

				$cloud_search_allow						= request_var('cloud_search_allow', 1);
				$cloud_search_cache						= request_var('cloud_search_cache', 0);

				$teamspeak_pw							= request_var('teamspeak_pw', '');
				$teamspeak_connection					= request_var('teamspeak_connection', '');

				$sgp_quick_reply						= request_var('sgp_quick_reply', 1);
				$k_yourtube_link						= request_var('k_yourtube_link', '');

				$block_cache_time_default				= request_var('block_cache_time_default', '');
				$block_recent_cache_time				= request_var('block_recent_cache_time', '');

				switch($announce_type)
				{
					case 2:		$announce_type = POST_ANNOUNCE;
					break;

					case 3:		$announce_type = POST_GLOBAL;
					break;

					default:	$announce_type = 0;
					break;
				}
				switch($news_type)
				{
					case 4:		$news_type = POST_NEWS;
					break;

					case 5:		$news_type = POST_NEWS_GLOBAL;
					break;

					default:	$news_type = 0;
					break;
				}

				// all data is escaped in sgp_acp_set_config //

				//sgp_acp_set_config('news_forum_id', $news_forum_id);
				sgp_acp_set_config('allow_acronyms', $allow_acronyms);
				sgp_acp_set_config('allow_announce', $allow_announce);
				sgp_acp_set_config('allow_bot_display', $allow_bot_display);
				sgp_acp_set_config('allow_footer_images', $allow_footer_images);
				sgp_acp_set_config('allow_news', $allow_news);
				sgp_acp_set_config('allow_rotating_logos', $allow_rotating_logos);
				sgp_acp_set_config('announce_type', $announce_type);
				sgp_acp_set_config('display_blocks_global', $display_blocks_global);
				sgp_acp_set_config('k_show_smilies', $k_show_smilies);
				sgp_acp_set_config('link_to_us_image', $link_to_us_image);
				sgp_acp_set_config('link_forum_id', $link_forum_id);
				sgp_acp_set_config('news_type', $news_type, true);
				sgp_acp_set_config('number_of_announce_items_to_display', $number_of_announce_items_to_display);
				sgp_acp_set_config('number_of_bots_to_display', $number_of_bots_to_display);
				sgp_acp_set_config('number_of_links_to_display', $number_of_links_to_display);
				sgp_acp_set_config('number_of_news_items_to_display', $number_of_news_items_to_display);
				sgp_acp_set_config('max_news_item_length', $max_news_item_length);
				sgp_acp_set_config('max_announce_item_length', $max_announce_item_length);
				sgp_acp_set_config('number_of_recent_topics_to_display', $number_of_recent_topics_to_display);
				sgp_acp_set_config('number_of_topics_per_forum', $number_of_topics_per_forum);
				sgp_acp_set_config('number_of_team_members_to_display', $number_of_team_members_to_display);
				sgp_acp_set_config('number_of_top_posters_to_display', $number_of_top_posters_to_display);
				sgp_acp_set_config('number_of_top_referrals_to_display', $number_of_top_referrals_to_display);

				sgp_acp_set_config('teams_to_display', $teams_to_display);

				sgp_acp_set_config('recent_topics_search_exclude', $recent_topics_search_exclude);
				sgp_acp_set_config('rand_banner', $rand_banner);
				sgp_acp_set_config('rand_header', $rand_header);
				sgp_acp_set_config('use_cookies', $use_cookies);
				sgp_acp_set_config('opt_irc_channels', $opt_irc_channels);
				sgp_acp_set_config('search_days', $search_days);
				sgp_acp_set_config('post_types', $post_types);
				sgp_acp_set_config('max_last_online', $max_last_online);
				sgp_acp_set_config('max_top_topics', $max_top_topics);
				sgp_acp_set_config('days_top_topics', $days_top_topics);
				sgp_acp_set_config('age_range_interval', $age_range_interval);
				sgp_acp_set_config('age_range_start', $age_range_start);
				sgp_acp_set_config('age_upper_limit', $age_upper_limit);
				sgp_acp_set_config('mini_mod_style_count', $mini_mod_style_count);
				sgp_acp_set_config('mini_mod_block_count', $mini_mod_block_count);
				sgp_acp_set_config('mini_mod_mod_count', $mini_mod_mod_count);
				sgp_acp_set_config('cloud_tcolour', $cloud_tcolour);
				sgp_acp_set_config('cloud_tcolour2', $cloud_tcolour2);
				sgp_acp_set_config('cloud_hicolour', $cloud_hicolour);
				sgp_acp_set_config('cloud_width', $cloud_width);
				sgp_acp_set_config('cloud_height', $cloud_height);
				sgp_acp_set_config('cloud_bg_colour', $cloud_bg_colour);
				sgp_acp_set_config('cloud_speed', $cloud_speed);
				sgp_acp_set_config('cloud_mode', $cloud_mode);
				sgp_acp_set_config('cloud_wmode', $cloud_wmode);
				sgp_acp_set_config('cloud_distr', $cloud_distr);
				sgp_acp_set_config('cloud_search_allow', $cloud_search_allow);
				sgp_acp_set_config('cloud_search_cache', $cloud_search_cache);
				sgp_acp_set_config('teamspeak_pw', $teamspeak_pw);
				sgp_acp_set_config('teamspeak_connection', $teamspeak_connection);
				sgp_acp_set_config('sgp_quick_reply', $sgp_quick_reply);
				sgp_acp_set_config('k_yourtube_link', $k_yourtube_link);
				sgp_acp_set_config('block_cache_time_default', $block_cache_time_default);
				sgp_acp_set_config('block_recent_cache_time', $block_recent_cache_time);

				$mode='reset';

				$template->assign_vars(array(
					'S_OPT' => $user->lang['SAVING'],
					'MESSAGE' => $user->lang['SAVED'],
				));

				$cache->destroy('sql', K_BLOCKS_CONFIG_VAR_TABLE);

				if ($block)
				{
					meta_refresh (2, append_sid("{$phpbb_admin_path}index.$phpEx", "i=k_vars&amp;mode=config&amp;block=" . $block));
				}
				else
				{
					meta_refresh (2, append_sid("{$phpbb_admin_path}index.$phpEx", "i=k_vars&amp;mode=config&amp;switch=" . $switch));
				}
				return;
			}
			case 'default': break;
		}

		switch ($action)
		{
			case 'submit':  $mode = 'reset';
			break;

			case 'default':
			break;
		}

	}
}

?>