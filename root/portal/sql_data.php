<?php
if (!defined('UMIL_AUTO')) // keep mpv happy
{
	exit;
}
if (!defined('IN_PHPBB')) // keep mpv happy
{
	exit;
}

// Now for all the tables and data ... not sure if this is efficient but it works //
$k_acronyms_table = 'phpbb_k_acronyms';
$k_acronyms_array = array();
$k_acronyms_array[] = array(
	'acronym_id'	=> '1',
	'acronym'		=> ' SGP ',
	'meaning'		=> 'Stargate Portal (the original phpBB3 Portal by Michaelo and the Stargate Team)',
	'lang'			=> 'en',
);
$k_acronyms_array[] = array(
	'acronym_id'	=> '2',
	'acronym'		=> ' IntegraMod ',
	'meaning'		=> 'The best fully integrated phpBB pre-mod version ever.',
	'lang'			=> 'en',
);
$k_acronyms_array[] = array(
	'acronym_id'	=> '3',
	'acronym'		=> ' IM3 ',
	'meaning'		=> 'A fully integrated phpBB3 forum, incorporating IntegraMod, Stargate Portal and hundreds of mods..',
	'lang'			=> 'en',
);
$k_acronyms_array[] = array(
	'acronym_id'	=> '4',
	'acronym'		=> ' phpbb ',
	'meaning'		=> 'The best forum software ever...',
	'lang'			=> 'en',
);
$k_acronyms_array[] = array(
	'acronym_id'	=> '5',
	'acronym'		=> ' Stargate Portal ',
	'meaning'		=> 'The original and best portal for phpBB3',
	'lang'			=> 'en',
);

$k_blocks_table = 'phpbb_k_blocks';
$k_blocks_array = array();
$k_blocks_array[] = array(
	'id'			=> '1',
	'ndx'			=> '1',
	'title'			=> 'Site Navigator',
	'position'		=> 'L',
	'type'			=> 'H',
	'active'		=> '1',
	'html_file_name'=> 'block_menus.html',
	'var_file_name'	=> '',
	'img_file_name'	=> 'menu.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '2',
	'ndx'			=> '2',
	'title'			=> 'Sub_Menu',
	'position'		=> 'L',
	'type'			=> 'H',
	'active'		=> '1',
	'html_file_name'=> 'block_sub_menus.html',
	'var_file_name'	=> '',
	'img_file_name'	=> 'sub_menu.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '3',
	'ndx'			=> '3',
	'title'			=> 'Style Select',
	'position'		=> 'L',
	'type'			=> 'H',
	'active'		=> '1',
	'html_file_name'=> 'block_style_select.html',
	'var_file_name'	=> '',
	'img_file_name'	=> 'gallery.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '4',
	'ndx'			=> '4',
	'title'			=> 'Online Users',
	'position'		=> 'L',
	'type'			=> 'H',
	'active'		=> '1',
	'html_file_name'=> 'block_online_users.html',
	'var_file_name'	=> '',
	'img_file_name'	=> 'online_users.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '5',
	'ndx'			=> '5',
	'title'			=> 'Last Online',
	'position'		=> 'L',
	'type'			=> 'H',
	'active'		=> '1',
	'html_file_name'=> 'block_last_online.html',
	'var_file_name'	=> 'k_last_online_vars.html',
	'img_file_name'	=> 'team.gif',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '6',
	'ndx'			=> '6',
	'title'			=> 'Recent Topics',
	'position'		=> 'L',
	'type'			=> 'H',
	'active'		=> '0',
	'html_file_name'=> 'block_recent_topics.html',
	'var_file_name'	=> 'k_recent_topics_vars.html 	',
	'img_file_name'	=> 'message.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '1',
	'block_height'	=> '200',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '7',
	'ndx'			=> '7',
	'title'			=> 'Bot Tracker',
	'position'		=> 'L',
	'type'			=> 'H',
	'active'		=> '1',
	'html_file_name'=> 'block_bot_tracker.html',
	'var_file_name'	=> 'k_bot_vars.html',
	'img_file_name'	=> 'user.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '8',
	'ndx'			=> '8',
	'title'			=> 'Search',
	'position'		=> 'L',
	'type'			=> 'H',
	'active'		=> '1',
	'html_file_name'=> 'block_search.html',
	'var_file_name'	=> '',
	'img_file_name'	=> 'search.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '9',
	'ndx'			=> '9',
	'title'			=> 'Style Development',
	'position'		=> 'L',
	'type'			=> 'H',
	'active'		=> '0',
	'html_file_name'=> 'block_styles_status.html',
	'var_file_name'	=> '',
	'img_file_name'	=> 'gallery.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '10',
	'ndx'			=> '10',
	'title'			=> 'Categories',
	'position'		=> 'L',
	'type'			=> 'H',
	'active'		=> '1',
	'html_file_name'=> 'block_forum_categories.html',
	'var_file_name'	=> '',
	'img_file_name'	=> 'categories.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '11',
	'ndx'			=> '11',
	'title'			=> 'Books',
	'position'		=> 'L',
	'type'			=> 'H',
	'active'		=> '1',
	'html_file_name'=> 'block_books.html',
	'var_file_name'	=> '',
	'img_file_name'	=> 'books.gif',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '12',
	'ndx'			=> '1',
	'title'			=> '',
	'position'		=> 'C',
	'type'			=> 'H',
	'active'		=> '1',
	'html_file_name'=> 'block_welcome_message.html',
	'var_file_name'	=> '',
	'img_file_name'	=> 'none.gif',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '1',
	'mod_block_id'	=> '1',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '13',
	'ndx'			=> '2',
	'title'			=> 'Announcements',
	'position'		=> 'C',
	'type'			=> 'H',
	'active'		=> '1',
	'html_file_name'=> 'block_announcements.html',
	'var_file_name'	=> 'k_announce_vars.html',
	'img_file_name'	=> 'announcements.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '14',
	'ndx'			=> '3',
	'title'			=> 'Recent Topics',
	'position'		=> 'C',
	'type'			=> 'H',
	'active'		=> '1',
	'html_file_name'=> 'block_recent_topics_wide.html',
	'var_file_name'	=> 'k_recent_topics_vars.html',
	'img_file_name'	=> 'recent_topics.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '200',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '15',
	'ndx'			=> '4',
	'title'			=> 'News Report',
	'position'		=> 'C',
	'type'			=> 'H',
	'active'		=> '1',
	'html_file_name'=> 'block_news_advanced.html',
	'var_file_name'	=> 'k_news_vars.html',
	'img_file_name'	=> 'news.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '16',
	'ndx'			=> '5',
	'title'			=> 'Unresolved/Bugs',
	'position'		=> 'C',
	'type'			=> 'H',
	'active'		=> '0',
	'html_file_name'=> 'block_unresolved_errs.html',
	'var_file_name'	=> '',
	'img_file_name'	=> 'bug.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '17',
	'ndx'			=> '6',
	'title'			=> 'RSS',
	'position'		=> 'C',
	'type'			=> 'H',
	'active'		=> '0',
	'html_file_name'=> 'block_rss_feeds.html',
	'var_file_name'	=> '',
	'img_file_name'	=> 'rss.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '18',
	'ndx'			=> '1',
	'title'			=> 'User Information',
	'position'		=> 'R',
	'type'			=> 'H',
	'active'		=> '1',
	'html_file_name'=> 'block_user_information.html',
	'var_file_name'	=> '',
	'img_file_name'	=> 'user.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '19',
	'ndx'			=> '2',
	'title'			=> 'Cloud 9',
	'position'		=> 'R',
	'type'			=> 'H',
	'active'		=> '0',
	'html_file_name'=> 'block_cloud.html',
	'var_file_name'	=> 'k_cloud_vars.html',
	'img_file_name'	=> 'modules.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '20',
	'ndx'			=> '3',
	'title'			=> 'The Team',
	'position'		=> 'R',
	'type'			=> 'H',
	'active'		=> '1',
	'html_file_name'=> 'block_the_team.html',
	'var_file_name'	=> 'k_the_team_vars.html',
	'img_file_name'	=> 'team.gif',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '21',
	'ndx'			=> '4',
	'title'			=> 'Top Posters',
	'position'		=> 'R',
	'type'			=> 'H',
	'active'		=> '1',
	'html_file_name'=> 'block_top_posters.html',
	'var_file_name'	=> 'k_top_posters_vars.html',
	'img_file_name'	=> 'rating.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '22',
	'ndx'			=> '5',
	'title'			=> 'Top Referrals',
	'position'		=> 'R',
	'type'			=> 'H',
	'active'		=> '1',
	'html_file_name'=> 'block_top_referrals.html',
	'var_file_name'	=> 'k_top_referrals_vars.html',
	'img_file_name'	=> 'rating.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '23',
	'ndx'			=> '6',
	'title'			=> 'Most Active Topics',
	'position'		=> 'R',
	'type'			=> 'H',
	'active'		=> '1',
	'html_file_name'=> 'block_top_topics.html',
	'var_file_name'	=> 'k_top_topics_vars.html',
	'img_file_name'	=> 'most_active_topics.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '24',
	'ndx'			=> '7',
	'title'			=> 'Site Statistics',
	'position'		=> 'R',
	'type'			=> 'H',
	'active'		=> '0',
	'html_file_name'=> 'block_statistics.html',
	'var_file_name'	=> '',
	'img_file_name'	=> 'statistics.gif',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '25',
	'ndx'			=> '8',
	'title'			=> 'Clock',
	'position'		=> 'R',
	'type'			=> 'H',
	'active'		=> '1',
	'html_file_name'=> 'block_clock.html',
	'var_file_name'	=> '',
	'img_file_name'	=> 'clock.gif',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '26',
	'ndx'			=> '9',
	'title'			=> 'MP3 Player',
	'position'		=> 'R',
	'type'			=> 'H',
	'active'		=> '1',
	'html_file_name'=> 'block_mp3_player.html',
	'var_file_name'	=> '',
	'img_file_name'	=> 'mp3.gif',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '27',
	'ndx'			=> '10',
	'title'			=> 'Links',
	'position'		=> 'R',
	'type'			=> 'H',
	'active'		=> '0',
	'html_file_name'=> 'block_links.html',
	'var_file_name'	=> 'k_links_vars.html',
	'img_file_name'	=> 'www.gif',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '1',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '28',
	'ndx'			=> '11',
	'title'			=> 'Link to us',
	'position'		=> 'R',
	'type'			=> 'H',
	'active'		=> '0',
	'html_file_name'=> 'block_link_to_us.html',
	'var_file_name'	=> 'k_link_to_us_vars.html',
	'img_file_name'	=> 'work.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '29',
	'ndx'			=> '12',
	'title'			=> 'Site Survey',
	'position'		=> 'R',
	'type'			=> 'H',
	'active'		=> '0',
	'html_file_name'=> 'block_site_survey.html',
	'var_file_name'	=> '',
	'img_file_name'	=> 'site_statistics.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '30',
	'ndx'			=> '13',
	'title'			=> 'Top Downloads',
	'position'		=> 'R',
	'type'			=> 'H',
	'active'		=> '0',
	'html_file_name'=> 'block_top_downloads.html',
	'var_file_name'	=> '',
	'img_file_name'	=> 'stats.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '31',
	'ndx'			=> '14',
	'title'			=> 'Translate',
	'position'		=> 'R',
	'type'			=> 'H',
	'active'		=> '1',
	'html_file_name'=> 'block_translate.html',
	'var_file_name'	=> '',
	'img_file_name'	=> 'bf_trans.gif',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '32',
	'ndx'			=> '15',
	'title'			=> 'Portal Status',
	'position'		=> 'R',
	'type'			=> 'H',
	'active'		=> '1',
	'html_file_name'=> 'block_portal_status.html',
	'var_file_name'	=> '',
	'img_file_name'	=> 'portal_status.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '1',
	'mod_block_id'	=> '5',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '33',
	'ndx'			=> '16',
	'title'			=> 'Downloads',
	'position'		=> 'R',
	'type'			=> 'H',
	'active'		=> '0',
	'html_file_name'=> 'block_downloads.html',
	'var_file_name'	=> '',
	'img_file_name'	=> 'none.gif',
	'view_by'		=> '5',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '34',
	'ndx'			=> '17',
	'title'			=> 'IRC Chat',
	'position'		=> 'R',
	'type'			=> 'H',
	'active'		=> '1',
	'html_file_name'=> 'block_irc.html',
	'var_file_name'	=> 'k_irc_vars.html',
	'img_file_name'	=> 'irc_chat.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '35',
	'ndx'			=> '19',
	'title'			=> 'Age Ranges',
	'position'		=> 'R',
	'type'			=> 'H',
	'active'		=> '1',
	'html_file_name'=> 'block_age_ranges.html',
	'var_file_name'	=> 'k_age_ranges_vars.html',
	'img_file_name'	=> 'staff.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);
$k_blocks_array[] = array(
	'id'			=> '36',
	'ndx'			=> '11',
	'title'			=> 'Poll',
	'position'		=> 'R',
	'type'			=> 'H',
	'active'		=> '0',
	'html_file_name'=> 'block_poll.html',
	'var_file_name'	=> '',
	'img_file_name'	=> 'rating.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
);

$k_blocks_array[] = array(
	'id'			=> '37',
	'ndx'			=> '18',
	'title'			=> 'Block development',
	'position'		=> 'R',
	'type'			=> 'H',
	'active'		=> '0',
	'html_file_name'=> 'block_dev_status.html',
	'var_file_name'	=> '',
	'img_file_name'	=> 'modules.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '1',
	'mod_block_id'	=> '4',
	'is_static'		=> '0',
);

$k_blocks_config_table = 'phpbb_k_blocks_config';
$k_blocks_config_array = array();
$k_blocks_config_array[] = array(
	'id'					=> '1',
	'blocks_width'			=> '180',
	'blocks_enabled'		=> '1',
	'use_external_files'	=> '0',
	'update_files'			=> '0',
	'layout_default'		=> '2',
	'portal_version'		=> '1.0.0',
	'portal_config'			=> 'Site',
);

$k_blocks_config_vars_table = 'phpbb_k_blocks_config_vars';
$k_blocks_config_vars_array = array();
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'allow_acronyms',
	'config_value'	=> '1',
	'is_dynamic'	=> '1',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'allow_announce',
	'config_value'	=> '1',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'allow_bot_display',
	'config_value'	=> '1',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'allow_footer_images',
	'config_value'	=> '1',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'allow_news',
	'config_value'	=> '1',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'allow_rotating_logos',
	'config_value'	=> '1',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'announce_type',
	'config_value'	=> '0',
	'is_dynamic'	=> '1',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'display_blocks_global',
	'config_value'	=> '1',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'k_show_smilies',
	'config_value'	=> '1',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'link_forum_id',
	'config_value'	=> '5',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'link_to_us_image',
	'config_value'	=> 'phpbbireland.gif',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'links_scroll_amount',
	'config_value'	=> '0',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'links_scroll_direction',
	'config_value'	=> '0',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'max_announce_item_length',
	'config_value'	=> '400',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'max_news_item_length',
	'config_value'	=> '350',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'max_last_online',
	'config_value'	=> '10',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'news_type',
	'config_value'	=> '0',
	'is_dynamic'	=> '1',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'number_of_announce_items_to_display',
	'config_value'	=> '5',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'number_of_bots_to_display',
	'config_value'	=> '10',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'number_of_links_to_display',
	'config_value'	=> '5',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'number_of_news_items_to_display',
	'config_value'	=> '5',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'number_of_recent_topics_to_display',
	'config_value'	=> '25',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'number_of_topics_per_forum',
	'config_value'	=> '5',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'number_of_team_members_to_display',
	'config_value'	=> '10',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'number_of_top_posters_to_display',
	'config_value'	=> '10',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'number_of_top_referrals_to_display',
	'config_value'	=> '5',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'poll_forum_id',
	'config_value'	=> '2',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'poll_position', 'right',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'poll_post_id', '0',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'poll_topic_id',
	'config_value'	=> '0',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'poll_view',
	'config_value'	=> 'full',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'rand_banner',
	'config_value'	=> '0',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'rss_feeds_cache_time',
	'config_value'	=> '3600',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'rss_feeds_items_limit',
	'config_value'	=> '5',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'rss_feeds_random_limit',
	'config_value'	=> '4',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'rss_feeds_type',
	'config_value'	=> 'fopen',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'show_top_posters',
	'config_value'	=> '1',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'use_cookies',
	'config_value'	=> '1',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'num_refviews',
	'config_value'	=> '5',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'referrals_enabled',
	'config_value'	=> '1',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'rand_header',
	'config_value'	=> '1',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'opt_irc_channels',
	'config_value'	=> '#stargateportal',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'search_days',
	'config_value'	=> '7',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'post_types',
	'config_value'	=> '1',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'max_top_topics',
	'config_value'	=> '5',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'age_range_interval',
	'config_value'	=> '15',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'age_range_start',
	'config_value'	=> '1',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'age_upper_limit',
	'config_value'	=> '101',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'show_lb_ipsmuy',
	'config_value'	=> '1111111',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'show_rb_ipsmuy',
	'config_value'	=> '0011000',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'cloud_max_tags',
	'config_value'	=> '30',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'cloud_movie',
	'config_value'	=> 'tagcloud.swf',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'cloud_width',
	'config_value'	=> '156',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'cloud_height',
	'config_value'	=> '156',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'cloud_bg_colour',
	'config_value'	=> '272829',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'cloud_speed',
	'config_value'	=> '150',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'cloud_mode',
	'config_value'	=> 'both',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'cloud_tcolour',
	'config_value'	=> 'FFFFFF',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'cloud_tcolour2',
	'config_value'	=> '99ccff',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'cloud_hicolour',
	'config_value'	=> '00ff00',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'cloud_distr',
	'config_value'	=> '1',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'cloud_wmode',
	'config_value'	=> 'transparent',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'mini_mod_block_count',
	'config_value'	=> '3',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'mini_mod_style_count',
	'config_value'	=> '5',
	'is_dynamic'	=> '1',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'mini_mod_mod_count',
	'config_value'	=> '5',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'mp3_folder',
	'config_value'	=> 'music',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'teamspeak_pw',
	'config_value'	=> '',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'teamspeak_connection',
	'config_value'	=> '',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'adm_block',
	'config_value'	=> '',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'cloud_search_allow',
	'config_value'	=> '1',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'cloud_search_cache',
	'config_value'	=> '300',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'block_cache_time',
	'config_value'	=> '300',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'sgp_quick_reply',
	'config_value'	=> '1',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'recent_topics_search_exclude',
	'config_value'	=> '',
	'is_dynamic'	=> '0',
);


$k_cloud_table = 'phpbb_k_cloud';
$k_cloud_array = array();
$k_cloud_array[] = array(
	'tag_id'	=> '1',
	'is_active'	=> '1',
	'tag'		=> '1',
	'link'		=> 'http://www.phpbbireland.com',
	'rel'		=> 'tag',
	'font_size'	=> '14',
	'colour'	=> '669933',
	'colour2'	=> '333333',
	'hcolour'	=> 'FF0000',
	'text'		=> 'Stargate Portal',
);
$k_cloud_array[] = array(
	'tag_id'	=> '2',
	'is_active'	=> '1',
	'tag'		=> '1',
	'link'		=> 'http://www.phpbb.com',
	'rel'		=> 'tag',
	'font_size'	=> '12',
	'colour'	=> '66CC33',
	'colour2'	=> 'FFCCFF',
	'hcolour'	=> '00CC00',
	'text'		=> 'phpBB',
);
$k_cloud_array[] = array(
	'tag_id'	=> '3',
	'is_active'	=> '1',
	'tag'		=> '1',
	'link'		=> 'http://www.stargate-portal.com',
	'rel'		=> 'tag',
	'font_size'	=> '14',
	'colour'	=> 'FF3300',
	'colour2'	=> 'CC3366',
	'hcolour'	=> '33CC00',
	'text'		=> 'Dev Site',
);
$k_cloud_array[] = array(
	'tag_id'	=> '4',
	'is_active'	=> '1',
	'tag'		=> '1',
	'link'		=> 'http://www.integramod.com/forum/portal.php',
	'rel'		=> 'tag',
	'font_size'	=> '14',
	'colour'	=> '66CCFF',
	'colour2'	=> 'FFCCFF',
	'hcolour'	=> '99FF66',
	'text'		=> 'IntegraMOD3',
);


$k_quotes_table = 'phpbb_k_quotes';
$k_quotes_array = array();
$k_quotes_array[] = array(
	'quote_id'	=> '1',
	'quote'		=> 'Anyone who lives within their means suffers from a lack of imagination.',
	'author'	=> 'Oscar Wilde',
);
$k_quotes_array[] = array(
	'quote_id'	=> '2',
	'quote'		=> 'I was working on the proof of one of my poems all the morning, and took out a comma. In the afternoon I put it back again.',
	'author'	=> 'Oscar Wilde',
);


$k_menus_table = 'phpbb_k_menus';
$k_menus_array = array();
$k_menus_array[] = array(
	'm_id'			=> '1',
	'ndx'			=> '1',
	'menu_type'		=> '1',
	'name'			=> 'Main Menu',
	'link_to'		=> '',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'none.gif',
	'view_by'		=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '1',
);
$k_menus_array[] = array(
	'm_id'			=> '2',
	'ndx'			=> '2',
	'menu_type'		=> '1',
	'name'			=> 'Portal',
	'link_to'		=> 'portal.php',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_home.png',
	'view_by'		=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'm_id'			=> '3',
	'ndx'			=> '3',
	'menu_type'		=> '1',
	'name'			=> 'Forum',
	'link_to'		=> 'index.php',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_home2.png',
	'view_by'		=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'm_id'			=> '4',
	'ndx'			=> '4',
	'menu_type'		=> '1',
	'name'			=> 'Navigator',
	'link_to'		=> '',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'none.gif',
	'view_by'		=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '1',
);
$k_menus_array[] = array(
	'm_id'			=> '5',
	'ndx'			=> '5',
	'menu_type'		=> '1',
	'name'			=> 'Album',
	'link_to'		=> 'inprogress.php',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_edit_img.png',
	'view_by'		=> '0',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'm_id'			=> '6',
	'ndx'			=> '6',
	'menu_type'		=> '1',
	'name'			=> 'Bookmarks',
	'link_to'		=> 'ucp.php?i=main&amp;mode=bookmarks',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_bookmark.png',
	'view_by'		=> '2',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'm_id'			=> '7',
	'ndx'			=> '7',
	'menu_type'		=> '1',
	'name'			=> 'Downloads',
	'link_to'		=> 'inprogress.php',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_ff.png',
	'view_by'		=> '0',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'm_id'			=> '8',
	'ndx'			=> '8',
	'menu_type'		=> '1',
	'name'			=> 'Links',
	'link_to'		=> 'inprogress.php',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_link.gif',
	'view_by'		=> '0',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'm_id'			=> '9',
	'ndx'			=> '9',
	'menu_type'		=> '1',
	'name'			=> 'Members',
	'link_to'		=> 'memberlist.php',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_chat.png',
	'view_by'		=> '2',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'm_id'			=> '10',
	'ndx'			=> '10',
	'menu_type'		=> '1',
	'name'			=> 'Ratings',
	'link_to'		=> 'index.php',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_rating.png',
	'view_by'		=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'm_id'			=> '11',
	'ndx'			=> '11',
	'menu_type'		=> '1',
	'name'			=> 'Rules',
	'link_to'		=> 'basic_rules.php',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_terms_of_use.png',
	'view_by'		=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'm_id'			=> '12',
	'ndx'			=> '12',
	'menu_type'		=> '1',
	'name'			=> 'Staff',
	'link_to'		=> 'memberlist.php?mode=leaders',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_staff.png',
	'view_by'		=> '2',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'm_id'			=> '13',
	'ndx'			=> '13',
	'menu_type'		=> '1',
	'name'			=> 'Statistics',
	'link_to'		=> 'inprogress.php',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_pie.png',
	'view_by'		=> '0',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'm_id'			=> '14',
	'ndx'			=> '14',
	'menu_type'		=> '1',
	'name'			=> 'UCP',
	'link_to'		=> 'ucp.php',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_links.gif',
	'view_by'		=> '2',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'm_id'			=> '15',
	'ndx'			=> '15',
	'menu_type'		=> '1',
	'name'			=> 'Chat',
	'link_to'		=> 'chat/index.php',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_chat.png',
	'view_by'		=> '0',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'm_id'			=> '16',
	'ndx'			=> '16',
	'menu_type'		=> '1',
	'name'			=> 'Admin Menu',
	'link_to'		=> '',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'none.gif',
	'view_by'		=> '5',
	'soft_hr'		=> '0',
	'sub_heading'	=> '1',
);
$k_menus_array[] = array(
	'm_id'			=> '17',
	'ndx'			=> '17',
	'menu_type'		=> '1',
	'name'			=> 'ACP',
	'link_to'		=> 'adm/index.php',
	'append_sid'	=> '1',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_work.png',
	'view_by'		=> '5',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'm_id'			=> '18',
	'ndx'			=> '18',
	'menu_type'		=> '1',
	'name'			=> 'REFRESH_ALL',
	'link_to'		=> 'sgp_refresh.php',
	'append_sid'	=> '1',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_bin.png',
	'view_by'		=> '5',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'm_id'			=> '19',
	'ndx'			=> '1',
	'menu_type'		=> '2',
	'name'			=> 'Mini Menu',
	'link_to'		=> '',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'none.gif',
	'view_by'		=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '1',
);
$k_menus_array[] = array(
	'm_id'			=> '20',
	'ndx'			=> '2',
	'menu_type'		=> '2',
	'name'			=> 'Main Site Link',
	'link_to'		=> 'http://www.phpbbireland.com/forum/portal.php',
	'append_sid'	=> '1',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_phpireland_globe.gif',
	'view_by'		=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'm_id'			=> '21',
	'ndx'			=> '3',
	'menu_type'		=> '2',
	'name'			=> 'Old Web Pages',
	'link_to'		=> '',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'none.gif',
	'view_by'		=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '1',
);
$k_menus_array[] = array(
	'm_id'			=> '22',
	'ndx'			=> '4',
	'menu_type'		=> '2',
	'name'			=> 'About',
	'link_to'		=> 'web_page.php?mode=about',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_bulb2.png',
	'view_by'		=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'm_id'			=> '23',
	'ndx'			=> '5',
	'menu_type'		=> '2',
	'name'			=> 'Web Pages',
	'link_to'		=> 'web_page.php?mode=welcome',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_ff.png',
	'view_by'		=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'm_id'			=> '24',
	'ndx'			=> '6',
	'menu_type'		=> '2',
	'name'			=> 'Module Help',
	'link_to'		=> 'web_page.php?mode=modules',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_search.png',
	'view_by'		=> '0',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'm_id'			=> '25',
	'ndx'			=> '7',
	'menu_type'		=> '2',
	'name'			=> 'Web Pages',
	'link_to'		=> '',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'none.gif',
	'view_by'		=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '1',
);
$k_menus_array[] = array(
	'm_id'			=> '26',
	'ndx'			=> '8',
	'menu_type'		=> '2',
	'name'			=> 'About',
	'link_to'		=> 'web_page.php?mode=about',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_links.png',
	'view_by'		=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'm_id'			=> '27',
	'ndx'			=> '1',
	'menu_type'		=> '3',
	'name'			=> 'Test Header Item',
	'link_to'		=> '',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_umberela.png',
	'view_by'		=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'm_id'			=> '28',
	'ndx'			=> '9',
	'menu_type'		=> '2',
	'name'			=> 'Portal (wrapper)',
	'link_to'		=> 'portal_page.php?portal_page=5',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_umberela.png',
	'view_by'		=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'm_id'			=> '29',
	'ndx'			=> '10',
	'menu_type'		=> '2',
	'name'			=> 'WebPage (youtube)',
	'link_to'		=> 'web_page_utube.php?mode=youtube',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_music_note.png',
	'view_by'		=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);


$k_modules_table = 'phpbb_k_modules';
$k_modules_array = array();
$k_modules_array[] = array(
	'mod_id'			=> '1',
	'mod_link_id'		=> '0',
	'mod_type'			=> 'welcome',
	'mod_origin'		=> '1',
	'mod_name'			=> 'Welcome',
	'mod_author'		=> 'Stargate Development Team',
	'mod_link'			=> 'http://www.phpbbireland.com',
	'mod_author_co'		=> 'Michaelo',
	'mod_support_link'	=> 'http://www.phpbbireland.com',
	'mod_copyright'		=> '&copy; phpbbireland.com 2005-2009',
	'mod_thumb'			=> 'logo_portal_red.png',
	'mod_last_update'	=> 'Mon 25 Aug 2008',
	'mod_details'		=> 'Welcome back [you]...&lt;br /&gt;&lt;br /&gt;&lt;strong&gt;phpbbireland.com &lt;/strong&gt; is powered by &lt;strong&gt;phpBB&lt;/strong&gt; ($phpbb_version)  and &lt;strong&gt; Stargate Portal &lt;/strong&gt;($portal_version).',
	'mod_download_count'	=> '0',
	'mod_status'			=> '100',
	'mod_version'			=> '1.0.0',
);
$k_modules_array[] = array(
	'mod_id'			=> '2',
	'mod_link_id'		=> '0',
	'mod_type'			=> 'style',
	'mod_origin'		=> '1',
	'mod_name'			=> 'prosilver',
	'mod_author'		=> 'phpBB',
	'mod_link'			=> 'http://www.phpbb.com',
	'mod_author_co'		=> 'Michaelo',
	'mod_support_link'	=> 'http://www.phpbbireland.com',
	'mod_copyright'		=> '&copy; phpBB 2005',
	'mod_thumb'			=> '',
	'mod_last_update'	=> 'Mon 25 Aug 2008',
	'mod_details'		=> 'Default prosilver style',
	'mod_download_count'	=> '0',
	'mod_status'			=> '100',
	'mod_version'			=> '3.0.4',
);
$k_modules_array[] = array(
	'mod_id'			=> '3',
	'mod_link_id'		=> '0',
	'mod_type'			=> 'style',
	'mod_origin'		=> '1',
	'mod_name'			=> 'subsilver2',
	'mod_author'		=> 'phpBB',
	'mod_link'			=> 'http://www.phpbb.com',
	'mod_author_co'		=> 'Michaelo',
	'mod_support_link'	=> 'http://www.phpbbireland.com',
	'mod_copyright'		=> '&copy; phpBB 2005',
	'mod_thumb'			=> '',
	'mod_last_update'	=> 'Mon 25 Aug 2008',
	'mod_details'		=> 'Default subsilver style',
	'mod_download_count'	=> '0',
	'mod_status'			=> '100',
	'mod_version'			=> '3.0.4',
);

$k_modules_array[] = array(
	'mod_id'			=> '4',
	'mod_link_id'		=> '0',
	'mod_type'			=> 'block',
	'mod_origin'		=> '1',
	'mod_name'			=> 'Demo Block',
	'mod_author'		=> 'Michaelo',
	'mod_link'			=> 'http://www.phpbbireland.com',
	'mod_author_co'		=> 'None',
	'mod_support_link'	=> 'http://www.phpbbireland.com',
	'mod_copyright'		=> '&copy; phpbbireland',
	'mod_thumb'			=> '',
	'mod_last_update'	=> 'Mon 25 Aug 2008',
	'mod_details'		=> 'Demo Block only',
	'mod_download_count'	=> '0',
	'mod_status'			=> '50',
	'mod_version'			=> '1.0.0',
);
$k_modules_array[] = array(
	'mod_id'			=> '5',
	'mod_link_id'		=> '0',
	'mod_type'			=> 'portal_status',
	'mod_origin'		=>'1',
	'mod_name'			=> 'Stargate Portal',
	'mod_author'		=> 'Michaelo',
	'mod_link'			=> 'http://www.phpbbireland.com',
	'mod_author_co'		=> 'phpbbireland dev team',
	'mod_support_link'	=> '',
	'mod_copyright'		=> '&copy; Michael O\'Toole 2005-2009',
	'mod_thumb'			=> '',
	'mod_last_update'	=> 'Mon 25 Aug 2008',
	'mod_details'		=> 'Stargate Portal (the original phpBB3 portal), is a fully integrated portal system for your phpBB3 board.',
	'mod_download_count'	=> '0',
	'mod_status'			=> '50',
	'mod_version'			=> '1.0.0',
);

$k_newsfeeds_table = 'phpbb_k_newsfeeds';
$k_newsfeeds_array = array();
$k_newsfeeds_array[] = array(
	'feed_id'			=> '1',
	'feed_title'		=> 'phpBB.com',
	'feed_show'			=> '1',
	'feed_url'			=> 'http://www.phpbb.com/feeds/rss/',
	'feed_position'		=> '1',
	'feed_description'	=> '1'
);

$k_referrals_table = 'phpbb_k_referrals';
$k_refereals_array = array();
$k_referrals_array[] = array(
	'id'			=> '1',
	'host'			=> 'phpbbireland.com',
	'hits'			=> '1',
	'firstvisit'	=> '1220665580',
	'lastvisit'		=> '1220665604',
	'enabled'		=> '1'
);

$k_web_pages_table = 'phpbb_k_web_pages';
$k_web_pages_array = array();
$k_web_pages_array[] = array(
	'id'			=> '1',
	'active'		=> '1',
	'page_name'		=> 'about',
	'page_type'		=> 'B',
	'last_updated'	=> 'Mon 25 Aug 2008',
	'body'			=> '&lt;body id=&quot;phpBB&quot; class=&quot;about ltr&quot;&gt;&lt;div class=&quot;outside&quot;&gt;&lt;div class=&quot;top-left&quot;&gt;&lt;/div&gt;&lt;div class=&quot;top-center&quot;&gt;&lt;/div&gt;&lt;div class=&quot;top-right&quot;&gt;&lt;/div&gt;&lt;div class=&quot;inside&quot;&gt;&lt;div id=&quot;wrap&quot;&gt;&lt;div class=&quot;header&quot;&gt;&lt;h1&gt;&lt;a href=&quot;/&quot;&gt;phpBB &amp;bull; Creating Communities Worldwide&lt;/a&gt;&lt;/h1&gt;&lt;/div&gt;&lt;a name=&quot;start_here&quot;&gt;&lt;/a&gt;&lt;div id=&quot;page-body&quot; style=&quot;padding-top:5px;&quot;&gt;&lt;ul class=&quot;linklist navlinks&quot;&gt;&lt;li&gt;&lt;a href=&quot;portal.php&quot;&gt;Home&lt;/a&gt;&lt;strong&gt;&amp;#8249;&lt;/strong&gt; &lt;a href=&quot;web_page.php?mode=about&quot;&gt;About&lt;/a&gt;&lt;/li&gt;&lt;/ul&gt;&lt;div id=&quot;main&quot;&gt;&lt;h2 class=&quot;imgrep about&quot;&gt;About Portal Web Pages&lt;/h2&gt;&lt;p&gt;&lt;strong&gt;Portal Web Pages&lt;/strong&gt; allow you to add additional pages to your site. These page consist of standard HTML code, so you can design a page in your favourite WYSIWYG editor and simply copy the contents into a new web page...&lt;/p&gt;&lt;p&gt;For convenience we divided pages into headers, bodies and footers, this allows reuse of headers and footers are these are often common to other pages...&lt;/p&gt;&lt;p&gt;This page serves as an example...&lt;/p&gt;&lt;p&gt;&lt;/p&gt;&lt;/div&gt;&lt;div id=&quot;extras&quot;&gt;&lt;div class=&quot;mini-panel sections&quot;&gt;&lt;div class=&quot;inner&quot;&gt;&lt;span class=&quot;corners-top&quot;&gt;&lt;span&gt;&lt;/span&gt;&lt;/span&gt;&lt;h3&gt;&lt;a href=&quot;web?mode=about&quot;&gt;About section&lt;/a&gt;&lt;/h3&gt;&lt;ul class=&quot;menu&quot;&gt;&lt;li&gt;&lt;a href=&quot;web_page.php?mode=welcome&quot;&gt;Welcome&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;a href=&quot;web_page.php?mode=download&quot;&gt;Download&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;a href=&quot;web_page.php?mode=features&quot;&gt;The features&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;a href=&quot;web_page.php?mode=history&quot;&gt;The history&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;a href=&quot;web_page.php?mode=team&quot;&gt;The team&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;a href=&quot;http://www.phpbbireland.com/phpBB3/portal.php&quot;&gt;The Demo Site&lt;/a&gt;&lt;/li&gt;&lt;li class=&quot;last&quot;&gt;&lt;a href=&quot;http://www.phpbbireland.com/portal/portal.php&quot;&gt;The Development Site&lt;/a&gt;&lt;/li&gt;&lt;/ul&gt;&lt;span class=&quot;corners-bottom&quot;&gt;&lt;span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;',
	'head'			=> '3',
	'foot'			=> '4',
	'external_file'	=> '',
);
$k_web_pages_array[] = array(
	'id'			=> '2',
	'active'		=> '1',
	'page_name'		=> 'welcome',
	'page_type'		=> 'B',
	'last_updated'	=> 'Mon 25 Aug 2008',
	'body'			=> '&lt;body id=&quot;phpBB&quot; class=&quot;welcome ltr&quot; &gt;&lt;div class=&quot;outside&quot;&gt;&lt;div class=&quot;top-left&quot;&gt;&lt;/div&gt;&lt;div class=&quot;top-center&quot;&gt;&lt;/div&gt;&lt;div class=&quot;top-right&quot;&gt;&lt;/div&gt;&lt;div class=&quot;inside&quot;&gt;&lt;div id=&quot;wrap&quot;&gt;&lt;div class=&quot;header&quot;&gt;&lt;h1&gt;&lt;a href=&quot;/&quot;&gt;phpBB ??? Creating Communities Worldwide&lt;/a&gt;&lt;/h1&gt;&lt;/div&gt;&lt;a name=&quot;start_here&quot;&gt;&lt;/a&gt;&lt;div id=&quot;page-body&quot; style=&quot;padding-top:5px;&quot;&gt;&lt;ul class=&quot;linklist navlinks&quot;&gt;&lt;li&gt;&lt;a href=&quot;portal.php&quot;&gt;Home&lt;/a&gt;&lt;strong&gt;&amp;#8249;&lt;/strong&gt; &lt;a href=&quot;web_page.php?mode=welcome&quot;&gt;Welcome&lt;/a&gt;&lt;/li&gt;&lt;/ul&gt;&lt;div id=&quot;main&quot;&gt;&lt;h2 class=&quot;imgrep about&quot;&gt;About IntergaMod&lt;/h2&gt;&lt;p&gt;&lt;strong&gt;IntegraMod Portal&lt;/strong&gt; is the same as the Stargate but with all the mods included... The aim was to build a replacement for the IM Portal for the next generation of IntegraMOD...&lt;/p&gt;&lt;p&gt;In the beginning there were many who questioned the logic of developing a portal for what was a pre-beta product, nevertheless I was not put off as for me it was a learning experience and I needed to learn... Over time the code has changed primarily to keep pace with phpBB update but quite a bit of the original code is still present...&lt;/p&gt;&lt;p&gt;The portal is fully configurable in the ACP, I have includes many of the more useful blocks as well as one or two nice mods... For a full list of features see the &lt;a href=&quot;web_page.php?mode=features&quot;&gt;features...&lt;/a&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;&lt;/div&gt;&lt;div id=&quot;extras&quot;&gt;&lt;div class=&quot;mini-panel sections&quot;&gt;&lt;div class=&quot;inner&quot;&gt;&lt;span class=&quot;corners-top&quot;&gt;&lt;span&gt;&lt;/span&gt;&lt;/span&gt;&lt;h3&gt;&lt;a href=&quot;web_page.php?mode=about&quot;&gt;Welcome section&lt;/a&gt;&lt;/h3&gt;&lt;ul class=&quot;menu&quot;&gt;&lt;li&gt;&lt;a href=&quot;web_page.php?mode=about&quot;&gt;About&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;a href=&quot;web_page.php?mode=download&quot;&gt;Download&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;a href=&quot;web_page.php?mode=features&quot;&gt;The features&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;a href=&quot;web_page.php?mode=history&quot;&gt;The history&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;a href=&quot;web_page.php?mode=team&quot;&gt;The team&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;a href=&quot;http://www.phpbbireland.com/phpBB3/portal.php&quot;&gt;The Demo Site&lt;/a&gt;&lt;/li&gt;&lt;li class=&quot;last&quot;&gt;&lt;a href=&quot;http://www.phpbbireland.com/portal.php&quot;&gt;The Maint Site&lt;/a&gt;&lt;/li&gt;&lt;/ul&gt;&lt;span class=&quot;corners-bottom&quot;&gt;&lt;span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;',
	'head'			=> '3',
	'foot'			=> '4',
	'external_file'	=> '',
);
$k_web_pages_array[] = array(
	'id'			=> '3',
	'active'		=> '1',
	'page_name'		=> 'test',
	'page_type'		=> 'H',
	'last_updated'	=> 'Mon 25 Aug 2008',
	'body'			=> '&lt;!DOCTYPE html PUBLIC &quot;-//W3C//DTD XHTML 1.0 Strict//EN&quot; &quot;http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd&quot;&gt;&lt;html xmlns=&quot;http://www.w3.org/1999/xhtml&quot; dir=&quot;ltr&quot; lang=&quot;en-gb&quot; xml:lang=&quot;en-gb&quot;&gt;&lt;head&gt;&lt;meta http-equiv=&quot;content-type&quot; content=&quot;text/html; charset=UTF-8&quot; /&gt;&lt;meta http-equiv=&quot;content-style-type&quot; content=&quot;text/css&quot; /&gt;&lt;meta http-equiv=&quot;content-language&quot; content=&quot;en-gb&quot; /&gt;&lt;meta http-equiv=&quot;imagetoolbar&quot; content=&quot;no&quot; /&gt;&lt;meta name=&quot;resource-type&quot; content=&quot;document&quot; /&gt;&lt;meta name=&quot;distribution&quot; content=&quot;global&quot; /&gt;&lt;meta name=&quot;copyright&quot; content=&quot;2002-2006 phpBB Group&quot; /&gt;&lt;meta name=&quot;keywords&quot; content=&quot;&quot; /&gt;&lt;meta name=&quot;description&quot; content=&quot;&quot; /&gt;&lt;title&gt;phpbbireland.com &amp;bull; Portal&lt;/title&gt;&lt;link rel=&quot;shortcut icon&quot; href=&quot;http:www.phpbbireland/favicon.ico&quot; /&gt;&lt;link rel=&quot;icon&quot; href=&quot;favicon.ico&quot; type=&quot;image/x-icon&quot; /&gt;&lt;link href=&quot;./styles/web/theme/common.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/web/theme/links.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/web/theme/content.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/web/theme/buttons.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/web/theme/cp.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/web/theme/forms.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/web/theme/tweaks.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/web/theme/colours.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/web/theme/website.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/web/theme/headers.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/web/theme/titles.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/web/theme/navigation.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/web/theme/documentation.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/web/theme/silver.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/web/theme/portal_adds.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;/head&gt;',
	'head'			=> '0',
	'foot'			=> '0',
	'external_file'	=> '',
);
$k_web_pages_array[] = array(
	'id'			=> '4',
	'active'		=> '1',
	'page_name'		=> 'test',
	'page_type'		=> 'F',
	'last_updated'	=> 'Mon 25 Aug 2008',
	'body'			=> '&lt;div id=&quot;page-footer&quot;&gt;&lt;div class=&quot;copyright&quot;&gt;Powered by &lt;a href=&quot;http://www.phpbb.com/&quot;&gt;phpBB&lt;/a&gt;  &amp;copy; 2000, 2002, 2005, 2007 phpBB Group&lt;/div&gt;&lt;div&gt;&lt;a id=&quot;bottom&quot; name=&quot;bottom&quot; accesskey=&quot;z&quot;&gt;&lt;/a&gt;&lt;div class=&quot;bottom-left&quot;&gt;&lt;/div&gt;&lt;div class=&quot;bottom-center&quot;&gt;&lt;/div&gt;&lt;div class=&quot;bottom-right&quot;&gt;&lt;/div&gt;&lt;/body&gt;&lt;/html&gt;',
	'head'			=> '0',
	'foot'			=> '0',
	'external_file'	=> '',
);
$k_web_pages_array[] = array(
	'id'			=> '5',
	'active'		=> '1',
	'page_name'		=> 'Wrapper',
	'page_type'		=> 'P',
	'last_updated'	=> 'Sat 18 Jul 2009',
	'body'			=> '&lt;div id=&quot;main&quot;&gt;&lt;object width=&quot;425&quot; height=&quot;344&quot;&gt;&lt;param name=&quot;movie&quot; value=&quot;http://www.youtube.com/v/AhR04kmcSXU&amp;hl=en&amp;fs=1&quot;&gt;&lt;/param&gt;&lt;param name=&quot;allowFullScreen&quot; value=&quot;true&quot;&gt;&lt;/param&gt;&lt;param name=&quot;allowscriptaccess&quot; value=&quot;always&quot;&gt;&lt;/param&gt;&lt;embed src=&quot;http://www.youtube.com/v/AhR04kmcSXU&amp;hl=en&amp;fs=1&quot; type=&quot;application/x-shockwave-flash&quot; allowscriptaccess=&quot;always&quot; allowfullscreen=&quot;true&quot; width=&quot;425&quot; height=&quot;344&quot;&gt;&lt;/embed&gt;&lt;/object&gt;&lt;div&gt;',
	'head'			=> '0',
	'foot'			=> '0',
	'external_file'	=> '',
);
$k_web_pages_array[] = array(
	'id'			=> '6',
	'active'		=> '1',
	'page_name'		=> 'youtube',
	'page_type'		=> 'B',
	'last_updated'	=> 'Sat 18 Jul 2009',
	'body'			=> '',
	'head'			=> '3',
	'foot'			=> '4',
	'external_file'	=> '',
);

$k_youtube_table = 'phpbb_k_youtube';
$k_youtube_array[] = array(
	'video_id'				=> '1',
	'video_category'	=> 'Gregorian',
	'video_who'			=> 'Gregorian',
	'video_link'		=> 'TP71E7QLy9A',
	'video_title'		=> 'Moment Of Peace',
	'video_rating'		=> '5',
	'video_comment'		=> '',
	'video_poster_id'	=> '2',

);

// Finished tables and data ... A schema file is so much easier ;)
?>