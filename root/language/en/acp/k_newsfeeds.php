<?php
/**
*
* @author Original Author Michael O'Toole@www.stargate-portal.com
*
* @package {k_newsfeeds.php}
* @version $Id:$ 3.2.0
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
* @copyright (c) 2005 phpbireland
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
// � � � � �
//

$lang = array_merge($lang, array(
	'TITLE' 					=> 'lastRSS configuration &amp; management',
	'TITLE_EXPLAIN'				=> 'Here you can configure basic behavior of lastRSS &amp; manage RSS feeds',

	'K_FEED_EDIT_HEADER'		=> 'Adding or editing a feed',
	'ACP_MANAGE_FEED'			=> 'Add or edit feed(s)',
	'ACP_FEED_EXPLAIN'			=> 'Feed(s) management',
	'ADD_FEED'					=> 'ADD new feed',
	'DISABLE'					=> '<b>Block enabled</b>',
	'DISABLE_BLOCK'				=> 'Enable',
	'ENABLE'					=> '<b>Block disabled</b>',
	'ENABLE_BLOCK'				=> 'Disable',
	'MUST_SELECT_FEED'			=> 'Selected mod',
	'FEED'						=> 'Feed\'s in database',
	'VISIT_FEED'				=> 'Subscribe to feed',
	'FEED_INFO'					=> 'Feed',
	'FEED_EXPLAIN'				=> 'Text of your Feed goes inhere',
	'FEED_DESCRIPTION'			=> 'Show Feed Description Yes/No?',
	'FEED_ADDED'				=> 'Feed successfully added',
	'FEED_REMOVED'				=> 'Feed successfully removed',
	'FEED_UPDATED'				=> 'Feed successfully edited',
	'RESET_FEED' 				=> 'Reset',
	'FEED_EDIT'					=> 'Edit Feed\'s',
	'FEED_EDIT_EXPLAIN'			=> 'Here you can add or edit an existing Feed entry. The Title and version number are required. You will also be able to enter details of where the Feed can be downloaded from and where the Feed itself can be found.',
	'FEED_TITLE'				=> 'Feed Title',
	'FEED_TITLE_EXPLAIN'		=> 'Short but descriptive title of the Feed.',
	'FEED_SHOW'					=> 'Show feed Yes/No?',
	'FEED_URL'					=> 'URL address of RSS feed',
	'FEED_URL_EXPLAIN'			=> 'Input full URL address, starting with http://...',
	'FEED_POSITIONS'			=> 'Position',
	'FEED_POSITION'				=> 'Show this feed on which position?',
	'FEED_POSITION_EXPLAIN'		=> 'Specify on which side of the RSS block this entry will appear.',
	'LEFT'						=> 'Left',
	'RIGHT'						=> 'Right',
	'NOT_SET'					=> 'Not set',
	'FEED_CACHE_TIME'			=> 'How long time to cache data?',
	'FEED_CACHE_TIME_EXPLAIN'	=> 'Maximum age of the cache file for a feed before it is updated, in seconds (default is 1 hour = 60 minutes = 3600 seconds).',
	'CACHE_TIME'				=> 'seconds',
	'FEED_ITEMS_LIMIT'			=> 'Items limit',
	'FEED_ITEMS_LIMIT_EXPLAIN'	=> 'Max Number of shown news from one RSS feed',
	'ITEMS_LIMIT'				=> 'rows',
	'FEED_RANDOM_LIMIT'			=> 'Random limit',
	'FEED_RANDOM_LIMIT_EXPLAIN'	=> 'Maximum feeds to randomize in the block.',
	'RANDOM_LIMIT'				=> 'feeds',
	'BLOCK_FEED_SETTINGS'		=> 'General feeds settings',
	'FEED_TYPE' 				=> 'For downloading RSS use function',
	'FEED_TYPE_EXPLAIN' 		=> '(FOPEN or CURL is not enabled on every server)',
	'FEED_CURL' 				=> 'CURL',
	'FEED_FOPEN' 				=> 'FOPEN',
	'RSS_ENABLE'				=> 'Enabled',
	'RSS_DISABLE'				=> 'Disabled',
	'RSS_ENABLED'				=> 'RSS',
	'RSS_ENABLED_EXPLAIN'		=> 'Enable/Disable RSS on your site.',
	'FEED_ENDIS'				=> 'Status',

));

?>