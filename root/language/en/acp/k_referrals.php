<?php
/* k_newsfeeds.php */
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
	'ACP_K_REFERRALS'			=> 'TOP REFERRALS',
	'ACP_K_ADMIN_REFERRALS'		=> 'Manage HTTP referrals',
	'TITLE' 					=> 'Referrals management',
	'TITLE_EXPLAIN'				=> 'Use this form to manage HTTP Referrals stored in your database.  Total number of records: ',

	'SELECT_FILTER'				=> 'Select filter',
	'SELECT_SORT_METHOD'		=> 'Select sort method',
	'ORDER'						=> 'Order',
	'SORT_DESCENDING'			=> 'Descending',
	'SORT_ASCENDING'			=> 'Ascending',
	'SORT'						=> 'Sort',
	'REFERER_HOST'				=> 'Host',
	'REFERER_HITS'				=> 'Hits',
	'FIRST_VISIT'				=> 'First visit',
	'NO_REFERRALS'				=> 'No Referrals in your database, yet!',
	'NO_ENABLED_REFERRALS'		=> 'No <b>ENABLED</b> Referrals in your database, yet!',
    'NO_DISABLED_REFERRALS'		=> 'No <b>DISABLED</b> Referrals in your database, yet!',
	'ENABLE_MARKED'				=> 'Enable marked',
	'DISABLE_MARKED'			=> 'Disable_marked',
	'HOST'						=> 'Host',
	'HITS'						=> 'Hits',
	'REFERRALS_MANAGEMENT'		=> 'Referrals management.',
	'REFERRALS_MANAGEMENT_EXPLAIN'	=> 'Here you can manage HTTP Referrals stored in your database.',
	'REFERRALS_COUNT'				=> 'Top referrals count',
	'REFERRALS_COUNT_EXPLAIN'		=> 'Specify how many referrals you wish to show in the Top referrals block.',
	'NO_ITEMS_MARKED'				=> 'No items marked.',
	'PLEASE_CONFIRM'				=> 'Please confirm.',
	'NO_UPDATE_HTTP_REFERRALS'		=> 'Could not update referrals',
));

?>