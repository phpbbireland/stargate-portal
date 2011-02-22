<?php
/**
*
* portal [English]
*
* @package language
* @version $Id: portal.php,v 1.151 29 March 2007
* @copyright (c) 2005 phpbbireland
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ”
//

//- stargate aka kiss portal lang definitions -//
$lang = array_merge($lang, array(
	'ACP_MINI'			=> 'Admin',
	'ACP_SMALL'			=> 'ACP',
	'ADVANCED_SEARCH'	=> 'Advanced Search',
	'AUTO_LOGIN'		=> 'Auto Login',
	'BOOKMARKS'			=> 'Bookmarks',
	'CHAT_LINK'			=> 'Online Chat',
	'COMMENTS'			=> 'Comments',
	'COPY_RIGHT_BOTTOM' => 'Support Site & Affiliates',
	'CURRENT_STYLE'		=> 'Current Style Information',
	'FORUM_PORTAL'		=> 'Portal',
	'HOME'				=> 'Home',
	'INDEX_OF_FORUMS'	=> 'Index of forums',
	'ICON_ANNOUNCEMENT'	=> 'Announcement',
	'ICONS_EXPLAIN'         => 'Icons explain',
	'FORUM_IMAGES_EXPLAIN'  => 'Forum Icons',
	'POST_IMAGES_EXPLAIN'   => 'Post Icons',
	'LOG_ME_IN_SHORT'   => 'Remember Login',

	'MERITS'            => 'Merits',
	'MEMBER_INFO'		=> 'Members Info',
	'MEMBERS'			=> 'Members',

	'NO_NEWS'           => 'No News Today',
	'NO_MODS'			=> 'No mods assigned.',
	'NO_ADMINS'			=> 'No admins assigned.',
	'ONLINE_USERS'		=> 'Online Users',
	'ONLINE_USERS_SHOW' => '[ View Online List ]',
	'PORTAL'			=> 'Portal',
	'PICTURES'			=> 'Pictures',
	'POSTED_BY'			=> 'Posted by',
	'POST_COMMENTS'		=> 'Post Comments',
	'PORTAL_DEVELOPMENT'=> 'Portal Development',
	'PHP_SUPPORT_SITES' => 'php Support Sites',
	'POSTER'			=> 'Poster',
	'POST_IMG'			=> 'Post',
	'POST_NEW_IMG'		=> 'Post New',
	'POST_NEW_HOT_IMG'	=> 'Post New Hot',
	'POST_LOCKED_IMG'	=> 'Post Locked',
	'POST_REPLY' 		=> 'Post a reply',
	'PRINT_IT'			=> 'Print it',
	'PROFILE_SMALL'		=> 'UCP',
	'POST_ANNOUNCEMENT_NEW'	=> 'New Announcement',
	'POST_ANNOUNCEMENT'		=> 'Announcement',
	'READ_ARTICLE'	=> 'Read Full Article',
	'RECENT_TOPICS'	=> 'Recent Topics',
	'SEARCH_OPTION'	=> 'Search Option',
	'SITE_SURVEY'	=> 'Site Survey',
	'SITE_NAME'		=> 'phpbbireland',
	'SUBMITTED_BY'	=> 'Submitted By',
	'QUICK_STATISTICS'	=> 'Site Statistics',

	'STYLE_SELECT_ALLOW' => 'Allow style change',

	'SUBMIT_LINK'	=> 'Submit Link',
	'THEME_NEWS_UPDATES'	=> 'Theme News & Updates',
	'THE_COLLECTIVE'		=> 'The collective',

	//'TO_DAY'		=> 'Date: %s',
	//'TOPIC_MOVED'	=> 'Post Moved',
	//'TIME'			=> 'Time',
	'TIMEX'			=> 'Time %s',

	'USER_COUNTRY_FLAG'			=> 'Country Flag',
	'UCF_MOD'					=> 'A valid location is required for this Mod',
	'USER_COUNTRY_FLAG_EXPLAIN'	=> 'Full mod requires <strong>Location</strong> data above (Google Map).',

	'USER_REAL_NAME'			=> 'Real Name',
	'USER_REAL_NAME_EXPLAIN'	=> 'Users first name',

	'VIEW_COMMENTS'			=> 'View Comments',
	'VIEW_FULL_ARTICLE'		=> 'Read full article',
	'UPDATING'				=> 'Processing...',
	'UCP_SMALL'				=> 'UCP',
	'VIEW_PREVIOUS_MONTH'	=> 'View previous month',
	'VIEW_NEXT_MONTH'		=> 'View next month',

	'SITE_LINK_TXT_EXPLAIN'	=> 'The HTML code below contain all the necessary code to link to <strong>%s</strong> please feel free to add it to your site.<br /><br />',
	'SITE_LINK_TXT_EXPLAIN2' => 'This code produces:',
	'GOTO_TOP_IMG' => 'Goto Top',
	'GOTO_BOTTOM_IMG' => 'Goto Bottom',
	'BOOKMARK_ON' => 'Bookmark Post',
	'BOOKMARK_OFF' => 'Remove Bookmark',

	'L_CLOCK'    => 'Local Time',
	'BASIC_RULES' => 'Basic Rules',

	'POLL_BLOCK' => 'Poll Block',

	//'SELECT_STYLE_EXPLAINED' => '<strong>Colour Legend</strong><hr /><span class="green"><strong>Green</strong></span> = Released<br /><span class="orange"><strong>Orange</strong></span> = Beta style<br /><span class="gray"><strong>Gray</strong></span> = Pre-beta style<br /><span class="red"><strong>Red</strong></span> = Alpha style<hr />',
	'SELECT_STYLE_EXPLAINED' => '<br /><strong>Dropdown Legend</strong><br />
	<span class="green"><strong>Released</strong></span><br />
	<span class="orange"><strong>RC Style</strong></span><br />
	<span class="gray"><strong>Beta Style</strong></span><br />
	<span class="red"><strong>Alpha Style</strong></span><hr>',
	'SMILIES' => 'Smilies',

	'OPTION'	=> 'Option',
	'PERMANENT'	=> 'Save my choice:',
	'MAKE_PERMANENT'	=> 'If check, the style chosen will be set as your default style!',

	'NO_SEARCHS'			=> 'No words found.',
	'MESSAGE_BODY_EXPLAIN'	=> 'Type your message here...',

	'BBCODE_A_HELP'				=> 'Inline uploaded attachment: [attachment=]filename.ext[/attachment]',
	'BBCODE_B_HELP'				=> 'Bold text: [b]text[/b]',
	'BBCODE_C_HELP'				=> 'Code display: [code]code[/code]',
	'BBCODE_E_HELP'				=> 'List: Add list element',
	'BBCODE_F_HELP'				=> 'Font size: [size=x-small]small text[/size]',
	'BBCODE_IS_OFF'				=> '%sBBCode%s is <em>OFF</em>',
	'BBCODE_IS_ON'				=> '%sBBCode%s is <em>ON</em>',
	'BBCODE_I_HELP'				=> 'Italic text: [i]text[/i]',
	'BBCODE_L_HELP'				=> 'List: [list]text[/list]',
	'BBCODE_LISTITEM_HELP'		=> 'List item: [*]text[/*]',
	'BBCODE_O_HELP'				=> 'Ordered list: [list=]text[/list]',
	'BBCODE_P_HELP'				=> 'Insert image: [img]http://image_url[/img]',
	'BBCODE_Q_HELP'				=> 'Quote text: [quote]text[/quote]',
	'BBCODE_S_HELP'				=> 'Font color: [color=red]text[/color]  Tip: you can also use color=#FF0000',
	'BBCODE_U_HELP'				=> 'Underline text: [u]text[/u]',
	'BBCODE_W_HELP'				=> 'Insert URL: [url]http://url[/url] or [url=http://url]URL text[/url]',
	'BBCODE_D_HELP'				=> 'Flash: [flash=width,height]http://url[/flash]',

	'FLASH_IS_OFF'				=> '[flash] is <em>OFF</em>',
	'FLASH_IS_ON'				=> '[flash] is <em>ON</em>',
	'FLOOD_ERROR'				=> 'You cannot make another post so soon after your last.',
	'FONT_COLOR'				=> 'Font color',
	'FONT_HUGE'					=> 'Huge',
	'FONT_LARGE'				=> 'Large',
	'FONT_NORMAL'				=> 'Normal',
	'FONT_SIZE'					=> 'Font size',
	'FONT_SMALL'				=> 'Small',
	'FONT_TINY'					=> 'Tiny',
	'LOG_ME_IN_SHORT'			=> 'Use Automatic Login ',
	'HIDE_ME_SHORT'				=> 'Hide me this session.',

	'COLOR_DARK_RED' => 'Dark Red',
	'COLOR_RED' => 'Red',
	'COLOR_ORANGE' => 'Orange',
	'COLOR_BROWN' => 'Brown',
	'COLOR_YELLOW' => 'Yellow',
	'COLOR_GREEN' => 'Green',
	'COLOR_OLIVE' => 'Olive',
	'COLOR_CYAN' => 'Cyan',
	'COLOR_BLUE' => 'Blue',
	'COLOR_DARK_BLUE' => 'Dark Blue',
	'COLOR_INDIGO' => 'Indigo',
	'COLOR_VIOLET' => 'Violet',
	'COLOR_WHITE' => 'White',
	'COLOR_BLACK' => 'Black',

	'URL' 			=> 'URL',
	'RETURN_INDEX'	=> '%sReturn to the portal page%s',
	'RETURN_PORTAL'	=> '%sReturn to the portal page%s',

	'UPLOAD_LINK'	=> 'Post Link',
	'FM_RADIO'		=> 'Popup FM Radio',
	'MP3_POPUP'		=> 'Popup Player',
	'NO_SEARCH'		=> 'Sorry but you are not permitted to use the search system.',
	'FORUM_RULES'	=> 'Forum Rules',
	'ON'			=> 'on',
	'ARRANGE_ON'	=> 'Arrange Blocks',
	'ARRANGE_OFF'	=> 'Save Changes',
	'SGP_TOOLS'		=> 'Stargate Tools',
	'WIDE2'			=> 'Style Width (100%)',
	'NARROW2'		=> 'Style Width (~70%)',

	'TOOLS_ON'	=> 'Portal Tools',
	'TOOLS_OFF'	=> 'Save Changes',


	'UPDATED'		=> 'Updated ',
	'NO_RECENT_TOPICS' => ' No recent topics to display',

	// NEW NEWS
	'NEWS_FLASH_LOCAL'		=> 'Local News Flash... ',
	'NEWS_FLASH_GLOBAL'		=> 'Global News Flash... ',
	'NEWS_BREAKING'			=> 'Breaking News... ',

	'SCROLLING_BLOCKS_DISABLED' => 'Scrolling blocks are disabled when arranging blocks',

	'NAME'		=> 'Name',
	'AUTHOR'	=> 'Author',
	'INFO'		=> 'Info',
	'LINK'		=> '<img scr="./images/bbcode/link.png">',
	'TOTAL_STYLES'	=> 'Total available styles',
	'STYLE_USERS'	=> 'Style used by %d user%s',
	'USED_BY'		=> '%d user%s, use%s this style',
	'USERS_STYLE'	=> 'Current Style',
	'PORTED_BY'		=> 'This style was ported by',
	'PORTED_BY'		=> 'Ported by',

	'STYLEREG'			=> 'You must be logged in to use the Styles Changer',
	'DESIGNED_BY'		=> 'Designed by',
	'EDITED'			=> 'Edited*',

	'HTTP_HOST'		=> 'Host',
	'HITS'			=> 'Hits',
	'STATUS'		=> 'Progress',
	'STATUS_2'		=> 'progress bar',
	'STYLE_SELECT_DISABLED' => 'Style Switch is Disabled',
	'NO_VIEW_USERS_R'		=> 'You are not authorized to view the online users list.',
	'NO_VIEW_USERS_A'		=> 'In order to view the online list you have to be registered and logged in.',

	'PORTAL_DEBUG_QUERIES'	=> '<div style="text-align:center; border: dotted 1px #FF0000; background-color:#E4DFD2; padding:5px;">Q = %d, C = %d, RT = %d</div>',
	'PORTAL_DEBUG_RUNTOT'	=> 'Running: %d',
	'INPROGRESS'			=> 'Under construction',
	'BOARD_DEFAULT_STYLE'	=> 'Default Style',
	'STYLE'					=> 'Style',

	'UNDER_CONSTRUCTION'	=> "<strong>The page you requested is currently under construction...</strong><br /><br />Please use the 'Back' button to return to previous page.",
	'BASIC_RULES_HEADER'	=> 'Site rules.',
	'BASIC_RULES'			=>	"While the administrators and moderators of this forum will attempt to remove or edit any generally objectionable material as quickly as possible, it is impossible to review every message. Therefore you acknowledge that all posts made to these forums express the views and opinions of the author and not the administrators, moderators or webmaster (except for posts by these people) and hence will not be held liable.<br /><br />
	You agree not to post any abusive, obscene, vulgar, slanderous, hateful, threatening, sexually-oriented or any other material that may violate any applicable laws. Doing so may lead to you being immediately and permanently banned (and your service provider being informed). The IP address of all posts is recorded to aid in enforcing these conditions. You agree that the webmaster, administrator and moderators of this forum have the right to remove, edit, move or close any topic at any time should they see fit. As a user you agree to any information you have entered above being stored in a database. While this information will not be disclosed to any third party without your consent, the webmaster, administrator and moderators cannot be held responsible for any hacking attempt that may lead to the data being compromised.<br /><br />
	This forum system uses cookies to store information on your local computer. These cookies do not contain any of the information you have entered above; they serve only to improve your viewing pleasure. The e-mail address is used for confirming your registration details and password or details of new passwords should you forget your current one. Your email address may also be used to send notification of post updates should you require notification.<br /><br />
	The Rules may change from time to time. Please check back often. Administration",

	'IN_PROGRESS'			=> 'This page is under construction',
	'LINKS_FORUM'			=> 'Submit A Link',
	'LINKS_FORUM_REQU'		=> 'Post your request here... approval required... you must create a forum for links upload!',

	'NO_ANNOUNCEMENTS'		=> 'No Announcements...',
	'NO_NEWS'				=> 'No news to report...',
	'NO_UNRESOLVED'			=> 'No bugs to report...',

	'DEV_VERSION'			=> 'Version (RC)',

	'VIDEO_COMMENTS'		=> 'Comments',
	'NO_COMMENTS'			=> 'No comments to display.',
	'IN_HOUSE_DESIGNS'		=> 'In House Designs',
	'IRC_TITLE'				=> 'Stargate Portal IRC Popup',
	'SGP_IRC_POPUP'			=> 'Stargate Portal IRC Popup',

	'UPLOAD'	=> 'Upload',
	'CURRENTLY_DISABLED'	=> 'Code is currently disable pending updates',

	'TEMPORARILY_HIDE_BLOCKS'	=> 'Temporarily Hide Blocks',

	'SHOWHIDE_GOOGLE'		=> 'Show/Hide Google translations',
	'SHOWHIDE_BABEL'		=> 'Show/Hide Babel Fish  translations',
	'SHOWHIDE_LIVE'			=> 'Show/Hide Windows live  translations',

	//Keep bots happy
	'BLOCK_BOT_TRACKER'		=> 'Stargate Portal Bot Tracker',
	'BLOCK_CALENDAR'		=> 'Stargate Portal Calendar',
	'BLOCK_CATEGORIES'		=> 'Stargate Portal Categories',
	'BLOCK_CLOCK'			=> 'Stargate Portal Clock',
	'BLOCK_CLOUD'			=> 'Stargate Portal Cloud 9',
	'BLOCK_DEV_STATUS'		=> 'Stargate Portal Development Status',
	'BLOCK_IRC'				=> 'Stargate Portal IRC',
	'BLOCK_MP3'				=> 'Stargate Portal MP3',
	'BLOCK_PORTAL_STATUS'	=> 'Stargate Portal Status',
	'BLOCK_RECENT_TOPICS'	=> 'Stargate Portal Recent Topics',
	'BLOCK_RSS_FEED'		=> 'Stargate Portal Rss Feeds',
	'BLOCK_STATS'			=> 'Stargate Portal Statistics',
	'BLOCK_TOP_POSTERS'		=> 'Stargate Portal Top Posters',
	'BLOCK_TOP_TOPICS'		=> 'Stargate Portal Top Topics',
	'BLOCK_WEB_PAGES'		=> 'Stargate Portal Web Pages',
	'BLOCK_WEB_TEAM'		=> 'Stargate Portal Web Team',

	// More BBCodes //
	'BBCODE_ST_HELP'			=> 'Strike through: [strike]text[/strike]',

));
//- stargate aka kiss portal lang definitions -//
?>