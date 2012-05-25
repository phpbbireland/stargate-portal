<?php
/**
*
* @author Original Author Michael O'Toole@www.stargate-portal.com
*
* @package {k_poll.php}
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
	'TITLE' 					=> 'Poll configuration &amp; management',
	'TITLE_EXPLAIN'				=> 'Here you can configure &amp manage your poll settings.',
 	'BLOCK_POLL_SETTINGS'		=> 'General poll settings',
	'POLL_TOPIC_ID'				=> 'Topic ID to display Poll from.',
	'POLL_TOPIC_ID_EXPLAIN'		=> 'The topic ID that contain the poll you want to display, 0 = pull nothing (do not leave empty!).',
	'POLL_FORUM_ID'				=> 'Forum ID to display Poll from.',
	'POLL_FORUM_ID_EXPLAIN'		=> 'The forum ID that contain the poll you want to display, 0 = pull nothing (do not leave empty!).',
  	'POLL_POST_ID'				=> 'Post ID to display Poll from.',
	'POLL_POST_ID_EXPLAIN'		=> 'The post ID that contain the poll you want to display, 0 = pull nothing (do not leave empty!).',
	'ACP_POLL_EXPLAIN'			=> 'Poll management',
	'POLL'						=> 'Poll\'s in database',
	'POLL_INFO'					=> 'Poll',
	'POLL_UPDATED'				=> 'Poll successfully edited',
	'POLL_EDIT'					=> 'Edit Poll',
	'POLL_VIEW'					=> 'Poll view (simple/detailed)',
	'POLL_VIEW_EXPLAIN'			=> 'How to view poll in block',
	'POLL_SIMPLE'				=> 'Simple Display',
	'POLL_DETAILED'				=> 'Detailed Display',
	'POLL_LEFT'					=> 'Left Block',
	'POLL_RIGHT'				=> 'Right Block',
	'POLL_CENTRE'				=> 'Centre Block',
	'POLL_NOTE'					=> 'NOTE! If you give Post ID a value, Topic ID MUST be 0 &amp vice versa',
	'NOT_SET'					=> 'Not set',

));

?>