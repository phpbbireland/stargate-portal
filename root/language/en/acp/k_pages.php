<?php

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

$lang = array_merge($lang, array(
	'ACP_PAGES'				=> 'Current phpBB pages.',
	'ACP_PAGES_EXPLAIN'		=> 
	'The portal gives you the facility to display one/many blocks on a page basis.
	<br />To facilitate this action we provide a method to add additional pages form a list of valid pages in the root.
	<br />Once a page is added, it will become available in the block layout.
	<br />Note: Pages must provide necessary code to facilitate blocks (this is easy to add should you desire it)...',

	'ACP_K_PAGES_MANAGE'	=> 'Manage phpBB pages',

	'PAGE_NAME'			=> 'phpBB pages already added',
	'PAGE_NAME_EXPLAIN'	=> 'The name of the files we are allowed to use.',

	'PAGE_NEW_FILENAME'			=> 'Add this file to the list',
	'PAGE_NEW_FILENAME_EXPLAIN'	=> 'Select a new file from the dropdown and hit Submit<br /><br />This list will only includes valid pages.',

	'ADD_PAGE'				=> 'Add page',
	'CONFIG_PAGES'			=> 'Config pages',
	'ID'					=> 'ID',
	'CONFIRM_DELETE'		=> 'Delete this page for list?',
	'DELETE_FROM_LIST'		=> 'Delete this page from list',
	'SWITCHING'				=> 'Switching to k_pages',

	'ERROR_PORTAL_PAGES'	=> 'Error! deleting this page from database list',
	'MANAGE_PAGES'			=> 'Manage pages',
));

?>