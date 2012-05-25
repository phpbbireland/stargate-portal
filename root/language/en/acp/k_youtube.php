<?php
/**
*
* @author Original Author Michael O'Toole@www.stargate-portal.com
*
* @package {k_youtube.php}
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
	'ACP_VIDEO'				=> 'Portal videos.',
	'ACP_VIDEO_EXPLAIN'		=> 'Here you can add, edit and delete videos.',
	'ACP_K_YOUTUBE_BROWSE' 	=> 'Browse!',

	'VIDEO_LINK'			=> 'Video Link',
	'VIDEO_LINK_EXPLAIN'	=> 'YouTube video link code.',

	'VIDEO_RATING'				=> 'Rating',
	'VIDEO_RATING_EXPLAIN'		=> 'Rate from 1 to 5.',
	'VIDEO_TITLE'				=> 'Title',
	'VIDEO_TITLE_EXPLAIN'		=> 'The title of the video.',
	'VIDEO_WHO'					=> 'Artist',
	'VIDEO_WHO_EXPLAIN'			=> 'Artist or details of the performers.',
	'VIDEO_CATEGORY'			=> 'Category',
	'VIDEO_CATEGORY_EXPLAIN'	=> 'Select from existing category or add new.',
	'CONFIRM_OPERATION_YOUTUBE'	=> 'Delete: %s',

	'VIDEO_MOVIE'			=> 'YouTube Movie',
	'VIDEO_MOVIE_RXPLAIN'	=> 'Each YouTube can have its own movie',

	'ADD_VIDEO'				=> 'Add a video',
	'EDIT_VIDEO'			=> 'Editing video',
	'CONFIG_VIDEO'			=> 'Config video defaults',

	'ID'					=> 'ID',
	'CONFIRM_OPERATION_VIDEO' => 'Delete this video?',
	'SWITCHING'				=> 'Switching to k_config',

	'VIDEO_COMMENT'			=> 'Comments', 
	'VIDEO_CREATED'			=> 'Video created...',
	'UTUBE_SAMPLE_DATA'		=> 'I have included some sample data, just edit to suit...',

));

?>