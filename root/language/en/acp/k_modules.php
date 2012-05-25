<?php
/** 
*
* acp_k_modules [English] (Additional variables used by portal)
*
* @package {k_modules.php}
* @version $Id: k_modules.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
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
// phpbbportal profile fields
$lang = array_merge($lang, array(
	
	'TITLE' => 'Additional Data',
	'TITLE_EXPLAIN' => '<b>Mini-Mods Manager:</b><br />These are small mods used to display and manage additional information, a good example being the Welcome Message minimod. Default mini-mods include, Block, Mods and Styles...',


	'AUTHOR'						=> 'Author',
	'AUTHOR_EXPLAIN'				=> 'The name of the block/mod/style creator.',
	//'AUTHOR_EXPLAIN'				=> 'The original authors name, or whoever currently supports this block/mod/style.',

	'AUTHOR_CO'						=> 'Ported by / Co-author',
	'AUTHOR_CO_EXPLAIN'				=> 'This will differ depending on mod type.',

	'AUTHOR_LINK'					=> 'Authors Link',
	'AUTHOR_LINK_EXPLAIN'			=> 'Normally the original block/mod/style download link.',

	'AUTHOR_LINK_2'					=> 'Support Link',
	'AUTHOR_LINK_2_EXPLAIN'			=> 'Link to support Site.',

	'MOD_FILENAME'					=> 'Filename (<strong>no extension</strong>)',
	'MOD_FILENAME_EXPLAIN'			=> 'No spaces allowed in filename (used for downloading).',

	'AVAILABLE_STYLES'				=> 'Available Styles.',
	'AVAILABLE_STYLES_EXPLAIN'		=> 'Select the style you wish to update...',

	'AVAILABLE_TYPES'				=> 'Minimod Category',
	'AVAILABLE_TYPES_EXPLAIN'		=> 'Select a Minimod category, or use the next field to create a new category.',
	'NEW_TYPE'						=> 'New category name',
	'NEW_TYPE_EXPLAIN'				=> 'Categories are use to group minimod data.',


	'BMS_NAME'						=> 'Name',
	'BMS_NAME_EXPLAIN'				=> 'The name of the MiniMod.',
	'CONFIRM_OPERATION_MODULE'		=> 'Do you wish to delete this module block?',
	'COPYRIGHT'						=> 'Copyright',
	'COPYRIGHT_EXPLAIN'				=> 'Copyright information provide by the author.',
	'DELETE'						=> 'Delete',
	'DELETE_EXPLAIN'				=> 'Delete this module',
	'DOWNLOADED'					=> 'Downloaded count',
	'DOWNLOADED_EXPLAIN'			=> 'Automatically incremented on download clicks.',
	'EDIT' 							=> 'Edit',
	'EDIT_EXPLAIN'					=> 'Edit the module',
	'ID'							=> 'ID',
	'ID_EXPLAIN'					=> 'The ID for the module (automatically assigned).',
	'IMAGE'							=> 'Thumbnail/Image for this minimodule',
	'IMAGE_EXPLAIN' 				=> 'Required for Welcome Message (path set in template), also used in styles development.',

	'INFO' 							=> 'Information',
	'INFO_EXPLAIN'					=> 'Some information to display',
	'INFO_1_EXPLAIN'  				=> 'The information you wish to display.',
	'INFO_2_EXPLAIN'  				=> '(text/html code).',
	'LAST_UPDATED_EXPLAIN'			=> 'Example: Sun 12 Dec 2007, if left blank, todays date will be used.',
	'LINK'							=> 'Link',
	'LINK_EXPLAIN'					=> 'Link to development site.',
	'MODULES_TYPE'					=> 'Adding a New portal mini module',
	'MOD_HEADER_ADMIN'				=> 'Manage Portal Mini Mods ',
	'MOD_NAME'						=> 'Mod Name',
	'MOD_ORIGIN'					=> 'Origin',
	'MOD_ORIGIN_EXPLAIN'			=> 'SGP team/members minimod/style/block?',
	'MOD_TYPE'						=> 'Mod Type',
	'MOD_INFO'						=> 'Mod Details',
	'MUST_SELECT_VALID_MODULE_DATA' => 'Invalid K_Module ID.',	
	'NAME_EXPLAIN'					=> 'The mini module name.',	
	'UNIQUE'						=> 'Unique',
	'SELECT_EDIT_TO_VIEW'			=> '<span style="font-style:italic">Select edit to view this code...</span>',
	'STATUS'						=> 'Status (% complete)',
	'STATUS_EXPLAIN'				=> 'Enter 1 to 100, or 0 to disable processing for this mod.',
	'TYPE'							=> 'Mini Mod Type',
	'TYPE_EXPLAIN'					=> 'block/mod/style (you can add you own types too).',
	'WELCOME_MESSAGE_EDITOR'		=> 'Welcome message editor',
	'WELCOME'						=> 'Welcome Message',
	'WELCOME_EXPLAIN'				=> 'The welcome message module can not be deleted...',
	'ACTIVE_STYLES'					=> 'Available style',
	'ACTIVE_STYLES_EXPLAIN'			=> 'List of styles not currently added.',
	'ID_TO_USE'						=> 'Link to ID',
	'ID_TO_USE_EXPLAIN'				=> 'If applicable, this ID is automatically assigned.',
	'MOD_VERSION'					=> 'Version',
	'MOD_VERSION_EXPLAIN'			=> 'The revision number of the mod/mini-mod',
	'EDIT_WELCOME_MESSAGE'			=> 'Edit Welcome Message',
	'MODULE_BLOCK_DELETED'			=> 'Module block deleted',

	
	'MODULES_BLOCK_ADDED'			=> 'Modules block added',
	'DO_NOT_CHANGE'					=> '<br />Default type, not eidtable',
	'CANT_DELETE'					=> 'You can\'t delete the welcome message',
	'WELCOME'						=> 'welcome',
	'NO_NAME_NO_TYPE'				=> 'Missing module name or type...',

));

?>