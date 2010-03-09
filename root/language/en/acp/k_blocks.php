<?php
if (!defined('IN_PHPBB'))
{
	exit;
}

/* blocks [English] */
/* DO NOT CHANGE */

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// phpbbportal profile fields
$lang = array_merge($lang, array(

	'TITLE' 			=> 'Block Administration/Management',
	'TITLE_EXPLAIN'		=> '&bull; All block html file are located in: styles/portal_common/template/blocks folder, always ensure you place any new block html file here, else it will not be able in the block dropdown list. The NDX indicates position relative to other blocks in the same column... Block titles will be replaced by lang var if it exists. Note, the last edited block is highlighted (bold)',
	'ACP_BLOCKS' 		=> 'Blocks',
	'ACP_BLOCK_TOOLS' 	=> 'Blocks Tools',

	'BLOCKS_HEADER_ADMIN'	=> 'Block Management',
	'BLOCKS_ADD_HEADER'		=> 'Add a new block',
	'BLOCKS_REINDEX'		=> 'Re-index blocks',
	'BLOCKS_REINDEXED'		=> 'All blocks have been Re-Indexed',
	'BLOCK_TITLE' 			=> 'Block Title*',
	'BLOCK_FNAME_P' 		=> 'Filename (.php)',
	'BLOCK_FNAME_H'		 	=> 'Filename (.html)',
	'BLOCK_FNAME_I'			=> 'Icon',
	'BLOCK_FNAME_I_EXPLAIN'	=> 'Please note, image filenames cannot contain spaces.',

	'BLOCK_FNAME_I_BIG'	 	=> 'Block Mini image',

	//'BLOCK_ICON_ALT_TEXT'	=> 'Image alt text',

	'BLOCK_FNAME_IS_BIG'	=> 'Mini block images found',
	'BLOCK_FNAME_P_BIG'		=> 'Block Filename.php',
	'BLOCK_FNAME_H_BIG'	 	=> 'Block Filename.html',
	'BLOCK_FNAME_EXPLAIN'	=> 'Located in: styles/portal_common/template/blocks folder',
	'BLOCK_ID' 				=> 'ID',
	'BLOCK_NDX'				=> 'NDX',
	'BLOCK_INDEX'			=> '(Index / Sort Order)',
	'BLOCK_UP' 				=> 'Up',
	'BLOCK_DOWN' 			=> 'Dn',
	'BLOCK_DISABLED'		=> 'Dis',
	'BLOCK_DISABLED_BIG'	=> 'Block is Disabled',
	'BLOCK_ACTIVE'			=> 'Active',
	'BLOCK_ACTIVE_BIG'		=> 'Block is Active',
	'BLOCK_TYPE'			=> 'T',
	'BLOCK_TYPE_BIG'		=> 'File Type',
	'BLOCK_POSITION'	 	=> 'Position',
	'BLOCK_POSITION_BIG' 	=> 'Block Position',

	'BLOCK_VIEW_BY_SHORT'	=> 'View By',
	'BLOCK_VIEW_BY' 		=> 'Add a group',

	'BLOCK_VIEW_BY_EXPLAIN'	=> 'Select a group to add to the list above (reusable). <br />Selecting <b>0 (None)</b> will empty the list.',

	'BLOCK_VIEW_GROUPS'			=> 'Block Group Visibility',
	'BLOCK_VIEW_GROUPS_EXPLAIN'	=> 'Enter group ID(s) manually or use the dropdown below to add groups.',

	'BLOCK_VIEW_ALL'			=> 'This block is viewable to all groups',
	'BLOCK_VIEW_ALL_EXPLAIN'	=> 'Note, you must select at least one group in the dropdown list.<br />0 (None) in the dropdown will hide this block from all groups.',

	'BLOCK_EDIT'			=> 'Edit',
	'BLOCK_DELETE' 			=> 'Del.',
	'BLOCK_MOVE'			=> 'Move',
	'BLOCK_SCROLL'			=> 'S',

	'BLOCK_SCROLL_BIG'		=> 'Allow Scrolling',
	'BLOCK_SCROLL_BIG_EXPLAIN'		=> 'Yes, block (data) will scroll, No, block is static.',

	'BLOCK_ADDED'			=> 'Block Added!',
	'BLOCK_EDITED'			=> 'Block Edited!',
	'BLOCK_UPDATED'			=> 'Block Updated',
	'DO_NOT_EDIT'			=> '(Do not edit this value)',

	'PROCESS'				=> 'process',
	'PORTAL_BLOCKS_ENABLED' => 'Portal blocks enabled',

	'BLOCK_G_COUNT'			=> 'Generic store for blocks',
	'BLOCK_G_COUNT_EXPLAIN'	=> 'The number of Announcements, News Items or Recent Topics to display if scrolling is disabled in their associated blocks.',

	'VARS_NO_EDIT'			=> 'Block has no variables',
	'VARS_HAS_EDIT'			=> 'Set block variables',

	'HAS_VARS'				=> 'Block contains configurable data',
	'HAS_VARS_EXPLAIN'		=> '(config info is stored in the database).',
	'BLOCK_VAR_FILE'			=> 'Select the config file used to display/edit variables',
	'BLOCK_VAR_FILE_EXPLAIN'	=> '(located in adm/style/k_block_vars folder).',

	'SAVING'	=> 'Saving Data...',

	'MINIMOD_BASED'			=> 'Is this block based on a SGP minimod?',
	'MINIMOD_BASED_EXPLAIN' => 'Select Yes, if Block is based on a portal minmod? (adjusted elsewhere)',

	'MINIMOD_OPTIONS'		=> 'Which minimod is associated with this block?',
	'MINIMOD_OPTIONS_EXPLAIN'	=> 'Ignore if block is not based on a minimod.',
	'MINIMOD_DETAILS_SHOW'	=> 'This block is based on a minimod, this is a link to it!',
	'MINIMOD_DETAILS_NO_EDIT' => 'Block is not a minimod', 

	'HTML'	=> 'HTML',
	'BBCODE' => 'BBcode',

	'ALL_GROUPS'	=> 'All Groups',

	'SAVED'	=> 'Data saved... purging cache for this table...!',
	'UNKNOWN_ERROR'	=> 'Error not processing saved data<br />',

	'CONFIRM_OPERATION_BLOCKS'		=> 'Do you wish to delete this block?',
	'CONFIRM_OPERATION_BLOCKS_REINDEX'	=> 'Do you wish to re-index the blocks?',
	'MUST_SELECT_VALID_BLOCK_DATA'	=> 'Invalid block ID',
	'BLOCK_UPDATING'	=> 'Updating block positions, please wait...<br />',
	'BLOCK_MOVE_ERROR'	=> 'If you are trying to move a block from one group (left/right/center) to another you need to change it to that group first... <br />This can also happen if the ndx values are not consecutive... in which case, go back and manually correct the ndx values, then try again. ',

));
// Message Settings
$lang = array_merge($lang, array(
	'ACP_MESSAGE_SETTINGS_EXPLAIN'	=> 'Here you can set all default settings for private messaging',
));


?>