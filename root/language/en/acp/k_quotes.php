<?php
/**
*
* @version $id: k_quotes.php 320 2009-01-14 05:04:26Z nexur $
* @copyright (c) 2008 phpbbireland.com
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


$lang = array_merge($lang, array(
	'QUOTE'					=> 'Quote',
	'QUOTE_EXPLAIN'			=> 'From this control panel you can add, edit, and remove quotes.',
	'ALLOW_QUOTE_EXPLAIN'	=> 'You can enable or disable this feature here.',
	'ADD_QUOTE'				=> 'Add Quote',
	'MEANING'				=> 'Enter the full meaning',
	'QUOTE_EDIT_EXPLAIN'	=> 'The quotes:',
	'QUOTE_UPDATED'			=> 'Quotes Updated...',
	'SWITCHING'				=> 'Switching to SGP var config',

));

?>