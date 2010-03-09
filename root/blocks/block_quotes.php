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
$queries = 0;
$cached_queries = 0;
	$sql = 'SELECT *
		FROM ' . K_QUOTES_TABLE . '
		ORDER by rand()
		LIMIT 1';
	
	if($result = $db->sql_query($sql))
	{
		$row = $db->sql_fetchrow($result);
	}
	else
		trigger_error('Error 42:quotes');
	
	$db->sql_freeresult($result);

	$template->assign_vars(array(
		'L_QUOTES'			=> $row['quote'],
		'L_QUOTES_AUTHOR'	=> $row['author'],
		'Q_PORTAL_DEBUG'		=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0'),
	));

?>