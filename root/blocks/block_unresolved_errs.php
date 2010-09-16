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
* @version $Id: block_unresolved_errs.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
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

	$queries = $cached_queries = 0;

	global $db;

	// This file serves as an example of how to display information on the portal page...
	// This example display a message relating to unresolved error but could just as easily display other information...
	// To ensure you are retrieving the correct information you need to check the ACP > PORTAL > Mini Modules and get the correct id for this file...

	// Note PORTAL_STATUS_TABLE contains info on various data elements...
	// this query is called by several blocks with different types

	// When you add a mini-module, record the id so you can build a display like this one... 
	// Generally speaking you ca use the mod type to retrieve several rows for your mini-module...

	$sql = "SELECT * FROM ". K_MODULES_TABLE . " WHERE mod_id = 6 ";

	if (!$result = $db->sql_query($sql, 600))
	{
		trigger_error($user->lang['ERROR_PORTAL_STYLE_STATUS'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
		//trigger_error('ERROR_PORTAL_STYLE_STATUS');
	}

	$row = $db->sql_fetchrow($result);

	$template->assign_block_vars('unresolved_status_row', array(
		'UNRESOLVED_TITLE'	=> $row['mod_name'],
		'UNRESOLVED'		=> $row['mod_details'],
		'UNRESOLVED_LINK'	=> $row['mod_link'],

		'UE_DEBUG'			=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0', ($total_queries) ? $total_queries : '0'),
		)
	);

?>