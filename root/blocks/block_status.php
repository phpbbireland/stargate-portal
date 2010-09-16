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
* @version $Id: block_status.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
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

	$queries = $cached_queries = $total_queries = 0;

/*
	$queries = 0;
	$cached_queries = 0;

	// Retrieve Portal Status items from database //

	// or for more use //$template->assign_block_vars('rept',array('PORTAL_PROGRESS' => progress_bar(65)));
	$template->assign_vars(array('PORTAL_PROGRESS' => k_progress_bar(75)));

	global $db;

	// type 0 = welcome message,  type 1 = blocks/portal info, type 2 = styles info 4 = bugs 5 = ? //

	$sql = "SELECT * FROM ". K_MODULES_TABLE . " WHERE type = 1 ";
	if (!$result1 = $db->sql_query($sql, 1200))
	{
		trigger_error('Error! Could not query portal status information: ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);

	}

	$portal_status = array();

	while( $row1 = $db->sql_fetchrow($result1) )
	{
		$portal_status[] = $row1;
	}

	for ($i = 0; $i < count($portal_status); $i++)
	{
		$template->assign_block_vars('portal_status_row', array(
			'MESSAGE_TITLE' => $portal_status[$i]['name'],
			'MESSAGE' => $portal_status[$i]['info'],
			'MESSAGE_DATE' => $portal_status[$i]['last_update'],

			)
		);
	}

	$template->assign_vars( array(
		'LAST_UPDATE'		=> "13 November 2006",
		'S_PORTAL_DEBUG'	=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0'),
	));
*/

	$template->assign_vars( array(
		'LAST_UPDATE'	=> "13 November 2006",
		'S_DEBUG'		=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0', ($total_queries) ? $total_queries : '0'),
	));
?>