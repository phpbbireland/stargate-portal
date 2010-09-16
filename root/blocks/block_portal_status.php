<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   Saturday, 14th November, 2005
* @copyright (c) 2005-2008 phpbbireland
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_portal_status.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
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

// for bots test //
//$page_title = $user->lang['BLOCK_PORTAL_STATUS'];

global $config, $k_config;

$queries = $cached_queries = 0;

/*
	// Retrieve Portal Status items from database //

	global $db, $k_config; 

	$sql = "SELECT * FROM " . K_MODULES_TABLE . " WHERE mod_type = 'portal_status' LIMIT 1"; 

	if (!$result = $db->sql_query($sql, 1200))
	{
		trigger_error('Error! Could not query portal modules information: ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
	}

	$row = $db->sql_fetchrow($result);

	$template->assign_vars(array(
		'MOD_TITLE'			=> $row['mod_name'],
		'MOD_LAST_UPDATE'	=> $row['mod_last_update'],
		'MOD_DATA'			=> htmlspecialchars_decode($row['mod_details']),
		'MOD_STYLE_LINK'	=> htmlspecialchars_decode($row['mod_link']),
		'MOD_PROGRESS'		=> k_progress_bar($row['mod_status']),
		'MOD_COPYRIGHT'		=> htmlspecialchars_decode($row['mod_copyright']),
		'P_VERSION'			=> $config['portal_version'],
		'PS_PORTAL_DEBUG'	=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0'),
	));
*/

	$template->assign_vars(array(
		'P_VERSION'	=> $config['portal_version'],
		'PORTAL_STATUS_DEBUG'	=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0', ($total_queries) ? $total_queries : '0'),
	));

?>