<?php
/**
*
* k_quick_posting [English]
*
* @package language
* @version $Id: k_quick_posting.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
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
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'FLASH_IS_OFF'	=> '[flash] is <em>OFF</em>',
	'FLASH_IS_ON'	=> '[flash] is <em>ON</em>',
	'FLOOD_ERROR'	=> 'You cannot make another post so soon after your last.',
	'FONT_COLOR'	=> 'Font color',
	'FONT_HUGE'		=> 'Huge',
	'FONT_LARGE'	=> 'Large',
	'FONT_NORMAL'	=> 'Normal',
	'FONT_SIZE'		=> 'Font size',
	'FONT_SMALL'	=> 'Small',
	'FONT_TINY'		=> 'Tiny',
	'MORE_SMILIES'	=> 'View more smilies',
	'SMILIES'		=> 'Smilies',
	
));

?>