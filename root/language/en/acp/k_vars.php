<?php
/**
*
* acp_k_vars [English] (Additional variables used by portal)
*
* @package language
* @version $Id: k_vars.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* @copyright (c) 2006 phpbbireland Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* DO NOT CHANGE
*/

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(

	'TITLE_MAIN' => 'General Portal Variable',
	'TITLE_BLOCK' => 'Portal Block Variable',

	'TITLE_EXPLAIN_MAIN'	=> 'Setting for variables used by general portal blocks...',
	'TITLE_EXPLAIN_BLOCK'	=> 'Blocks can contain variables, normally stored in the K_BLOCKS_CONFIG_VAR_TABLE, associated html file (to display the variables) are located in adm/style/k_block_vars folder.<br />
	If you add your own block variables, you need to include the html file to display and edit these variables.',

	'NEWS_SETTINGS'		=> 'News Settings',

	'NEWS_TYPE'			=> 'News Type',
	'NEWS_TYPE_EXPLAIN'	=> 'Local, Global or Both.',

	'LOCAL_ANNOUNCE'	=> 'Local Announcement ',
	'GLOBAL_ANNOUNCE'	=> 'Global Announcement',
	'LOCAL_NEWS'		=> 'Local News',
	'GLOBAL_NEWS'		=> 'Global News',
	'BOTH'				=> 'Both types',

	'RECENT_TOPICS_SETTINGS' => 'Recent Topics Settings',
	'NUMBER_OF_RECENT_TOPICS_TO_DISPLAY' => 'Number of recent topics to display if block data is static',
	'NUMBER_OF_RECENT_TOPICS_TO_DISPLAY_EXPLAIN' => 'Note: If you allow scrolling, all recent posts will be displayed.',

	'SEARCH_DAYS'				=> 'How many days will we search?',
	'SEARCH_DAYS_EXPLAIN'		=> 'Limit the number of days we search back to reduce database load.',

	'POSTS_TYPES'				=> 'Include all post types',
	'POSTS_TYPES_EXPLAIN'		=> 'No will display normal post only, Yes will display all post types...',

	'NUMBER_OF_NEWS_ITEMS_TO_DISPLAY' => 'Number of news item to display',
	'NUMBER_OF_NEWS_ITEMS_TO_DISPLAY_EXPLAIN' => 'The number of news items shown on portal page.',

	'NUMBER_OF_TOPICS_PER_FORUM' => 'Number of topics per forum',
	'NUMBER_OF_TOPICS_PER_FORUM_EXPLAIN' => 'The maximum number of topics returned from each forum.',


	'MAX_NEWS_ITEM_LENGTH' => 'Length of news item',
	'MAX_NEWS_ITEM_LENGTH_EXPLAIN' => 'Maximum length to display for each news item, 0 to show full article.',
	'ALLOW_NEWS' => 'Allow news to be displayed',
	'ALLOW_NEWS_EXPLAIN' => 'Allow News to be displayed in portal page.',

	'ANNOUNCE_SETTINGS'		=> 'Announcement Settings',
	'ANNOUNCE_FORUM_ID' => 'Announcements Forum ID',
	'ANNOUNCE_FORUM_ID_EXPLAIN' => 'The ID of the announcement forum.',
	'NUMBER_OF_ANNOUNCE_ITEMS_TO_DISPLAY' => 'Number of announcements to display',
	'NUMBER_OF_ANNOUNCE_ITEMS_TO_DISPLAY_EXPLAIN' => 'The number of announcements to show on portal page.',
	'MAX_ANNOUNCE_ITEM_LENGTH' => 'Length of announcements',
	'MAX_ANNOUNCE_ITEM_LENGTH_EXPLAIN' => 'Maximum length of each announcement to display, 0 to show full article.',
	'ALLOW_ANNOUNCE' => 'Allow Announcements',
	'ALLOW_ANNOUNCE_EXPLAIN' => 'Allow announcements to be displayed on portal.',

	'BOT_SETTINGS'	=> 'Bot Settings',
	'ALLOW_BOT_DISPLAY' => 'Allow bot report',
	'ALLOW_BOT_DISPLAY_EXPLAIN' => 'Enable/Disable bot report.',
	'NUMBER_OF_BOTS_TO_DISPLAY' => 'Number of bots to display',
	'NUMBER_OF_BOTS_TO_DISPLAY_EXPLAIN' => 'You can determine the number of bots to display.',

	'LINKS_SETTINGS' => 'Link Block Settings',
	'NUMBER_OF_LINKS_TO_DISPLAY' => 'Number of links to display in Link Block',
	'NUMBER_OF_LINKS_TO_DISPLAY_EXPLAIN' => '0 (zero) to scroll all links...',
	'LINKS_SCROLL_AMOUNT' => 'Scroll Amount/Speed',
	'LINKS_SCROLL_AMOUNT_EXPLAIN' => 'Set to 1 for slow... 5 for fast...',
	'LINK_TO_US' => 'The link image name',
	'LINK_TO_US_EXPLAIN' => 'The image must exist in: ./images folder. (size: 88x31px)',
	'LINK_FORUM_ID' => 'The id of the forum to be used for uploading link images',
	'LINK_FORUM_ID_EXPLAIN' => 'Places a link at the bottom of the Link Block to direct members to a designated links upload forum, should one exist.',

	'LINKS_SCROLL_DIRECTION' => 'Scroll Direction',
	'LINKS_SCROLL_DIRECTION_EXPLAIN' => 'Scroll 0 = Up or 1 = Down',
	'FOOTER_IMAGES' => 'Portal Footer Images',
	'ALLOW_FOOTER_IMAGES' => 'Display Portal Footer Images',
	'ALLOW_FOOTER_IMAGES_EXPLAIN' => 'Turn on/off link images in the portal footer...',

	'K_SHOW_SMILIES' => 'Show Smilies on Quick Reply',
	'K_SHOW_SMILIES_EXPLAIN' => 'Some mods may require you don\'t display Smilies on Quick Reply',

	'SHOW_BLOCKS_ON_INDEX_PORTAL' => 'Blocks display options.',
	'SHOW_BLOCKS_ON_INDEX_L' => 'Display the left blocks on the index page',
	'SHOW_BLOCKS_ON_INDEX_R' => 'Display the right blocks on the index page',
	'SHOW_BLOCKS_ON_PORTAL_L' => 'Display the left blocks on the portal page',
	'SHOW_BLOCKS_ON_PORTAL_R' => 'Display the right blocks on the portal page',
	'SHOW_BLOCKS_ON_SEARCH_L' => 'Display the left blocks on the Search page',
	'SHOW_BLOCKS_ON_SEARCH_R' => 'Display the right blocks on the Search page',
	'SHOW_BLOCKS_ON_MCP_L' => 'Display the left blocks on the MCP page',
	'SHOW_BLOCKS_ON_MCP_R' => 'Display the right blocks on the MCP page',
	'SHOW_BLOCKS_ON_UCP_L' => 'Display the left blocks on the UCP page',
	'SHOW_BLOCKS_ON_UCP_R' => 'Display the right blocks on the UCP page',
	'SHOW_BLOCKS_ON_MEM_L' => 'Display the left blocks on the Members page',
	'SHOW_BLOCKS_ON_MEM_R' => 'Display the right blocks on the Members page',


	'SHOW_BLOCKS_ON_VT_L' => 'Display the left blocks on the Viewtopic page',
	'SHOW_BLOCKS_ON_VT_R' => 'Display the right blocks on the Viewtopic page',
	'SHOW_BLOCKS_ON_VF_L' => 'Display the left blocks on the Viewforum page',
	'SHOW_BLOCKS_ON_VF_R' => 'Display the right blocks on the Viewforum page',
	'SHOW_BLOCKS_ON_VO_L' => 'Display the left blocks on the Viewonline page',
	'SHOW_BLOCKS_ON_VO_R' => 'Display the right blocks on the Viewonline page',

	//'SHOW_BLOCKS_ON_INDEX_L_EXPLAIN' => 'Enable or disable left blocks on index page.',
	//'SHOW_BLOCKS_ON_INDEX_R_EXPLAIN' => 'Enable or disable right blocks on index page.',

	'BLOCKS_GLOBAL'	=> 'Display blocks options',
	'DISPLAY_BLOCKS_GLOBAL' => 'Enable blocks for all pages',
	'DISPLAY_BLOCKS_GLOBAL_EXPLAIN' => 'Setting to NO will disable all blocks on all pages. This will override all other block settings.',

	'ANNOUNCE_TYPE'	=> 'Announcement type',
	'ANNOUNCE_TYPE_EXPLAIN'	=> 'Which type of announcements do you want to display?',

	'HEADER_BANNER'		=> 'Header banner',
	'FOOTER_BANNER'		=> 'Footer Banner',
	'BOTH_BANNERS'		=> 'Both Header and Footer',
	'HEADER_IMAGE'		=> 'Display a random Header image in Portal',
	'HEADER_IMAGE_SW'	=> 'Display a random Header image in all pages (Site Wide)',
	'NO_BANNERS'		=> 'No Banner',
	'NO_HEADER'			=> 'No Header Image',
	'RAND_BANNER' 		=> 'Portal Random Banner',
	'RAND_HEADER' 		=> 'Portal Random Header Image',
	'ALLOW_RAND_BANNER' => 'Displays a banner in the site header and/or footer',
	'ALLOW_RAND_BANNER_EXPLAIN' => 'You can add a randomly selected banner image to the header and or footer...<br />Images must be placed in the images/rand_banner folder.<br /><b>Note</b>, for a fixed banner just place one image in folder.',
	'ALLOW_RAND_HEADER' => 'Displays a random header image at top of portal and index page',
	'ALLOW_RAND_HEADER_EXPLAIN' => 'The images width/height can be set in one of the style css file, the tag being random_header_image.<br />Random header images must be placed in the images/rand_header folder.<br />',

	'BLOCK_COOKIES'		=> 'Block Cookies',
	'USE_COOKIES'		=> 'Use cookies to store block info',
	'USE_COOKIES_EXPLAIN'	=> 'Use cookies to store block location and visibility',
	'PORTAL_LOGOS'			=> 'Site Logo',
	'RAND_LOGOS'			=> 'Random Site Logo',
	'RAND_LOGOS_EXPLAIN'	=> 'The portal will use random logos if they exist. <br />Simply add several images to your styles (theme/images/logos directory).',

	'NUMBER_OF_TOP_POSTERS_TO_DISPLAY'			=> 'Number of top posters to display',
	'NUMBER_OF_TOP_POSTERS_TO_DISPLAY_EXPLAIN'	=> 'Set the number of top posters to display in Top Posters Block',

	'NUMBER_OF_TOP_REFERRALS_TO_DISPLAY'			=> 'Number of top referrals to display',
	'NUMBER_OF_TOP_REFERRALS_TO_DISPLAY_EXPLAIN'	=> 'Set the number of top referrals to display in Top Referrals Block',

	'NUMBER_OF_TEAM_MEMBERS_TO_DISPLAY'			=> 'Number of team members to display',
	'NUMBER_OF_TEAM_MEMBERS_TO_DISPLAY_EXPLAIN'	=> 'Set the number of members to display in Members Block',

	'EXCLUDE'			=> 'Exclude forums for search',
	'EXCLUDE_EXPLAIN'	=> 'The ID\'s of the forums to exclude from search... (comma separated)',

	'SWITCH_VARS'	=> 'Switch Main/Block variables',
	'NO_VARS_FOUND'	=> '',
));

// Portal Menu Names + add you menu language variables here! //
$lang = array_merge($lang, array(
	'ACP'					=> 'Admin CP',
	'ALBUM'					=> 'Album',
	'BOOKMARKS'				=> 'Bookmarks',
	'CATEGORIES'			=> 'Categories',
	'SGP_Blog'				=> 'SGP Integrated Blog',
	'DOWNLOADS'				=> 'Downloads',
	'FORUM'					=> 'Forum',
	'KB'					=> 'Knowledge Base',
	'LINKS'					=> 'Links',
	'MEMBERS'				=> 'Members',
	'PORTAL'				=> 'Portal',
	'RATINGS'				=> 'Latest Ratings',
	'RULES'					=> 'Portal Rules',
	'SITE_NAVIGATOR'		=> 'Navigator',
	'STATISTICS'			=> 'Statistics',
	'SITE_RULES'			=> 'Site Rules',
	'SITE_STATISTICS'		=> 'Site Statistics',
	'STAFF'					=> 'Staff',
	'STYLES_DEMO'			=> 'Styles Demo',
	'STYLE_SELECT'			=> 'Style Select',
	'UCP'					=> 'User CP',
	'UNRESOLVED/BUGS'		=> 'Unresolved/Bugs',
	'UPLOAD'				=> 'Upload Images',
	'USER_INFORMATION'		=> 'User Information',
	'WELCOME'				=> 'Welcome',
));

// Portal Block Names + add your block name language variables here! //
$lang = array_merge($lang, array(
	'ACP_SMALL'			=> 'Admin CP',
	'ANNOUNCEMENTS'		=> 'Announcements',
	'BIRTHDAY'			=> 'Birthday',
	'BLOG'				=> 'SGP Integrated Blog',
	'BOARD_MINI_NAV'	=> 'Sub Nav',
	'BOARD_STYLE'		=> 'Board Style',
	'BOARD_NAV'			=> 'Board Navigation',
	'BOT_TRACKER'		=> 'Bot Tracker',
	'BOT_TRACKER_SMALL'	=> 'Bot Tracker',
	'BOOKS' 			=> 'Books',
	'CALENDAR'			=> 'Calendar',
	'CHAT'				=> 'Chat',
	'CLOCK'				=> 'Clock',
	'DOWNLOADS'			=> 'Downloads',
	'FM_RADIO'			=> 'FM Radio',
	'FORUM_CATEGORIES'	=> 'Forum categories',
	'GALLERY'			=> 'Gallery',
	'LINKS'             => 'Links',
	'MAIN_MENU'			=> 'Board Navigation',
	'MEMBERS'			=> 'Members',
	'MP3_PLAYER'		=> 'Mp3 player',
	'NEWS'				=> 'News',
	'NEWS_REPORT'		=> 'Site News Report',
	'PORTAL'			=> 'Portal',
	'PORTAL_STATUS'		=> 'Portal Status',
	'RECENT_TOPICS'		=> 'Recent Topics',
	'SELECT_STYLE'		=> 'Select a new style',
	'SITE_LINK_TXT'		=> 'Link to us',
	'STAFF'				=> 'Staff',
	'STATISTICS'		=> 'Statistics',
	'STATS'		 		=> 'Statistics',
	'STYLE_STATUS'		=> 'Styles Status',
	'SUB_MENU'			=> 'Secondary Menu',
	'TOP_10_PICS'		=> 'Top 10 Rated Pictures',
	'TOP_DOWNLOADS'		=> 'Top Downloads',
	'TOP_POSTERS'		=> 'Top Posters',
	'TOP_REFERRALS'		=> 'Top Referrals',
	'UNRESOLVED'		=> 'Unresolved',
	'UCP'				=> 'User CP',
	'USER_INFO'			=> 'User Information',
	'WELCOME_SITE'		=> 'Welcome to %s',
	'YOUR_PROFILE'		=> 'User profile',
	'SWITCHING'			=> 'Switching to SGP config',
	'LAST_ONLINE'				=> 'List recent online members.',
	'MAX_LAST_ONLINE'			=> 'Display this many members in list.',
	'MAX_LAST_ONLINE_EXPLAIN'	=> 'The maximum members to display in online list.',
	'TOP_TOPICS'				=> 'Most active topics.',
	'MAX_TOP_TOPICS'			=> 'Number of topics to display.',
	'MAX_TOP_TOPICS_EXPLAIN'	=> 'The max number of most active topics to display.',
	'DAYS_TOP_TOPICS'			=> 'Number of days to look back for top topics.',
	'DAYS_TOP_TOPICS_EXPLAIN'	=> 'The number of past days used for the search.',
	'TOPICSPERFORUM'			=> 'Number of topics per forum.',
	'TOPICSPERFORUM_EXPLAIN'	=> 'Limit the number of topics returned for each forum.',
	'SAVING'					=> 'Updating database...',
	'SAVED'						=> 'Saving changes...',
	'REQUIRED_DATA_MISSING'		=> 'Required data is missing...<br />',
	'UNKNOWN_ERROR'				=> 'Error not processing saved data<br />',
	'IRC_CHAT'					=> 'IRC Chat',
	'YOUTUBE_LINK'				=> 'Actual youtube link (URL)',
	'YOUTUBE_LINK_EXPLAIN'		=> 'Just in case youtube ever change we best provide an alternate',
	'NO_CONFIG_FILE_FOUND'		=> 'No configuration required, or no file available for this module.',

	'BLOCK_CACHE_TIME_RECENT'	=> 'Recent topics cache time',
	'BLOCK_CACHE_TIME_SHORT'	=> 'Block cache time short',
	'BLOCK_CACHE_TIME_LONG'		=> 'Block cache time long ',
	'BLOCK_CACHE_TIME_MEDIUM'	=> 'Block cache time medium',


	'BLOCK_RECENT_CACHE_TIME'			=> 'Set recent topics cache time.',
	'BLOCK_RECENT_CACHE_TIME_EXPLAIN'	=> 'Currently all blocs except recent opics use the same cache period.',
));

// Block Names
$lang = array_merge($lang, array(
	'ADMIN_OPTIONS'		=> 'Admin Options',
	'BABEL_FISH'		=> 'Babel Fish',
	'BUG_TRACKER'		=> 'Bug Tracker',
	'TRANSLATE_SITE'	=> '<strong>Translate site to...</strong>',
	'TRANSLATE_RESET'	=> '<strong>Reset to original language</strong>',
	'ANNOUNCEMENTS_AND_NEWS'	=> 'Announcements and News',
	'TOP_POSTERS_SETTINGS'		=> 'Top Posters block settings',
	'TOP_REFERRALS_SETTINGS'	=> 'Top Referrals block settings',
	'THE_TEAM_SETTINGS'			=> 'Team Members block settings',
));

// Acronyms
$lang = array_merge($lang, array(
	'ACP_ACRONYMS'			=> 'Manage acronyms',
	'ACP_ACRONYMS_EXPLAIN'	=> 'Add and manage acronyms in posts... <br /><strong>Note:</strong> Where acronyms are comprised or two or more words, they should not contain existing acronyms in their meaning... <br />For example, in the case of the acronym: phpBB3 which appears in the acronym: Stargate Portal, we replace <strong>phpBB3</strong> with <strong>phpBB version 3</strong> to avoid breaking things... In general acronyms should not contain spaces...',
	'ACRONYM'				=> 'Acronym',
	'ACRONYM_EXPLAIN'		=> 'From this control panel you can add, edit, and remove acronyms that will be automatically added to posts on your forums.',

	'ACRONYMS'					=> 'Acronyms',

	'ALLOW_ACRONYMS'			=> 'Process acronyms in posts',
	'ALLOW_ACRONYMS_EXPLAIN'	=> 'Acronyms in post will not be processed if disable here...',

	'ADD_ACRONYM'				=> 'Add Acronym',
	'EDIT_ACRONYM'				=> 'Edit acronym',
	'EDIT_ACRONYM_EXPLAIN'		=> 'Edit the meaning for the acronym:',
	'ACRONYM_MEANING'			=> 'Enter the full meaning',
	'CONFIG_ACRONYMS'			=> 'Configure',

	'RESERVED'				=> 'Reserved words.',
	'RESERVED_EXPLAIN'		=> 'These words cannot be used as an acronym, they are in the reserved word list...',
	'RESERVED_WORD_LIST'	=> 'Manage reserved words',
	'DELETE'				=> 'To delete words, simply remove them',
	'DELETE_CURRENT'		=> 'Remove',
	'ADD_NEW_WORD'			=> 'Add word',
	'NEW_WORD'				=> 'Add new reserved word.',

));

// IRC Channel
$lang = array_merge($lang, array(
	'IRC_CHANNEL'				=> 'IRC Channel',
	'IRC_CHANNEL_NAME'			=> 'Name of your IRC channel',
	'IRC_CHANNEL_EXPLAIN'		=> 'The name of the IRC channel you want to use on your board.',
	'OPT_IRC_CHANNELS' 			=> 'Optional IRC Channels',
	'OPT_IRC_CHANNELS_EXPLAIN'	=> 'Here you can add optional IRC channels. starting with # in the channel name and separated with a comma (,) but NOT spaces. For example: #channel1,#Channel2,#channel3',
));

// Age Ranges
$lang = array_merge($lang, array(
	'AGE_RANGES'				=> 'Age Ranges',
	'AGE_INTERVAL'				=> 'Age interval',
	'AGE_INTERVAL_EXPLAIN'		=> 'The interval to use in the age groups.',
	'AGE_START' 				=> 'Age start',
	'AGE_START_EXPLAIN'			=> 'The age to start the first group with.',
	'AGE_LIMIT' 				=> 'Age upper limit',
	'AGE_LIMIT_EXPLAIN'			=> 'The upper age limit to show. NOTE: If you want to show up to for example 100: put in 101 here. (Last group end value + 1)',
));

// Cloud
$lang = array_merge($lang, array(
	'ACP_CLOUD'				=> 'Portal cloud tags default settings. (Cloud 9)',
	'ACP_CLOUD_EXPLAIN'		=> 'Here you can add, edit and delete tags. <strong>Note:</strong> Using a font size greater than 16pt is not recommended, also it might be difficult to see light coloured fonts...',
	
	'ADD_CLOUD'				=> 'Add a cloud',
	'EDIT_CLOUD'			=> 'Edit a cloud',
	'DELETE_CLOUD'			=> 'Delete a cloud',
	'CONFIG_CLOUD'			=> 'Config cloud defaults',

	'CLOUD_ID'				=> 'ID',
	'CLOUD_ID_LONG'			=> 'The tag ID (do not edit)',
	'CLOUD_IS_ACTIVE'		=> 'A',
	'CLOUD_IS_ACTIVE_LONG'	=> 'Set tag as active',
	'CLOUD_LONG'			=> 'Tags/Cats',
	'CLOUD_LINK'			=> 'Link',
	'CLOUD_LINK_LONG'		=> 'Link to use for the tag',
	'CLOUD_COLOUR'			=> 'Colour',
	'CLOUD_COLOUR_LONG'		=> 'Tag colour (HEX color value)',
	'CLOUD_HCOLOUR'			=> 'H Colour',
	'CLOUD_HCOLOUR_LONG'	=> 'Tag Highlight colour (HEX color value)',
	'CLOUD_CLASS'			=> 'Class',
	'CLOUD_CLASS_LONG'		=> 'Unknown Class',
	'CLOUD_REL'				=> 'R',
	'CLOUD_REL_LONG'		=> 'Unknown',
	'CLOUD_FONT_SIZE'		=> 'Font size',
	'CLOUD_FONT_SIZE_LONG'	=> 'The font size to use (MAX ~ 16pt)',
	'CLOUD_TEXT'			=> 'Tag Text',
	'CLOUD_TEXT_LONG'		=> 'The tag text to display<br />Actual size and colour',


	'CLOUD_MAX_TAGS'			=> 'Max tags',
	'CLOUD_MAX_TAGS_EXPLAIN'	=> 'Set Max tags so you don\'t clutter the block.',
	'CLOUD_MOVIE'				=> 'Cloud Movie',
	'CLOUD_MOVIE_EXPLAIN'		=> 'Each cloud can have its own movie.',
	'CLOUD_WIDTH'				=> 'Cloud width',
	'CLOUD_WIDTH_EXPLAIN'		=> 'The width of the Cloud block.',
	'CLOUD_HEIGHT'				=> 'Cloud height',
	'CLOUD_HEIGHT_EXPLAIN'		=> 'The height of the Cloud block.',
	'CLOUD_TCOLOUR'				=> 'Tag colour',
	'CLOUD_TCOLOUR_EXPLAIN'		=> 'Tag main colour.',
 	'CLOUD_TCOLOUR2'			=> 'Secondary tag colour',
	'CLOUD_TCOLOUR2_EXPLAIN'	=> 'Tag color for less important tags.',
	'CLOUD_HICOLOUR'			=> 'Highlight colour',
	'CLOUD_HICOLOUR_EXPLAIN'	=> 'The highlight colour for the tag.',
	'CLOUD_BG_COLOUR'			=> 'Tag cloud background colour',
	'CLOUD_BG_COLOUR_EXPLAIN'	=> 'Tag cloud background colour *transparent (see WMODE).',
	'CLOUD_SPEED'				=> 'Speed, how fast tags rotate',
	'CLOUD_SPEED_EXPLAIN'		=> 'Percentage, higher means faster.',
	'CLOUD_MODE'				=> 'Tag/Category mode',
	'CLOUD_MODE_EXPLAIN'		=> '"tags" or "cats" or "both"',
	'CLOUD_WMODE'				=> 'WMode (Display Mode)',
	'CLOUD_WMODE_EXPLAIN'		=> 'Background transparency.',
	'CLOUD_DISTR'				=> 'Tag distributions',
	'CLOUD_DISTR_EXPLAIN'		=> 'Check for even tag distributions along sphere.',

	'TEAMSPEAK_SETTINGS'		=> 'Teanspeak Config',
	'TEAMSPEAK_PASS'			=> 'Password',
	'TEAMSPEAK_CONNECT'			=> 'Connection',

	'CLOUD_SEARCH'				=> 'Cloud Search Block',
	'CLOUD_SEARCH_ALLOW'		=> 'Show Cloud Search Block',
	'CLOUD_SEARCH_CACHE'			=> 'Cache time for this block',
	'CLOUD_SEARCH_CACHE_EXPLAIN'	=> ' (cache time in seconds).',

));

// Mini Mod vars
$lang = array_merge($lang, array(
	'MINI_MOD_DEVELOPMENT'			=> 'Mini Modules Development, display options',

	'MINI_MOD_STYLE_COUNT'			=> 'The number of styles to include in this block',
	'MINI_MOD_STYLE_COUNT_EXPLAIN'	=> '',

	'MINI_MOD_BLOCK_COUNT'			=> 'The number of blocks to include in this block',
	'MINI_MOD_BLOCK_COUNT_EXPLAIN'	=> '',

	'MINI_MOD_MOD_COUNT'			=> 'The number of mods to display in this block',
	'MINI_MOD_MOD_COUNT_EXPLAIN'	=> '',
));

// SGP Quick Reply vars 11 February 2010
$lang = array_merge($lang, array(
	'SGP_QR_SETTINGS'	=> 'SGP Quick Reply Settings',
	'SGP_QR'			=> 'Use SGP quick reply',
	'SGP_QR_EXPLAIN'	=> 'Replace the default quick reply with the portal version',
));

?>