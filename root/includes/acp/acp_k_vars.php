<?php
/**
*
* @package acp Stargate Portal
* @version $Id: acp_k_vars.php 335 2009-01-18 15:01:12Z Michealo $
* @copyright (c) 2007 Michael O'Toole aka michaelo
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* Last Updated: 27 March 2009 Mike
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

		include_once($phpbb_root_path . 'includes/sgp_functions.'.$phpEx);

		$message ='';

		$user->add_lang('acp/k_vars');
		$this->tpl_name = 'acp_k_vars';
		$this->page_title = 'ACP_K_VARS_CONFIG';

		$form_key = 'acp_k_vars';
		add_form_key($form_key);

		$choice = request_var('switch', ''); 
		$block = request_var('block', '');
		$mode	= request_var('mode', '');

		if($mode = 'config' && $choice == '')
			$choice = 'config';

		if($block)
		{
			$sql = "SELECT id, title FROM ". K_BLOCKS_TABLE . " 
				WHERE id = " . $block;
			$result = $db->sql_query($sql);

			$row = $db->sql_fetchrow($result);

			$title = strtoupper($row['title']);
			$title = str_replace(' ','_', $row['title']);
			$choice = strtoupper($title);

			$db->sql_freeresult($result);
		}

		// set S_SWITCH to load the correct variables in k_vars //
		switch ($choice)
		{
			case 'acronym':	
			{
				$template->assign_vars(array( 'S_SWITCH' => 'ACRONYM' )); 
				break; 
			}
			case 'cloud':
			{
				$template->assign_vars(array( 'S_SWITCH' => 'CLOUD_9' )); 
				break; 
			}
			case 'config':
			{
				$template->assign_vars(array( 'S_SWITCH' => 'DEFAULT_CONFIG' )); 
				break; 
			}
			case 'STYLE_DEVELOPMENT':
			{
				$template->assign_vars(array( 'S_SWITCH' => 'STYLE_DEVELOPMENT' )); 
				break; 
			}
			case 'BLOCK_DEVELOPMENT':
			{
				$template->assign_vars(array( 'S_SWITCH' => 'STYLE_DEVELOPMENT' )); 
				break; 
			}
			case 'MOD_DEVELOPMENT':
			{
				$template->assign_vars(array( 'S_SWITCH' => 'STYLE_DEVELOPMENT' )); 
				break; 
			}
			case $choice:
			{
				$template->assign_vars(array( 'S_SWITCH' => $choice )); 
				break;
			}
			default:
			{
				$template->assign_vars(array( 'S_SWITCH' => 'MISC' )); 
				break;
			}
		}

		$block = (request_var('block', '')) ? request_var('block', '') : 0;

		$action = request_var('action', '');
		$submit = (isset($_POST['submit'])) ? true : false;

		$forum_id	= request_var('f', 0);
		$forum_data = $errors = array();

		if ($submit && !check_form_key($form_key))
		{
			$submit = false;
			$mode = '';
			trigger_error($user->lang['FORM_INVALID']);
		}
/*
		if($block == '')
			$wheresql = '';
		else
			$wheresql = ' WHERE k_var_id = ' . $block;
*/
		$wheresql = '';

		//$sql = 'SELECT config_name, config_value, k_var_id

		$sql = 'SELECT config_name, config_value
			FROM ' . K_BLOCKS_CONFIG_VAR_TABLE . $wheresql;
 
		$result = $db->sql_query($sql);

		while($row = $db->sql_fetchrow($result))
		{
			$k_config[$row['config_name']] = $row['config_value'];
		}

		$template->assign_vars(array(
			'S_ALLOW_ACRONMYS'                      => ($k_config['allow_acronyms']) ? true : false,
			'S_ALLOW_ANNOUNCE'                      => ($k_config['allow_announce']) ? true : false,
			'S_ALLOW_BOT_DISPLAY'                   => ($k_config['allow_bot_display']) ? TRUE : FALSE,
			'S_ALLOW_FOOTER_IMAGES'					=> ($k_config['allow_footer_images']) ? true : false,
			'S_ALLOW_NEWS'                          => ($k_config['allow_news']) ? TRUE : FALSE,
			'S_K_SHOW_SMILIES'						=> ($k_config['k_show_smilies']) ? true : false,
			'S_DISPLAY_BLOCKS_GLOBAL'				=> ($k_config['display_blocks_global']) ? true : false,
			'S_RAND_LOGO'							=> ($k_config['allow_rotating_logos']) ? true : false,
			'S_USE_COOKIES'							=> ($k_config['use_cookies']) ? true : false,
			'S_NEWS_TYPE'					    	=> $k_config['news_type'],
			'S_NUMBER_OF_NEWS_ITEMS_TO_DISPLAY'	    => $k_config['number_of_news_items_to_display'],
			'S_NUMBER_OF_LINKS_TO_DISPLAY'			=> $k_config['number_of_links_to_display'],
			'S_MAX_NEWS_ITEM_LENGTH'	            => $k_config['max_news_item_length'],
			'S_NUMBER_OF_ANNOUNCE_ITEMS_TO_DISPLAY'	=> $k_config['number_of_announce_items_to_display'],
			'S_MAX_ANNOUNCE_ITEM_LENGTH'	        => $k_config['max_announce_item_length'],
			'S_ANNOUNCE_TYPE'	           	        => $k_config['announce_type'],
			'S_LINK_TO_US_IMAGE'					=> $k_config['link_to_us_image'],
			'S_LINK_FORUM_ID'						=> $k_config['link_forum_id'],
			'S_RAND_BANNER'							=> $k_config['rand_banner'],
			'S_RAND_HEADER'							=> $k_config['rand_header'],
			'S_NUMBER_OF_RECENT_TOPICS_TO_DISPLAY'	=> $k_config['number_of_recent_topics_to_display'],
			'S_NUMBER_OF_TOPICS_PER_FORUM'			=> $k_config['number_of_topics_per_forum'],
			'S_NUMBER_OF_BOTS_TO_DISPLAY'           => $k_config['number_of_bots_to_display'],
			'S_NUMBER_OF_TOP_POSTERS_TO_DISPLAY'	=> $k_config['number_of_top_posters_to_display'],
			'S_NUMBER_OF_TOP_REFERRALS_TO_DISPLAY'	=> $k_config['number_of_top_referrals_to_display'],
			'S_NUMBER_OF_TEAM_MEMBERS_TO_DISPLAY'	=> $k_config['number_of_team_members_to_display'],

			'S_TEAMSPEAK_PW'						=> $k_config['teamspeak_pw'],
			'S_TEAMSPEAK_CONNECTION'				=> $k_config['teamspeak_connection'],

			'S_OPT_IRC_CHANNELS'					=> $k_config['opt_irc_channels'],
			'S_SEARCH_DAYS'							=> $k_config['search_days'],
			'S_POST_TYPES'							=> $k_config['post_types'],
			'S_MAX_LAST_ONLINE'						=> $k_config['max_last_online'],
			'S_MAX_TOP_TOPICS'						=> $k_config['max_top_topics'],
			'S_AGE_RANGE_INTERVAL'					=> $k_config['age_range_interval'],
			'S_AGE_RANGE_START'						=> $k_config['age_range_start'],
			'S_AGE_UPPER_LIMIT'						=> $k_config['age_upper_limit'],

			'S_MINI_MOD_STYLE_COUNT'				=>$k_config['mini_mod_style_count'],
			'S_MINI_MOD_BLOCK_COUNT'				=>$k_config['mini_mod_block_count'],
			'S_MINI_MOD_MOD_COUNT'					=>$k_config['mini_mod_mod_count'],

			'S_CLOUD_MAX_TAGS'						=> $k_config['cloud_max_tags'],
			'S_CLOUD_MOVIE'							=> $k_config['cloud_movie'],
			'S_CLOUD_TCOLOUR'						=> $k_config['cloud_tcolour'],
			'S_CLOUD_TCOLOUR'						=> $k_config['cloud_tcolour'],
			'S_CLOUD_TCOLOUR2'						=> $k_config['cloud_tcolour2'],
			'S_CLOUD_HICOLOUR'						=> $k_config['cloud_hicolour'],
			'S_CLOUD_WIDTH'							=> $k_config['cloud_width'],
			'S_CLOUD_HEIGHT'						=> $k_config['cloud_height'],
			'S_CLOUD_BG_COLOUR'						=> $k_config['cloud_bg_colour'],
			'S_CLOUD_SPEED'							=> $k_config['cloud_speed'],
			'S_CLOUD_MODE'							=> $k_config['cloud_mode'],
			'S_CLOUD_WMODE'							=> $k_config['cloud_wmode'],
			'S_CLOUD_DISTR'							=> $k_config['cloud_distr'],
			'S_CLOUD_WMODE'							=> $k_config['cloud_wmode'],

			'S_SHOW_BLOCKS_ON_INDEX_L'				=> $k_config['show_lb_ipsmuy'][0] ? true : false,
			'S_SHOW_BLOCKS_ON_INDEX_R'				=> $k_config['show_rb_ipsmuy'][0] ? true : false,
			'S_SHOW_BLOCKS_ON_PORTAL_L'				=> $k_config['show_lb_ipsmuy'][1] ? true : false,
			'S_SHOW_BLOCKS_ON_PORTAL_R'				=> $k_config['show_rb_ipsmuy'][1] ? true : false,
			'S_SHOW_BLOCKS_ON_SEARCH_L'				=> $k_config['show_lb_ipsmuy'][2] ? true : false,
			'S_SHOW_BLOCKS_ON_SEARCH_R'				=> $k_config['show_rb_ipsmuy'][2] ? true : false,
			'S_SHOW_BLOCKS_ON_MCP_L'				=> $k_config['show_lb_ipsmuy'][3] ? true : false,
			'S_SHOW_BLOCKS_ON_MCP_R'				=> $k_config['show_rb_ipsmuy'][3] ? true : false,
			'S_SHOW_BLOCKS_ON_UCP_L'				=> $k_config['show_lb_ipsmuy'][4] ? true : false,
			'S_SHOW_BLOCKS_ON_UCP_R'				=> $k_config['show_rb_ipsmuy'][4] ? true : false,
			'S_SHOW_BLOCKS_ON_MEM_L'				=> $k_config['show_lb_ipsmuy'][5] ? true : false,
			'S_SHOW_BLOCKS_ON_MEM_R'				=> $k_config['show_rb_ipsmuy'][5] ? true : false,

		));

		$db->sql_freeresult($result);

		//$template->assign_vars(array('S_OPT' => 'Configure'));

		$template->assign_vars(array(
			'S_OPT' => 'Configure',
			'MESSAGE' => '',
		));

		if($submit)
		{
			$mode = 'save';
		}
		else
			$mode = 'reset';

		switch ($mode)
		{
			case 'save':
			{
				//$news_forum_id							= $_POST['news_forum_id'];
				$allow_acronyms							= request_var('allow_acronyms', '');
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
				$mini_mod_style_count					= request_var('mini_mod_style_count', '');
				$mini_mod_block_count					= request_var('mini_mod_block_count', '');
				$mini_mod_mod_count						= request_var('mini_mod_mod_count', '');

				$teamspeak_pw							= request_var('teamspeak_pw', '');
				$teamspeak_connection					= request_var('teamspeak_connection', '');

				$k_show_smilies							= request_var('k_show_smilies', '');
				$rand_banner							= request_var('rand_banner', '');
				$rand_header							= request_var('rand_header', '');
				$use_cookies							= request_var('use_cookies', '');
				$opt_irc_channels						= request_var('opt_irc_channels', '');
				$search_days							= request_var('search_days', '');
				$post_types								= request_var('post_types', '');
				$max_last_online						= request_var('max_last_online', '');
				$max_top_topics							= request_var('max_top_topics', '');
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
				$teamspeak_pw								= request_var('teamspeak_pw', '');
				$teamspeak_connection								= request_var('teamspeak_connection', '');
 
				$k_config['show_lb_ipsmuy'][0]			= request_var('show_blocks_on_index_l', '');
				$k_config['show_rb_ipsmuy'][0]			= request_var('show_blocks_on_index_r', '');
				$k_config['show_lb_ipsmuy'][1]			= request_var('show_blocks_on_portal_l', '');
				$k_config['show_rb_ipsmuy'][1]			= request_var('show_blocks_on_portal_r', '');
				$k_config['show_lb_ipsmuy'][2]			= request_var('show_blocks_on_search_l', '');
				$k_config['show_rb_ipsmuy'][2]			= request_var('show_blocks_on_search_r', '');
				$k_config['show_lb_ipsmuy'][3]			= request_var('show_blocks_on_mcp_l', '');
				$k_config['show_rb_ipsmuy'][3]			= request_var('show_blocks_on_mcp_r', '');
				$k_config['show_lb_ipsmuy'][4]			= request_var('show_blocks_on_ucp_l', '');
				$k_config['show_rb_ipsmuy'][4]			= request_var('show_blocks_on_ucp_r', '');
				$k_config['show_lb_ipsmuy'][5]			= request_var('show_blocks_on_members_l', '');
				$k_config['show_rb_ipsmuy'][5]			= request_var('show_blocks_on_members_r', '');

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
				sgp_acp_set_config('rand_banner', $rand_banner);
				sgp_acp_set_config('rand_header', $rand_header);
				sgp_acp_set_config('use_cookies', $use_cookies);
				sgp_acp_set_config('opt_irc_channels', $opt_irc_channels);
				sgp_acp_set_config('search_days', $search_days);
				sgp_acp_set_config('post_types', $post_types);
				sgp_acp_set_config('max_last_online', $max_last_online);
				sgp_acp_set_config('max_top_topics', $max_top_topics);
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

				sgp_acp_set_config('teamspeak_pw', $teamspeak_pw);
				sgp_acp_set_config('teamspeak_connection', $teamspeak_connection);

				sgp_acp_set_config('show_lb_ipsmuy', $k_config['show_lb_ipsmuy']);
				sgp_acp_set_config('show_rb_ipsmuy', $k_config['show_rb_ipsmuy']);

				$mode='reset';

				$message = $user->lang['SAVED_BUT_PURGE_REQD'];

				$template->assign_vars(array(
					'S_OPT' => $user->lang['SAVING'],
					'MESSAGE' => $message,
				));

				meta_refresh(3, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_vars&amp;mode=config&amp;block=$block");
				return;
				break;
			}
			case 'default': break;
		}

		switch ($action)
		{
			case 'submit':  $mode = 'reset'; break;
			case 'default': break;
		}

	}
}

/* optional code 
		$slboi = $k_config['show_lb_ipsmuy'];
		$srboi = $k_config['show_rb_ipsmuy'];
			'S_SHOW_BLOCKS_ON_INDEX_L'				=> $slboi[0] ? true : false,
			'S_SHOW_BLOCKS_ON_INDEX_R'				=> $srboi[0] ? true : false,
				$slboi[0]	= request_var('show_blocks_on_index_l', '');
				$srboi[0]	= request_var('show_blocks_on_index_r', '');
				//sgp_acp_set_config('show_lb_ipsmuy', $slboi);
				//sgp_acp_set_config('show_rb_ipsmuy', $srboi);
*/

?>