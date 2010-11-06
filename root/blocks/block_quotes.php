<?php
/**
*
* @package Stargate Portal
* @author  Tsangaris Gregory - aka Cybermage
* @begin   Tuesday, September 1st, 2007
* @copyright (c) 2007 Tsangaris Gregory - aka Cybermage
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_quotes.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* Updated:
*
*/

/**
* @ignore
*/
 
if (!defined('IN_PHPBB'))
{
	exit;
}

global $k_config;

$sgp_cache_time = $k_config['sgp_cache_time'];

$queries = $cached_queries = 0;

	$sql = 'SELECT *
		FROM ' . K_QUOTES_TABLE . '
		ORDER by rand()
		LIMIT 1';
	
	if ($result = $db->sql_query($sql, $sgp_cache_time))
	{
		$row = $db->sql_fetchrow($result);
	}
	else
	{
		trigger_error('ERROR_PORTAL_QUOTES');
	}
	
	$db->sql_freeresult($result);

	$template->assign_vars(array(
		'L_QUOTES'			=> $row['quote'],
		'L_QUOTES_AUTHOR'	=> $row['author'],
		'QUOTES_DEBUG'		=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0', ($total_queries) ? $total_queries : '0'),
	));

?>