<?php
/**
*
* acp_portal_config [English]
*
* @package language
* @version $Id: k_config.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
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

	'PORTAL' 			=> 'Portal',
	'TITLE' 			=> 'Portal default configuration',
	'TITLE_EXPLAIN'		=> 'Here you can set the portal block default. Items marked with <strong>*</strong> are under construction or for future development.',

	'PORTAL_MAIN'			=> 'Main Block/Portal Configuration',

	'PORTAL_BLOCKS_WIDTH' 	=> 'Block Width (Left and Right Blocks)',
	'PORTAL_BLOCKS_ENABLED' => 'Block Enabled',

	'PORTAL_SCROLL_RECENT'	=> 'Allow Scrolling',
	'PORTAL_SCROLL_LINKS'	=> 'Scroll Links',



	'BLOCKS_UPDATED'		=> 'Portal info updated',
	'BLOCK_DEFAULT'			=> 'Default',
	'BLOCK_TWO_COLUMN'		=> 'Two Column',
	'BLOCK_THREE_COLUMN'	=> 'Three Column',
	'BLOCK_FOUR_COLUMN'		=> 'Four Column',
	'BLOCK_FIVE_COLUMN'		=> 'Five Column',
	'HEADER_MENU'			=> 'Header Menu',
	'BLOCKS_UPDATE_FILES'	=> 'Update Files',

	'PBLOCK_HEADER'			=> 'Stargate aka Kiss Portal Block Manager (Future Development!) ',
	'PBLOCK_NAME'			=> 'Block Name',
	'PBLOCK_CLASS'			=> 'Class',
	'PBLOCK_APPROVED'		=> 'Approved',
	'PBLOCK_AUTHOR'			=> 'Author',
	'PBLOCK_VERSION'		=> 'Revision',
	'PBLOCK_DATE'			=> 'Date',
	'PBLOCK_UPDATE'			=> 'Update',
	'PBLOCK_SITE'			=> 'Site',

	'BLOCKS_CONFIGURE'		=> 'Configure Portal Defaults',

	'PORTAL_VERSION'			=> 'Portal Version',
	'PORTAL_VERSION_EXPLAIN'	=> 'Version also set in phpBB config',


	'PORTAL_MAIN'			=> 'Main Block/Portal Configuration',
	'PORTAL_BLOCKS_WIDTH' 	=> 'Left and Right Block Width',

	'PORTAL_CONFIG_UPDATED' => 'Portal config updated!... ',

	'PORTAL_BLOCKS_ENABLED'	=> 'Enable Block',

	'PORTAL_BLOCKS_LEFT_ENABLED' => 'Enable Portal Blocks Left',
	'PORTAL_BLOCKS_RIGHT_ENABLED' => 'Enable Portal Blocks Right',
	'PORTAL_BLOCKS_CENTRE_ENABLED' => 'Enable Portal Blocks Centre',
	'PORTAL_SCROLL_RECENT'		=> 'Allow Recent Topics Scrolling ',
	'PORTAL_SCROLL_LINKS'		=> 'Allow Links Scrolling',


	'PORTAL_SET_LAYOUT_NEW'	=> '*Set Block Layout/Style for Welcome Page (New Optional)',
	'PORTAL_SET_LAYOUT'		=> '*Set Block Layout/Style for Site (Default Option)',
	'PORTAL_SET_LAYOUT_EXPLAIN'			=> 'Default layout Stargate aka Kiss Portal (see dropdown options).',

	'BLOCKS_UPDATED'		=> 'Portal info updated',
	'BLOCK_DEFAULT'			=> 'Default',
	'BLOCK_TWO_COLUMN'		=> 'Two Column',
	'BLOCK_THREE_COLUMN'	=> 'Three Column',
	'BLOCK_FOUR_COLUMN'		=> 'Four Column',
	'BLOCK_FIVE_COLUMN'		=> 'Five Column',
	'HEADER_MENU'			=> 'Header Menu',
	'BLOCKS_UPDATE_FILES'	=> 'Generate HTML Files',

	'BLOCKS_UPDATE_FILES_EXPLAIN'		=> 'When you have updates all your blocks you can create the html layout files here... See <b>Manage/Edit Blocks</b> for these settings',

	'PORTAL_BLOCKS_WIDTH_EXPLAIN'		=> 'Other blocks widths are proportional i.e. Centre blocks are 100% of available space, if you display two blocks in centre they will be approximately 50% each, three blocks 33% etc.',
	'PORTAL_BLOCKS_ENABLED_EXPLAIN'	=> 'Enable all blocks, note blocks can be disabled individually see: Manage/Edit All Blocks',
	'PORTAL_SET_LAYOUT_NEW_EXPLAIN'	=> 'New layout for News/Welcome page',


	'BLOCKS_UPDATE_HTML_FILES' 			=> 'Update / Create block html files',

	'BLOCKS_USE_EXTERNAL_FILES_EXPLAIN' => 'You can use external html files or auto-generated files',
	'GENERATE'		=> 'Create Block HTML Files',
	'CONFIG_SAVED'	=> 'Config data saved...',
));
?>