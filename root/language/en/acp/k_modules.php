<?php
/** 
*
* acp_k_modules [English] (Additional variables used by portal)
*
* @package language
* @version $Id: k_modules.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
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

// phpbbportal profile fields
$lang = array_merge($lang, array(
	
	'TITLE' => 'Additional Data',
	'TITLE_EXPLAIN' => '<b>Mini-Mods Manager:</b><br />These are small mods used to display and manage additional information, a good example being the Welcome Message. Default mini-mods include, Block, Mods and Styles...',


	'AUTHOR'						=> 'Author',
	'AUTHOR_EXPLAIN'				=> 'The name of the block/mod/style creator.',
	//'AUTHOR_EXPLAIN'				=> 'The original authors name, or whoever currently supports this block/mod/style.',

	'AUTHOR_CO'						=> 'Ported by / Co-author',
	'AUTHOR_CO_EXPLAIN'				=> 'This will differ depending on mod type.',

	'AUTHOR_LINK'					=> 'Authors Link',
	'AUTHOR_LINK_EXPLAIN'			=> 'Normally the original block/mod/style download link.',
	'AUTHOR_LINK_2'					=> 'Alternate Link',
	'AUTHOR_LINK_2_EXPLAIN'			=> 'Link to Stargate Portal version.',

	'AVAILABLE_STYLES'				=> 'Available Styles.',
	'AVAILABLE_STYLES_EXPLAIN'		=> 'Select the style you wish to update...',
	'AVAILABLE_TYPES'				=> 'The type of Mini-Mod to add',
	'AVAILABLE_TYPES_EXPLAIN'		=> 'Select from one of the existing MiniMod types or add a new type below.',
	'BMS_NAME'						=> 'Name',
	'BMS_NAME_EXPLAIN'				=> 'The name of the Block, Mod/Mini-mod or Style.',
	'CONFIRM_OPERATION_MODULE'		=> 'Do you wish to delete this module block?',
	'COPYRIGHT'						=> 'Copyright',
	'COPYRIGHT_EXPLAIN'				=> 'Copyright information provide by the author.',
	'DELETE'						=> 'Delete',
	'DELETE_EXPLAIN'				=> 'Delete this module',
	'DOWNLOADED'					=> 'Downloaded count',
	'DOWNLOADED_EXPLAIN'			=> 'The download count will be displayed here.',
	'EDIT' 							=> 'Edit',
	'EDIT_EXPLAIN'					=> 'Edit the module',
	'ID'							=> 'ID',
	'ID_EXPLAIN'					=> 'The ID for the module (automatically assigned).',
	'IMAGE'							=> 'Image or style test link (portal.php?style=styel id)',
	'IMAGE_EXPLAIN' 				=> 'Block/Module/Style image...<br />Required for Welcome Message (path set in template), also used in future development.',

	'INFO' 							=> 'Information',
	'INFO_EXPLAIN'  				=> 'Information you wish to display, this may be simple comment or as in the case of the Welcome Message and Web Pages it will be the HTML code.',
	'LAST_UPDATED_EXPLAIN'			=> 'Example: Sun 12 Dec 2007, if left blank, todays date will be used',
	'LINK'							=> 'Link',
	'LINK_EXPLAIN'					=> 'Link to development site.',
	'MODULES_TYPE'					=> 'Adding a New portal mini module',
	'NEW_TYPE'						=> 'Create a new Mini-Mod type',
	'NEW_TYPE_EXPLAIN'				=> 'Leave blank if type selected from dropdown box above.',
	'MOD_HEADER_ADMIN'				=> 'Manage Portal Mini Mods ',
	'MOD_NAME'						=> 'Mod Name',
	'MOD_ORIGIN'					=> 'Origin',
	'MOD_ORIGIN_EXPLAIN'			=> 'Yes = links are internal. No = Links are external.',
	'MOD_TYPE'						=> 'Mod Type',
	'MOD_INFO'						=> 'Mod Details',
	'MUST_SELECT_VALID_MODULE_DATA' => 'Invalid K_Module ID.',	
	'NAME_EXPLAIN'					=> 'The mini module name.',	
	'UNIQUE'						=> 'Unique',
	'SELECT_EDIT_TO_VIEW'			=> '<span style="font-style:italic">Select edit to view this code...</span>',
	'STATUS'						=>	'Status (% complete)',
	'STATUS_EXPLAIN'				=>	'Percentage complete... 1 - 100',
	'TYPE'							=> 'Mini Mod Type',
	'TYPE_EXPLAIN'					=> 'Block/Mod/Style (you can add you own types too).',
	'WELCOME_MESSAGE_EDITOR'		=> 'Welcome message editor',
	'WELCOME'						=> 'Welcome Message',
	'WELCOME_EXPLAIN'				=> 'The welcome message module can not be deleted...',
	'ACTIVE_STYLES'					=> 'Available style',
	'ACTIVE_STYLES_EXPLAIN'			=> 'List of styles not currently added.',
	'ID_TO_USE'						=> 'Link to ID',
	'ID_TO_USE_EXPLAIN'				=> 'The ID of the Block, Mod or Style (Reference only).',
	'MOD_VERSION'					=> 'Version',
	'MOD_VERSION_EXPLAIN'			=> 'The revision number of the mod/mini-mod',
));

?>