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
	
	'TITLE'	=> 'Manage Portal Web Pages',

	'TITLE_EXPLAIN' => '<b>Small Modules Manager (Web Page Mod):</b>
	<br />These are small mods used to display and manage additional information used by the portal... a good example being the <strong>Welcome Message Mod</strong> minimod... You can add your own types for such things as Styles, Blocks or Mods...
	<br />Items marked with * are mandatory.<br />',

	'TITLE_EXPLAIN_MORE'	=> '<br />To access new pages you need to add a link to the one of the portals menus: web_page.php?mode=%1$s (see Sub Menu for more examples)...',

	'ID'				=> 'ID',
	'ACTIVE'			=> 'Active',
	'ACTIVE_EXPLAIN'	=> 'You can disable/enable this web page.',
	'DISABLED'			=> 'Disabled',
	'WEB_PAGE_ADD'		=> 'Add a web page...',
	'WEB_PAGE_ADD_'		=> 'Select the type of page...',

	'PAGE_NAME'					=> '<i>page name</i>',
	'WEB_PAGE_NAME'				=> 'Page name',
	'WEB_PAGE_NAME_EXPLAIN1'	=> 'Do not enter an extension.',
	'WEB_PAGE_NAME_EXPLAIN2'	=> 'If this page uses an associated file, we append .html to this entry.',

	'WEB_PAGE_TYPE'			=> '*Page type',

	'WEB_PAGE_HEAD'		=> 'Head ID',
	'WEB_PAGE_BODY'		=> 'HTML body',
	'WEB_PAGE_FOOT'		=> 'Foot ID',
	'WEB_PAGE_HEAD_EXPLAIN'		=> 'Select a header to use with this page.',
	'WEB_PAGE_FOOT_EXPLAIN'		=> 'Select a footer to use with this page.',


	'WEB_PAGE_TYPE_EXPLAIN'	=> 'Select the type of page to create.',

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

	'ID_EXPLAIN'				=> 'The ID for the web page (automatically assigned).',

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
	'SELECT_EDIT_TO_VIEW'	=> '<span style="font-style:italic">Edit to view this code</span>',
	'LAST_UPDATED'	=> 'Last Updated',
	'EXTERNAL_FILE'					=> 'External file',
	'EXTERNAL_FILE_EXPLAIN'			=> 'You can use an external file for this body, else enter the html code for the body below (future development).',

	'PAGE_EXTN'				=> 'Remove extension',
	'PAGE_EXTN_EXPLAIN'		=> 'By default pages use the html extension but it is not required.',
	'PAGE_DESC'				=> 'Description for this page',
	'PAGE_DESC_EXPLAIN'		=> 'Description appears in web browser?',
	'PAGE_META'				=> 'Meta data (Keywords)',
	'PAGE_META_EXPLAIN'		=> 'Add Keywords that match the content of the page (grab from code above). Max size 255 characters.',

	'WEB_PAGE_DESC'				=> 'Page description',
	'WEB_PAGE_TITLE'			=> 'Page title',
	'WEB_PAGE_TITLE_EXPLAIN'	=> 'Page title Helter?',

	'HEADER'	=> 'Header',
	'FOOTER'	=> 'Footer',
	'WRAPPER'	=> 'Wrapper',

	'PAGE_TYPE_FILE'	=> 'File',

));

?>