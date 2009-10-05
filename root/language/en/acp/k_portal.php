<?php
/**
*
* acp_portal [English]
*
* @package language
* @version $Id: k_portal.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
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
	'TITLE' 			=> 'Portal Information',
	'TITLE_EXPLAIN'		=> 'Extended details for installed blocks... Author, Revision, Site/Links etc.',

	'PORTAL_MAIN'			=> 'Main Block/Portal Configuration',

	'PORTAL_BLOCKS_WIDTH' 	=> 'Block Width (Left and Right Blocks)',
	//'PORTAL_BLOCKS_ENABLED' => 'Block Enabled',
	'PORTAL_BLOCKS_LEFT_ENABLED' => 'Enable Left Blocks',
	'PORTAL_BLOCKS_RIGHT_ENABLED' => 'Enable Right Blocks',
	'PORTAL_SCROLL_RECENT'	=> 'Allow Scrolling',
	'PORTAL_SCROLL_LINKS'	=> 'Scroll Links',
	'PORTAL_SET_LAYOUT_NEW'	=> '*Set Block Layout/Style for Welcome Page (New Optional)',
	'PORTAL_SET_LAYOUT'		=> '*Set Block Layout/Style for Site (Default Option)',
	'BLOCKS_UPDATED'		=> 'Portal info updated',
	'BLOCK_DEFAULT'			=> 'Default',
	'BLOCK_TWO_COLUMN'		=> 'Two Column',
	'BLOCK_THREE_COLUMN'	=> 'Three Column',
	'BLOCK_FOUR_COLUMN'		=> 'Four Column',
	'BLOCK_FIVE_COLUMN'		=> 'Five Column',
	'HEADER_MENU'			=> 'Header Menu',
	'BLOCKS_UPDATE_FILES'	=> 'Update Files',

	'PBLOCK_HEADER'			=> 'Stargate (aka Kiss) Portal Block Manager (Future Development!) ',
	'PBLOCK_NAME'			=> 'Block Name',
	'PBLOCK_CLASS'			=> 'Class',
	'PBLOCK_APPROVED'		=> 'Approved',
	'PBLOCK_AUTHOR'			=> 'Author',
	'PBLOCK_VERSION'		=> 'Revision',
	'PBLOCK_DATE'			=> 'Date',
	'PBLOCK_UPDATE'			=> 'Update',
	'PBLOCK_SITE'			=> 'Site',
));
?>