<?php
/** 
*
* acp_k_web_pages [English] (Additional variables used by portal)
*
* @package language
* @version $Id: k_web_pages.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
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
	
	'TITLE' => 'Manage Portal Web Pages',
	'TITLE_EXPLAIN' => '<b>Small Modules Manager (Web Page Mod):</b><br />
	These are small mods used to display and manage additional information used by the portal... a good example being the <strong>Welcome Message Mod</strong>...<br />
	You can add your own types for such things as Styles, Blocks or Mods... Examine the Welcome Block to see what data can be saved...<br />Future versions will allow creating of additional database storage elements.',

	'ID'				=> 'ID',
	'ACTIVE'			=> 'Active',
	'ACTIVE_EXPLAIN'	=> 'You can disable/enable this web page.',
	'WEB_PAGE_ADD'		=> 'Add a web page...',
	'WEB_PAGE_ADD_'		=> 'Select the type of page...',
	'WEB_PAGE_NAME'		=> 'Page Name',
	'WEB_PAGE_TYPE'		=> 'Page Type',
	'WEB_PAGE_HEAD'		=> 'Head',
	'WEB_PAGE_BODY'		=> 'HTML body',
	'WEB_PAGE_FOOT'		=> 'Foot',

	'WEB_PAGE_TYPE_EXPLAIN'	=> 'This Web Page is a header/body/footer ?',

	'HEAD' => 'Page Header',
	'BODY' => 'Page Body',
	'FOOT' => 'Page Footer',
	'PORTAL_PAGE'	=> 'Portal Page',

	'LINK'				=> 'Link',
	'IMAGE'				=> 'Image',
	'LAST_UPDATED'				=> 'Last Updated',
	'LAST_UPDATED_EXPLAIN'		=> 'If blank todays date will be assigned.',
	'WEB_PAGES_HEADER_ADMIN'	=> 'Manage Portal Web Pages',
	'PAGES' => ' web pages',

	'WEB_PAGE_HEAD_EXPLAIN'		=> 'The header page to use.',
	'WEB_PAGE_FOOT_EXPLAIN'		=> 'The footer page to use.',


	'ID_EXPLAIN'				=> 'The ID for the web page (automatically assigned).',
	'WEB_PAGE_NAME_EXPLAIN'		=> 'These are common types.',
	'WEB_PAGE_BODY_EXPLAIN'		=> 'The html code for the header/body/footer/portal. ',



	'IMAGE_EXPLAIN' 		=> 'Module image if any...<br />Required for Welcome Message (path set in template).',
	'LAST_UPDATE_EXPLAIN'	=> 'Last Updated... example: Sun 12 Dec 2007(see note)<br />Note: If blank, todays date will be used',	
	'EDIT' 					=> 'Edit',
	'EDIT_EXPLAIN'			=> 'Edit the module',
	'DELETE'				=> 'Delete',
	'DELETE_EXPLAIN'		=> 'Delete this module',
	
	'MUST_SELECT_VALID_MODULE_DATA' => 'Invalid K_Module ID.',	
	'CONFIRM_OPERATION_MODULE'		=> 'Do you wish to delete this module block?',
	'AVAILABLE_STYLES'				=> 'Available Styles.',
	'AVAILABLE_STYLES_EXPLAIN'		=> 'Select the style you wish to update...',

	'AUTHOR_1'						=> 'Author',
	'AUTHOR_1_EXPLAIN'				=> 'Original Author',
	'AUTHOR_LINK_1'					=> 'Authors Link',
	'AUTHOR_LINK_1_EXPLAIN'			=> 'Link to module site.',

	'WEB_PAGES_TYPE'			=> 'Adding a New portal mini module',
	'NEW_TYPE'					=> 'Add a new type',
	'NEW_TYPE_EXPLAIN'			=> 'The name of the new module type.',
	'MOD_HEADER_ADMIN'			=> 'Manage Portal Mini Mods ',
	'MOD_NAME' => 'Mod Name',
	'MOD_TYPE' => 'Mod Type',
	'MOD_INFO' => 'Mod Details',
	'SELECT_EDIT_TO_VIEW'	=> '<span style="font-style:italic">Select edit to view this code...</span>',
	'LAST_UPDATED'	=> 'Last Updated',
	'EXTERNAL_FILE'					=> 'External file',
	'EXTERNAL_FILE_EXPLAIN'			=> 'You can use an external file in place of database stored html code (this is of future development).',
));

?>