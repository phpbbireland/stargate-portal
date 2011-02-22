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
	'acronym'		=> 'SGP',
	'meaning'		=> 'An advanced portal for phpBB3, © phpbbireland.com 2005-2011',
	'lang'			=> 'en',
);
$k_acronyms_array[] = array(
	'acronym'		=> 'IntegraMod',
	'meaning'		=> 'The best fully integrated phpBB pre-mod version ever.',
	'lang'			=> 'en',
);
$k_acronyms_array[] = array(
	'acronym'		=> 'IM3',
	'meaning'		=> 'A fully integrated phpBB3 forum, incorporating IntegraMod, Stargate Portal and hundreds of mods..',
	'lang'			=> 'en',
);
$k_acronyms_array[] = array(
	'acronym'		=> 'phpBB',
	'meaning'		=> 'The best forum software ever...',
	'lang'			=> 'en',
);
$k_acronyms_array[] = array(
	'acronym'		=> 'Stargate Portal',
	'meaning'		=> 'The original portal for phpBB3 by the SGP development team',
	'lang'			=> 'en',
);
$k_acronyms_array[] = array(
	'acronym'		=> 'OOP',
	'meaning'		=> 'Object Orientated Programming',
	'lang'			=> 'en',
);

$k_blocks_table = 'phpbb_k_blocks';
$k_blocks_array = array();
$k_blocks_array[] = array(
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
	'view_pages'	=> '1,2,3,4,5,6,7,8,9,11,12,13,14',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '999',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '1,2,3,4,5,6,7,8,9,11,12,13,14',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '999',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '1,2',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '999',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '1,2,3,4,5,6,7,8,9',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '999',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '2,3,4,5,6,7,8,9',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '300',
);
$k_blocks_array[] = array(
	'ndx'			=> '6',
	'title'			=> 'Recent Topics',
	'position'		=> 'L',
	'type'			=> 'H',
	'active'		=> '0',
	'html_file_name'=> 'block_recent_topics.html',
	'var_file_name'	=> 'k_recent_topics_vars.html',
	'img_file_name'	=> 'message.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'view_pages'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '1',
	'block_height'	=> '200',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '30',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '2,3,4,5,6,7,8,9',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '600',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '2,3,4,5,6,7,12',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '999',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '999',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '2',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '667',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '2',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '999',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '2',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '1',
	'mod_block_id'	=> '1',
	'is_static'		=> '0',
	'block_cache_time'	=> '600',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '2',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '300',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '1,2',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '200',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '20',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '2',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '50',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '999',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '302',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '2,5,6,7,8,9,11,12,13,14',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '999',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '2',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '668',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '2,5,6,7,8,9',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '555',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '2,5,6,7,8',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '200',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '2,5,6,7,8',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '345',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '2',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '100',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '999',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '2,12,13,14',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '9999',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '2',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '9999',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '2,5,6,7,8,12',
	'groups'		=> '0',
	'scroll'		=> '1',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '668',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '2',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '9999',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '300',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '2,3,4,5,6,7,8,9',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '400',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '2',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '800',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '2',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '1',
	'mod_block_id'	=> '5',
	'is_static'		=> '0',
	'block_cache_time'	=> '550',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '680',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '9999',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '2',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '1',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '345',
);
$k_blocks_array[] = array(
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
	'view_pages'	=> '0',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '0',
	'mod_block_id'	=> '0',
	'is_static'		=> '0',
	'block_cache_time'	=> '255',
);

$k_blocks_array[] = array(
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
	'view_pages'	=> '2',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '1',
	'mod_block_id'	=> '4',
	'is_static'		=> '0',
	'block_cache_time'	=> '700',
);

$k_blocks_array[] = array(
	'ndx'			=> '19',
	'title'			=> 'Small Add',
	'position'		=> 'R',
	'type'			=> 'H',
	'active'		=> '1',
	'html_file_name'=> 'block_small_adds.html',
	'var_file_name'	=> '',
	'img_file_name'	=> 'umberela.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '0',
	'view_pages'	=> '2,5,6,7,8,9,11,12,13,14',
	'groups'		=> '0',
	'scroll'		=> '0',
	'block_height'	=> '0',
	'has_vars'		=> '0',
	'minimod_based'	=> '1',
	'mod_block_id'	=> '6',
	'is_static'		=> '0',
	'block_cache_time'	=> '650',
);


$k_blocks_config_table = 'phpbb_k_blocks_config';
$k_blocks_config_array = array();
$k_blocks_config_array[] = array(
	'id'					=> '1',
	'use_external_files'	=> '0',
	'update_files'			=> '0',
	'layout_default'		=> '2',
	'portal_config'			=> 'Site',
);

$k_blocks_config_vars_table = 'phpbb_k_blocks_config_vars';
$k_blocks_config_vars_array = array();
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'allow_acronyms',
	'config_value'	=> '0',
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
	'config_name'	=> 'poll_post_id', '0',
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
	'config_name'	=> 'sgp_quick_reply',
	'config_value'	=> '1',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'recent_topics_search_exclude',
	'config_value'	=> '',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'days_top_topics',
	'config_value'	=> '7',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'sgp_cache_time',
	'config_value'	=> '300',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'block_cache_time_default',
	'config_value'	=> '600',
	'is_dynamic'	=> '0',
);


$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'portal_build',
	'config_value'	=> '308-023',
	'is_dynamic'	=> '0',
);

$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'k_youtube_link',
	'config_value'	=> 'http://www.youtube.com/v/',
	'is_dynamic'	=> '0',
);
$k_blocks_config_vars_array[] = array(
	'config_name'	=> 'rss_feeds_enabled',
	'config_value'	=> '1',
	'is_dynamic'	=> '0',
);


$k_cloud_table = 'phpbb_k_cloud';
$k_cloud_array = array();
$k_cloud_array[] = array(
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
	'quote'		=> 'Anyone who lives within their means suffers from a lack of imagination.',
	'author'	=> 'Oscar Wilde',
);
$k_quotes_array[] = array(
	'quote'		=> 'I was working on the proof of one of my poems all the morning, and took out a comma. In the afternoon I put it back again.',
	'author'	=> 'Oscar Wilde',
);


$k_menus_table = 'phpbb_k_menus';
$k_menus_array = array();
$k_menus_array[] = array(
	'ndx'			=> '1',
	'menu_type'		=> '1',
	'name'			=> 'Main Menu',
	'link_to'		=> 'portal.php',
	'extern'		=> '0',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'none.gif',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '1',
);
$k_menus_array[] = array(
	'ndx'			=> '2',
	'menu_type'		=> '1',
	'name'			=> 'Portal',
	'link_to'		=> 'portal.php',
	'extern'		=> '0',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_home.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'ndx'			=> '3',
	'menu_type'		=> '1',
	'name'			=> 'Forum',
	'link_to'		=> 'index.php',
	'extern'		=> '0',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_home2.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'ndx'			=> '4',
	'menu_type'		=> '1',
	'name'			=> 'Navigator',
	'link_to'		=> '',
	'extern'		=> '0',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'none.gif',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '1',
);
$k_menus_array[] = array(
	'ndx'			=> '5',
	'menu_type'		=> '1',
	'name'			=> 'Album',
	'link_to'		=> 'inprogress.php',
	'extern'		=> '0',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_edit_img.png',
	'view_by'		=> '0',
	'view_all'		=> '1',
	'view_groups'	=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'ndx'			=> '6',
	'menu_type'		=> '1',
	'name'			=> 'Bookmarks',
	'link_to'		=> 'ucp.php?i=main&amp;mode=bookmarks',
	'extern'		=> '0',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_bookmark.png',
	'view_by'		=> '2',
	'view_all'		=> '1',
	'view_groups'	=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'ndx'			=> '7',
	'menu_type'		=> '1',
	'name'			=> 'Downloads',
	'link_to'		=> 'inprogress.php',
	'extern'		=> '0',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_ff.png',
	'view_by'		=> '0',
	'view_all'		=> '1',
	'view_groups'	=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'ndx'			=> '8',
	'menu_type'		=> '1',
	'name'			=> 'Links',
	'link_to'		=> 'inprogress.php',
	'extern'		=> '0',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_link.gif',
	'view_by'		=> '0',
	'view_all'		=> '1',
	'view_groups'	=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'ndx'			=> '9',
	'menu_type'		=> '1',
	'name'			=> 'Members',
	'link_to'		=> 'memberlist.php',
	'extern'		=> '0',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_chat.png',
	'view_by'		=> '2',
	'view_all'		=> '1',
	'view_groups'	=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'ndx'			=> '10',
	'menu_type'		=> '1',
	'name'			=> 'Ratings',
	'link_to'		=> 'index.php',
	'extern'		=> '0',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_rating.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'ndx'			=> '11',
	'menu_type'		=> '1',
	'name'			=> 'Rules',
	'link_to'		=> 'basic_rules.php',
	'extern'		=> '0',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_terms_of_use.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'ndx'			=> '12',
	'menu_type'		=> '1',
	'name'			=> 'Staff',
	'link_to'		=> 'memberlist.php?mode=leaders',
	'extern'		=> '0',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_staff.png',
	'view_by'		=> '2',
	'view_all'		=> '1',
	'view_groups'	=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'ndx'			=> '13',
	'menu_type'		=> '1',
	'name'			=> 'Statistics',
	'link_to'		=> 'inprogress.php',
	'extern'		=> '0',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_pie.png',
	'view_by'		=> '0',
	'view_all'		=> '1',
	'view_groups'	=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'ndx'			=> '14',
	'menu_type'		=> '1',
	'name'			=> 'UCP',
	'link_to'		=> 'ucp.php',
	'extern'		=> '0',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_links.gif',
	'view_by'		=> '2',
	'view_all'		=> '1',
	'view_groups'	=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'ndx'			=> '15',
	'menu_type'		=> '1',
	'name'			=> 'Chat',
	'link_to'		=> 'chat/index.php',
	'extern'		=> '0',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_chat.png',
	'view_by'		=> '0',
	'view_all'		=> '1',
	'view_groups'	=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'ndx'			=> '16',
	'menu_type'		=> '1',
	'name'			=> 'Admin Menu',
	'link_to'		=> '',
	'extern'		=> '0',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'none.gif',
	'view_by'		=> '5',
	'view_all'		=> '1',
	'view_groups'	=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '1',
);
$k_menus_array[] = array(
	'ndx'			=> '17',
	'menu_type'		=> '1',
	'name'			=> 'ACP',
	'link_to'		=> 'adm/index.php',
	'extern'		=> '0',
	'append_sid'	=> '1',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_work.png',
	'view_by'		=> '5',
	'view_all'		=> '1',
	'view_groups'	=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'ndx'			=> '18',
	'menu_type'		=> '1',
	'name'			=> 'REFRESH_ALL',
	'link_to'		=> 'sgp_refresh.php',
	'extern'		=> '0',
	'append_sid'	=> '1',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_bin.png',
	'view_by'		=> '5',
	'view_all'		=> '1',
	'view_groups'	=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'ndx'			=> '1',
	'menu_type'		=> '2',
	'name'			=> 'Mini Menu',
	'link_to'		=> '',
	'extern'		=> '0',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'none.gif',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '1',
);
$k_menus_array[] = array(
	'ndx'			=> '2',
	'menu_type'		=> '2',
	'name'			=> 'Main Site Link',
	'link_to'		=> 'http://www.phpbbireland.com/forum/portal.php',
	'extern'		=> '0',
	'append_sid'	=> '1',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_phpireland_globe.gif',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'ndx'			=> '3',
	'menu_type'		=> '2',
	'name'			=> 'Web Pages',
	'link_to'		=> '',
	'extern'		=> '0',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'none.gif',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '1',
);
$k_menus_array[] = array(
	'ndx'			=> '4',
	'menu_type'		=> '2',
	'name'			=> 'About',
	'link_to'		=> 'web_page.php?mode=about',
	'extern'		=> '0',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_links.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'ndx'			=> '5',
	'menu_type'		=> '2',
	'name'			=> 'Welcome',
	'link_to'		=> 'web_page.php?mode=welcome',
	'extern'		=> '0',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_ff.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'ndx'			=> '6',
	'menu_type'		=> '2',
	'name'			=> 'Portal (wrapper)',
	'link_to'		=> 'portal_page.php?portal_page=5',
	'extern'		=> '0',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_umberela.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);
$k_menus_array[] = array(
	'ndx'			=> '7',
	'menu_type'		=> '2',
	'name'			=> 'WebPage (youtube)',
	'link_to'		=> 'web_page_utube.php?mode=youtube',
	'extern'		=> '0',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_music_note.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);

$k_menus_array[] = array(
	'ndx'			=> '1',
	'menu_type'		=> '3',
	'name'			=> 'Test Header Item',
	'link_to'		=> '',
	'extern'		=> '0',
	'append_sid'	=> '0',
	'append_uid'	=> '0',
	'menu_icon'		=> 'menu_umberela.png',
	'view_by'		=> '1',
	'view_all'		=> '1',
	'view_groups'	=> '1',
	'soft_hr'		=> '0',
	'sub_heading'	=> '0',
);

$k_modules_table = 'phpbb_k_modules';
$k_modules_array = array();
$k_modules_array[] = array(
	'mod_link_id'		=> '0',
	'mod_type'			=> 'welcome',
	'mod_origin'		=> '1',
	'mod_name'			=> 'Welcome',
	'mod_filename'		=> 'welcome',
	'mod_author'		=> 'Stargate Development Team',
	'mod_link'			=> 'http://www.phpbbireland.com',
	'mod_author_co'		=> 'Michaelo',
	'mod_support_link'	=> 'http://www.phpbbireland.com',
	'mod_copyright'		=> '&copy; phpbbireland.com 2005-2010',
	'mod_thumb'			=> 'logo_portal_red.png',
	'mod_last_update'	=> 'Mon 25 Aug 2008',
	'mod_details'		=> 'Welcome back [you]...&lt;br /&gt;&lt;br /&gt;&lt;strong&gt;phpbbireland.com &lt;/strong&gt; is powered by &lt;strong&gt;phpBB&lt;/strong&gt; {VERSION} and &lt;strong&gt; Stargate Portal &lt;/strong&gt;{PORTAL_VERSION}.',
	'mod_download_count'	=> '0',
	'mod_status'			=> '100',
	'mod_version'			=> '1.0.0',
	'mod_bbcode_uid'		=> '',
	'mod_bbcode_bitfield'	=> '',
	'mod_bbcode_options'	=> '0',
);
$k_modules_array[] = array(
	'mod_link_id'		=> '0',
	'mod_type'			=> 'style',
	'mod_origin'		=> '1',
	'mod_name'			=> 'prosilver',
	'mod_filename'		=> 'prosilver',
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
	'mod_version'			=> '3.0.7',
	'mod_bbcode_uid'		=> '',
	'mod_bbcode_bitfield'	=> '',
	'mod_bbcode_options'	=> '0',
);
$k_modules_array[] = array(
	'mod_link_id'		=> '0',
	'mod_type'			=> 'style',
	'mod_origin'		=> '1',
	'mod_name'			=> 'subsilver2',
	'mod_filename'		=> 'subsilver2',
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
	'mod_version'			=> '3.0.7',
	'mod_bbcode_uid'		=> '',
	'mod_bbcode_bitfield'	=> '',
	'mod_bbcode_options'	=> '0',
);

$k_modules_array[] = array(
	'mod_link_id'		=> '0',
	'mod_type'			=> 'block',
	'mod_origin'		=> '1',
	'mod_name'			=> 'Demo Block',
	'mod_filename'		=> 'demo_block',
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
	'mod_bbcode_uid'		=> '',
	'mod_bbcode_bitfield'	=> '',
	'mod_bbcode_options'	=> '0',
);
$k_modules_array[] = array(
	'mod_link_id'		=> '0',
	'mod_type'			=> 'portal_status',
	'mod_origin'		=> '1',
	'mod_name'			=> 'Stargate Portal',
	'mod_filename'		=> 'portal_status',
	'mod_author'		=> 'Michaelo',
	'mod_link'			=> 'http://www.phpbbireland.com',
	'mod_author_co'		=> 'phpbbireland dev team',
	'mod_support_link'	=> '',
	'mod_copyright'		=> '&copy; Michael O\'Toole 2005-2010',
	'mod_thumb'			=> '',
	'mod_last_update'	=> 'Mon 25 Aug 2008',
	'mod_details'		=> 'Stargate Portal (the original phpBB3 portal), is a fully integrated portal system for your phpBB3 board.',
	'mod_download_count'	=> '0',
	'mod_status'			=> '50',
	'mod_version'			=> '1.0.0',
	'mod_bbcode_uid'		=> '',
	'mod_bbcode_bitfield'	=> '',
	'mod_bbcode_options'	=> '0',
);
$k_modules_array[] = array(
	'mod_link_id'		=> '0',
	'mod_type'			=> 'small_add',
	'mod_origin'		=> '1',
	'mod_name'			=> 'Small Add',
	'mod_filename'		=> '',
	'mod_author'		=> 'Michaelo',
	'mod_link'			=> 'http://www.phpbbireland.com',
	'mod_author_co'		=> 'phpbbireland dev team',
	'mod_support_link'	=> '',
	'mod_copyright'		=> '&copy; Michael O\'Toole 2005-2010',
	'mod_thumb'			=> '',
	'mod_last_update'	=> 'Mon 25 Aug 2008',
	'mod_details'		=> '&lt;div style=&quot;text-align:center&quot;&gt;&lt;strong&gt;This is a MiniMod!&lt;/strong&gt;&lt;br /&gt;&lt;a href=&quot;http://www.stargate-portal.com&quot; class=&quot;postlink&quot;&gt;&lt;img src=&quot;http://www.stargate-portal.com/forum/images/adds1.png&quot;&gt;&lt;/a&gt;&lt;br /&gt;&lt;br /&gt;Created with the portalâ€™s built in MiniMod tool... No database changes required... No php code required...&lt;/div&gt; &lt;div style=&quot;text-align:center&quot;&gt; <!-- s:mrgreen: --><img src="{SMILIES_PATH}/icon_mrgreen.gif" alt=":mrgreen:" title="Mr. Green" /><!-- s:mrgreen: --> &lt;/div&gt;',
	'mod_download_count'	=> '0',
	'mod_status'			=> '99',
	'mod_version'			=> '1.0.0',
	'mod_bbcode_uid'		=> '',
	'mod_bbcode_bitfield'	=> '',
	'mod_bbcode_options'	=> '7',
);

$k_newsfeeds_table = 'phpbb_k_newsfeeds';
$k_newsfeeds_array = array();
$k_newsfeeds_array[] = array(
	'feed_title'		=> 'phpBB.com',
	'feed_show'			=> '1',
	'feed_url'			=> 'http://www.phpbb.com/feeds/rss/',
	'feed_position'		=> '1',
	'feed_description'	=> '1'
);

$k_referrals_table = 'phpbb_k_referrals';
$k_refereals_array = array();
$k_referrals_array[] = array(
	'host'			=> 'phpbbireland.com',
	'hits'			=> '1',
	'firstvisit'	=> '1220665580',
	'lastvisit'		=> '1220665604',
	'enabled'		=> '1'
);

$k_web_pages_table = 'phpbb_k_web_pages';
$k_web_pages_array = array();
$k_web_pages_array[] = array(
	'active'		=> '1',
	'page_name'		=> 'about',
	'page_type'		=> 'B',
	'last_updated'	=> 'Mon 25 Aug 2008',
	'body'			=> '&lt;body id=&quot;phpBB&quot; class=&quot;about ltr&quot; &gt; &lt;div class=&quot;outside&quot;&gt; &lt;div class=&quot;top-left&quot;&gt;&lt;/div&gt;&lt;div class=&quot;top-center&quot;&gt;&lt;/div&gt;&lt;div class=&quot;top-right&quot;&gt;&lt;/div&gt; &lt;div class=&quot;inside&quot;&gt; &lt;div id=&quot;wrap&quot;&gt; &lt;div class=&quot;header&quot;&gt; &lt;h1&gt;&lt;a href=&quot;/&quot;&gt;Stargate Portal &amp;bull; Supporting the phpBB Communities Worldwide&lt;/a&gt;&lt;/h1&gt; &lt;/div&gt; &lt;a name=&quot;start_here&quot;&gt;&lt;/a&gt; &lt;div id=&quot;page-body&quot; style=&quot;padding-top:5px;&quot;&gt; &lt;ul class=&quot;linklist navlinks&quot;&gt; &lt;li&gt;&lt;a href=&quot;http:portal.php&quot;&gt;Home&lt;/a&gt; &lt;strong&gt;&amp;#8249;&lt;/strong&gt; &lt;a href=&quot;web_page.php?mode=about&quot;&gt;About&lt;/a&gt; &lt;/li&gt; &lt;/ul&gt; &lt;div id=&quot;main&quot;&gt; &lt;h2 class=&quot;imgrep about&quot;&gt;About Portal Web Pages&lt;/h2&gt; &lt;p&gt;The &lt;strong&gt;Stargate Portal Web Page Mod&lt;/strong&gt; allows you to add additional dynamic pages to your site. These pages normally consist of standard HTML. This allows you to design a page in your favourite WYSIWYG editor and simply paste the contents into your new web page entry. Note, all data is saved to your database...&lt;/p&gt; &lt;p&gt;We divide all pages into three distinct parts, each saved separately...&lt;br /&gt; a) The page header: (normally contains your logo, menu and links)... &lt;br /&gt; b) The page body: (this contains the main data for you page)...&lt;br /&gt; c) The page footer (normally additional links and copyright data)...&lt;br /&gt;&lt;br /&gt; &lt;strong&gt;Note:&lt;/strong&gt; You can have as many footers, headers and bodies as necessary...&lt;/p&gt; &lt;p&gt;Your new pages can also contain different page descriptions, meta keywords ect., so search bots can index them.&lt;/p&gt; &lt;p&gt;See your administrator control panel (ACP &gt; PORTAL &gt; Web Pages) for more info...&lt;/p&gt; &lt;p&gt;This is an example of what you can achieve with SGP web pages...&lt;/p&gt; &lt;p&gt;&lt;/p&gt; &lt;/div&gt; &lt;div id=&quot;extras&quot;&gt; &lt;div class=&quot;mini-panel sections&quot;&gt; &lt;div class=&quot;inner&quot;&gt;&lt;span class=&quot;corners-top&quot;&gt;&lt;span&gt;&lt;/span&gt;&lt;/span&gt; &lt;h3&gt;&lt;a href=&quot;web?mode=about&quot;&gt;About section&lt;/a&gt;&lt;/h3&gt; &lt;ul class=&quot;menu&quot;&gt; &lt;li&gt;&lt;a href=&quot;web_page.php?mode=about&quot;&gt;About&lt;/a&gt;&lt;/li&gt; &lt;li&gt;&lt;a href=&quot;web_page.php?mode=docs&quot;&gt;Documentation&lt;/a&gt;&lt;/li&gt; &lt;li&gt;&lt;a href=&quot;web_page.php?mode=download&quot;&gt;Download&lt;/a&gt;&lt;/li&gt; &lt;li&gt;&lt;a href=&quot;web_page.php?mode=features&quot;&gt;Features&lt;/a&gt;&lt;/li&gt; &lt;li&gt;&lt;a href=&quot;web_page.php?mode=history&quot;&gt;History&lt;/a&gt;&lt;/li&gt; &lt;li&gt;&lt;a href=&quot;web_page.php?mode=welcome&quot;&gt;Welcome&lt;/a&gt;&lt;/li&gt; &lt;li&gt;&lt;a href=&quot;web_page.php?mode=team&quot;&gt;The team&lt;/a&gt;&lt;/li&gt; &lt;li&gt;&lt;a href=&quot;http://www.stargate-portal.com&quot;&gt;The Development Site&lt;/a&gt;&lt;/li&gt; &lt;li class=&quot;last&quot;&gt;&lt;a href=&quot;http://www.stargate-portal.com&quot;&gt;The Main Site&lt;/a&gt;&lt;/li&gt; &lt;/ul&gt; &lt;span class=&quot;corners-bottom&quot;&gt;&lt;span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/div&gt; &lt;/div&gt; &lt;/div&gt; &lt;/div&gt; &lt;/div&gt;',
	'head'			=> '3',
	'foot'			=> '4',
	'external_file'	=> '',
	'page_title'	=> '',
	'page_desc'		=> 'About Us',
	'page_meta'		=> 'stargate portal phpBB3 phpbb3portal integramod sgp',
	'page_extn'		=> '1',
);
$k_web_pages_array[] = array(
	'active'		=> '1',
	'page_name'		=> 'welcome',
	'page_type'		=> 'B',
	'last_updated'	=> 'Mon 25 Aug 2008',
	'body'			=> '&lt;body id=&quot;phpBB&quot; class=&quot;welcome ltr&quot; &gt; &lt;div class=&quot;outside&quot;&gt; &lt;div class=&quot;top-left&quot;&gt;&lt;/div&gt;&lt;div class=&quot;top-center&quot;&gt;&lt;/div&gt;&lt;div class=&quot;top-right&quot;&gt;&lt;/div&gt; &lt;div class=&quot;inside&quot;&gt; &lt;div id=&quot;wrap&quot;&gt; &lt;div class=&quot;header&quot;&gt;&lt;h1&gt;&lt;a href=&quot;/&quot;&gt;phpBB ??? Creating Communities Worldwide&lt;/a&gt;&lt;/h1&gt;&lt;/div&gt; &lt;a name=&quot;start_here&quot;&gt;&lt;/a&gt; &lt;div id=&quot;page-body&quot; style=&quot;padding-top:5px;&quot;&gt; &lt;ul class=&quot;linklist navlinks&quot;&gt;&lt;li&gt;&lt;a href=&quot;portal.php&quot;&gt;Home&lt;/a&gt;&lt;strong&gt;&amp;#8249;&lt;/strong&gt; &lt;a href=&quot;web_page.php?mode=welcome&quot;&gt;Welcome&lt;/a&gt;&lt;/li&gt;&lt;/ul&gt; &lt;div id=&quot;main&quot;&gt; &lt;h2 class=&quot;imgrep welcome&quot;&gt;About SGP&lt;/h2&gt; &lt;p&gt;The &lt;strong&gt;Stargate Portal&lt;/strong&gt; project (the original portal for phpBB3), was started a couple of days after the public were given access phpBB3 SVN. I originally called the portal the &lt;strong&gt;Kiss Portal&lt;/strong&gt;, but renamed about a year into development as the guys were not gone on the name (I liked it and I still do;)). Originally written to replace the excellent IM Portal by Master David, the main aim being to facilitate upgrading of IntegraMOD II to the next generation (this is well in hand). &lt;/p&gt; &lt;p&gt;Over time the code has changed primarily to keep pace with phpBB3 update but even so, quite a bit of the original code is still present...&lt;/p&gt; &lt;p&gt;&lt;/p&gt; &lt;p&gt;The portal is fully configurable in the ACP, I have also includes many of the more useful blocks as well as one or two nice mods... For a full list of features see the &lt;a href=&quot;web_page.php?mode=features&quot;&gt;features...&lt;/a&gt;&lt;/p&gt; &lt;p&gt;&lt;/p&gt; &lt;/div&gt; &lt;div id=&quot;extras&quot;&gt; &lt;div class=&quot;mini-panel sections&quot;&gt; &lt;div class=&quot;inner&quot;&gt;&lt;span class=&quot;corners-top&quot;&gt;&lt;span&gt;&lt;/span&gt;&lt;/span&gt; &lt;h3&gt;&lt;a href=&quot;web_page.php?mode=about&quot;&gt;Welcome section&lt;/a&gt;&lt;/h3&gt; &lt;ul class=&quot;menu&quot;&gt; &lt;li&gt;&lt;a href=&quot;web_page.php?mode=about&quot;&gt;About&lt;/a&gt;&lt;/li&gt; &lt;li&gt;&lt;a href=&quot;web_page.php?mode=docs&quot;&gt;Documentation&lt;/a&gt;&lt;/li&gt; &lt;li&gt;&lt;a href=&quot;web_page.php?mode=download&quot;&gt;Download&lt;/a&gt;&lt;/li&gt; &lt;li&gt;&lt;a href=&quot;web_page.php?mode=features&quot;&gt;Features&lt;/a&gt;&lt;/li&gt; &lt;li&gt;&lt;a href=&quot;web_page.php?mode=history&quot;&gt;History&lt;/a&gt;&lt;/li&gt; &lt;li&gt;&lt;a href=&quot;web_page.php?mode=welcome&quot;&gt;Welcome&lt;/a&gt;&lt;/li&gt; &lt;li&gt;&lt;a href=&quot;web_page.php?mode=team&quot;&gt;The team&lt;/a&gt;&lt;/li&gt; &lt;li&gt;&lt;a href=&quot;http://www.stargate-portal.com&quot;&gt;The Development Site&lt;/a&gt;&lt;/li&gt; &lt;li class=&quot;last&quot;&gt;&lt;a href=&quot;http://www.stargate-portal.com&quot;&gt;The Main Site&lt;/a&gt;&lt;/li&gt; &lt;/ul&gt; &lt;span class=&quot;corners-bottom&quot;&gt;&lt;span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/div&gt; &lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;',
	'head'			=> '3',
	'foot'			=> '4',
	'external_file'	=> '',
	'page_title'	=> 'Welcome Block',
	'page_desc'		=> '',
	'page_meta'		=> '',
	'page_extn'		=> '0',
);
$k_web_pages_array[] = array(
	'active'		=> '1',
	'page_name'		=> 'header',
	'page_type'		=> 'H',
	'last_updated'	=> 'Mon 25 Aug 2008',
	'body'			=> '&lt;!DOCTYPE html PUBLIC &quot;-//W3C//DTD XHTML 1.0 Strict//EN&quot; &quot;http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd&quot;&gt;&lt;html xmlns=&quot;http://www.w3.org/1999/xhtml&quot; dir=&quot;ltr&quot; lang=&quot;en-gb&quot; xml:lang=&quot;en-gb&quot;&gt;&lt;head&gt;&lt;meta http-equiv=&quot;content-type&quot; content=&quot;text/html; charset=UTF-8&quot; /&gt;&lt;meta http-equiv=&quot;content-style-type&quot; content=&quot;text/css&quot; /&gt;&lt;meta http-equiv=&quot;content-language&quot; content=&quot;en-gb&quot; /&gt;&lt;meta http-equiv=&quot;imagetoolbar&quot; content=&quot;no&quot; /&gt;&lt;meta name=&quot;resource-type&quot; content=&quot;document&quot; /&gt;&lt;meta name=&quot;distribution&quot; content=&quot;global&quot; /&gt;&lt;meta name=&quot;copyright&quot; content=&quot;2002-2006 phpBB Group&quot; /&gt;&lt;meta name=&quot;keywords&quot; content=&quot;&quot; /&gt;&lt;meta name=&quot;description&quot; content=&quot;&quot; /&gt;&lt;title&gt;phpbbireland.com &amp;bull; Portal&lt;/title&gt;&lt;link rel=&quot;shortcut icon&quot; href=&quot;http:www.phpbbireland/favicon.ico&quot; /&gt;&lt;link rel=&quot;icon&quot; href=&quot;favicon.ico&quot; type=&quot;image/x-icon&quot; /&gt;&lt;link href=&quot;./styles/portal_common/template/web_pages/theme/common.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/portal_common/template/web_pages/theme/links.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/portal_common/template/web_pages/theme/content.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/portal_common/template/web_pages/theme/buttons.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/portal_common/template/web_pages/theme/cp.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/portal_common/template/web_pages/theme/forms.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/portal_common/template/web_pages/theme/tweaks.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/portal_common/template/web_pages/theme/colours.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/portal_common/template/web_pages/theme/website.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/portal_common/template/web_pages/theme/headers.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/portal_common/template/web_pages/theme/titles.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/portal_common/template/web_pages/theme/navigation.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/portal_common/template/web_pages/theme/documentation.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/portal_common/template/web_pages/theme/silver.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;link href=&quot;./styles/portal_common/template/web_pages/theme/portal_adds.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; media=&quot;screen, projection&quot; /&gt;&lt;/head&gt;',
	'head'			=> '0',
	'foot'			=> '0',
	'external_file'	=> '',
	'page_title'	=> '',
	'page_desc'		=> 'Default Header',
	'page_meta'		=> 'stargate portal phpBB3 phpbb3portal integramod sgp',
	'page_extn'		=> '0',
);
$k_web_pages_array[] = array(
	'active'		=> '1',
	'page_name'		=> 'footer',
	'page_type'		=> 'F',
	'last_updated'	=> 'Mon 25 Aug 2008',
	'body'			=> '&lt;div id=&quot;page-footer&quot;&gt; &lt;div class=&quot;copyright&quot;&gt; Powered by &lt;a href=&quot;http://www.phpbb.com/&quot;&gt;phpBB&lt;/a&gt;  &amp;copy; 2000, 2002, 2005, 2007 phpBB Group &lt;br /&gt;Portal: &lt;a href=&quot;http://www.phpbbireland.com&quot;&gt; Stargate Portal (the original phpbb3portal)&lt;/a&gt; {PORTAL_VERSION} &amp;copy; 2005 - 2010 &lt;a href=&quot;mailto:o2l@eircom.net&quot;&gt;Michael O\'Toole&lt;/a&gt;&lt;br /&gt; &lt;/div&gt;&lt;div&gt;&lt;a id=&quot;bottom&quot; name=&quot;bottom&quot; accesskey=&quot;z&quot;&gt;&lt;/a&gt;&lt;div class=&quot;bottom-left&quot;&gt;&lt;/div&gt;&lt;div class=&quot;bottom-center&quot;&gt;&lt;/div&gt;&lt;div class=&quot;bottom-right&quot;&gt;&lt;/div&gt;&lt;/body&gt;&lt;/html&gt;',
	'head'			=> '0',
	'foot'			=> '0',
	'external_file'	=> '',
	'page_title'	=> '',
	'page_desc'		=> 'Default footer',
	'page_meta'		=> 'stargate portal phpBB3 phpbb3portal integramod sgp',
	'page_extn'		=> '0',
);
$k_web_pages_array[] = array(
	'active'		=> '1',
	'page_name'		=> 'wrapper',
	'page_type'		=> 'P',
	'last_updated'	=> 'Sat 18 Jul 2009',
	'body'			=> '&lt;div id=&quot;main&quot;&gt;&lt;object width=&quot;425&quot; height=&quot;344&quot;&gt;&lt;param name=&quot;movie&quot; value=&quot;http://www.youtube.com/v/AhR04kmcSXU&amp;hl=en&amp;fs=1&quot;&gt;&lt;/param&gt;&lt;param name=&quot;allowFullScreen&quot; value=&quot;true&quot;&gt;&lt;/param&gt;&lt;param name=&quot;allowscriptaccess&quot; value=&quot;always&quot;&gt;&lt;/param&gt;&lt;embed src=&quot;http://www.youtube.com/v/AhR04kmcSXU&amp;hl=en&amp;fs=1&quot; type=&quot;application/x-shockwave-flash&quot; allowscriptaccess=&quot;always&quot; allowfullscreen=&quot;true&quot; width=&quot;425&quot; height=&quot;344&quot;&gt;&lt;/embed&gt;&lt;/object&gt;&lt;div&gt; &lt;div style=&quot;text-align:center&quot;&gt;With a little imagination you could put some html code here and the portal will wrap around it!&lt;br /&gt;Note, you can also determine which blocks (if any) are displayed in the wrapper...  &lt;/div&gt;',
	'head'			=> '0',
	'foot'			=> '0',
	'external_file'	=> '',
	'page_title'	=> '',
	'page_desc'		=> 'Port Page Wrapper',
	'page_meta'		=> 'stargate portal phpBB3 phpbb3portal integramod sgp',
	'page_extn'		=> '0',
);
$k_web_pages_array[] = array(
	'active'		=> '1',
	'page_name'		=> 'youtube',
	'page_type'		=> 'B',
	'last_updated'	=> 'Sat 18 Jul 2009',
	'body'			=> '',
	'head'			=> '3',
	'foot'			=> '4',
	'external_file'	=> '',
	'page_title'	=> '',
	'page_desc'		=> 'Portal youtube Mod',
	'page_meta'		=> 'stargate portal phpBB3 phpbb3portal integramod sgp',
	'page_extn'		=> '0',
);
$k_web_pages_array[] = array(
	'active'		=> '1',
	'page_name'		=> '404',
	'page_type'		=> 'B',
	'last_updated'	=> 'Sat 18 Jul 2009',
	'body'			=> '&lt;body id=&quot;phpBB&quot; class=&quot;about ltr&quot;&gt;
&lt;div class=&quot;outside&quot;&gt;&lt;div class=&quot;top-left&quot;&gt;&lt;/div&gt;&lt;div class=&quot;top-center&quot;&gt;&lt;/div&gt;&lt;div class=&quot;top-right&quot;&gt;&lt;/div&gt;
	&lt;div class=&quot;inside&quot;&gt;
		&lt;div id=&quot;wrap&quot;&gt;

			&lt;div class=&quot;header&quot;&gt;&lt;h1&gt;&lt;a href=&quot;/&quot;&gt;Stargate Portal integrating Communities Worldwide&lt;/a&gt;&lt;/h1&gt;&lt;/div&gt;&lt;a name=&quot;start_here&quot;&gt;&lt;/a&gt;
				&lt;div id=&quot;page-body&quot; style=&quot;padding-top:5px;&quot;&gt;
					&lt;ul class=&quot;linklist navlinks&quot;&gt;
						&lt;li&gt;&lt;a href=&quot;portal.php&quot;&gt; Back to portal page &lt;/a&gt;&lt;strong&gt;&lt;/li&gt;
					&lt;/ul&gt;
					&lt;div id=&quot;main&quot;&gt;
						&lt;h2 class=&quot;imgrep error403&quot;&gt;File missing...&lt;/h2&gt;
						&lt;p style=&quot;font-size:16px;&quot;&gt;&lt;strong&gt;The page you requested could not be found...&lt;/strong&gt;&lt;/p&gt;
						&lt;p&gt;Please choose from the available links on right.&lt;/p&gt;
					&lt;/div&gt;
					&lt;div id=&quot;extras&quot;&gt;
						&lt;div class=&quot;mini-panel sections&quot;&gt;
							&lt;div class=&quot;inner&quot;&gt;&lt;span class=&quot;corners-top&quot;&gt;&lt;span&gt;&lt;/span&gt;&lt;/span&gt;
								&lt;h3&gt;&lt;a href=&quot;web_page.php?mode=about&quot;&gt;Page Options&lt;/a&gt;&lt;/h3&gt;
								&lt;ul class=&quot;menu&quot;&gt;
									&lt;li&gt;&lt;a href=&quot;portal.php&quot;&gt;Back to Portal&lt;/a&gt;&lt;/li&gt;
									&lt;li&gt;&lt;a href=&quot;index.php&quot;&gt;Back to index&lt;/a&gt;&lt;/li&gt;
									&lt;li&gt;&lt;a href=&quot;web_page.php?mode=about&quot;&gt;About&lt;/a&gt;&lt;/li&gt;
									&lt;li&gt;&lt;a href=&quot;web_page.php?mode=docs&quot;&gt;Documentation&lt;/a&gt;&lt;/li&gt;
									&lt;li&gt;&lt;a href=&quot;web_page.php?mode=download&quot;&gt;Download&lt;/a&gt;&lt;/li&gt;
									&lt;li&gt;&lt;a href=&quot;web_page.php?mode=features&quot;&gt;The features&lt;/a&gt;&lt;/li&gt;
									&lt;li&gt;&lt;a href=&quot;web_page.php?mode=history&quot;&gt;The history&lt;/a&gt;&lt;/li&gt;
									&lt;li&gt;&lt;a href=&quot;web_page.php?mode=team&quot;&gt;The team&lt;/a&gt;&lt;/li&gt;
									&lt;li&gt;&lt;a href=&quot;http://www.phpbb.com/community/viewtopic.php?f=70&amp;t=550233&quot;&gt;Stargate Portal at phpbb&lt;/a&gt;&lt;/li&gt;
									&lt;li&gt;&lt;a href=&quot;http://www.stargate-portal.com&quot;&gt;The Development Site&lt;/a&gt;&lt;/li&gt;
									&lt;li class=&quot;last&quot;&gt;&lt;a href=&quot;http://www.stargate-portal&quot;&gt;The Main Site&lt;/a&gt;&lt;/li&gt;
								&lt;/ul&gt;
							&lt;span class=&quot;corners-bottom&quot;&gt;&lt;span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/div&gt;
						&lt;/div&gt;
					&lt;/div&gt;
				&lt;/div&gt;
			&lt;/div&gt;',
	'head'			=> '0',
	'foot'			=> '0',
	'external_file'	=> '',
	'page_title'	=> '404',
	'page_desc'		=> 'Page not found!',
	'page_meta'		=> 'SGP-404 stargate portal phpBB3 phpbb3portal integramod sgp',
	'page_extn'		=> '1',
);

$k_youtube_table = 'phpbb_k_youtube';
$k_youtube_array[] = array(
	'video_category'	=> 'Gregorian',
	'video_who'			=> 'Gregorian',
	'video_link'		=> 'TP71E7QLy9A',
	'video_title'		=> 'Moment Of Peace',
	'video_rating'		=> '5',
	'video_comment'		=> '',
	'video_poster_id'	=> '2',
);

$k_resource_table = 'phpbb_k_resource';
$k_resource_array[] = array(
	'word'	=> 'phpBB',
	'type'	=> 'R',
);
$k_resource_array[] = array(
	'word'	=> '{PORTAL_VERSION}',
	'type'	=> 'V',
);
$k_resource_array[] = array(
	'word'	=> '{PORTAL_BUILD}',
	'type'	=> 'V',
);
$k_resource_array[] = array(
	'word'	=> '{VERSION}',
	'type'	=> 'V',
);
$k_resource_array[] = array(
	'word'	=> '{SITENAME}',
	'type'	=> 'V',
);


$k_pages_table = 'phpbb_k_pages';
$k_pages_array[] = array(
	'page_name'	=> 'index',
);
$k_pages_array[] = array(
	'page_name'	=> 'portal',
);
$k_pages_array[] = array(
	'page_name'	=> 'viewforum',
);
$k_pages_array[] = array(
	'page_name'	=> 'viewtopic',
);
$k_pages_array[] = array(
	'page_name'	=> 'memberlist',
);
$k_pages_array[] = array(
	'page_name'	=> 'mcp',
);
$k_pages_array[] = array(
	'page_name'	=> 'ucp',
);
$k_pages_array[] = array(
	'page_name'	=> 'search',
);
$k_pages_array[] = array(
	'page_name'	=> 'faq',
);
$k_pages_array[] = array(
	'page_name'	=> 'posting',
);
$k_pages_array[] = array(
	'page_name'	=> 'basic_rules',
);
$k_pages_array[] = array(
	'page_name'	=> 'portal_page',
);
$k_pages_array[] = array(
	'page_name'	=> 'web_page',
);
$k_pages_array[] = array(
	'page_name'	=> 'youtube',
);

// Finished tables and data ... A schema file is so much easier ;) 23 September 2010
?>