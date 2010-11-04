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
	'ACP_CLOUD'				=> 'Portal tags.',
	'ACP_CLOUD_EXPLAIN'		=> 'Here you can add, edit and delete tags. <strong>Note:</strong> Using a font size greater than 16pt is not recommended, also it might be difficult to see light coloured fonts...',
	
	'CLOUD_MAX_TAGS'			=> 'Max tags',
	'CLOUD_MAX_TAGS_EXPLAIN'	=> 'Set Max tags so you don\'t clutter tha block',

	'CLOUD_MOVIE'				=> 'Cloud Movie',
	'CLOUD_MOVIE_RXPLAIN'		=> 'Eack cloud can have its own movie',

	'ADD_CLOUD'				=> 'Add a cloud',
	'ADD_TAG'				=> 'Add a tag',

	'EDIT_CLOUD'			=> 'Editing cloud',
	'EDIT_TAG'				=> 'Editing tag',

	'DELETE_CLOUD'			=> 'Delete a cloud',
	'DELETE_TAG'			=> 'Delete a tag',

	'CONFIG_CLOUD'			=> 'Config cloud defaults',
	'CONFIG_TAG'			=> 'Config tag defaults', 

	'TAG_ID'				=> 'ID',
	'TAG_ID_LONG'			=> 'The tag ID (do not edit)',
	'TAG_IS_ACTIVE'			=> 'A',
	'TAG_IS_ACTIVE_LONG'	=> 'Set tag as active',
	'TAG'					=> 'T',
	'TAG_LONG'				=> 'T ? 1',
	'TAG_LINK'				=> 'Link',
	'TAG_LINK_LONG'			=> 'Link to use for the tag',

	'TAG_COLOUR'			=> 'Colour 1',
	'TAG_COLOUR_LONG'		=> 'Tag main colour (example: F0F0F1)',
	'TAG_COLOUR2'			=> 'Colour 2',
	'TAG_COLOUR2_LONG'		=> 'Tag secondary colour(example: F0F0F1)',
	'TAG_HCOLOUR'			=> 'HiColour',
	'TAG_HCOLOUR_LONG'		=> 'Tag highlight colour (example: F0F0F1)',

	'TAG_REL'				=> 'T/C/B',
	'TAG_REL_LONG'			=> 'Options: "tags" or "cats" or "both"',
	'TAG_FONT_SIZE'			=> 'Font size',
	'TAG_FONT_SIZE_LONG'	=> 'The font size to use (MAX ~ 16pt)',
	'TAG_TEXT'				=> 'Tag Text',
	'TAG_TEXT_LONG'			=> 'The tag text to display<br />Actual size and colour',

	'CONFIRM_OPERATION_CLOUD' => 'Delete this tag?',
	'SWITCHING'				=> 'Switching to k_config',

	'DELETE_TAG_CACHE'		=> 'Delete Tag Cache',
	'DATA_IS_BEING_SAVED'	=> 'Data is being saved',
	'SAVING'				=> 'Saving',
	'ACTION_CANCELLED'		=> 'Action cancelled',
	'TAG_CREATED'			=> 'Tag created...',
));

?>