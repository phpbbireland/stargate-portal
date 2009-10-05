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
* @version $Id: block_dev_status.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* Updated:
*
*/

/**
* @ignore
*/

	if ( !defined('IN_PHPBB') )
	{
		exit;
	}

	// for bots test //
	$page_title = $user->lang['BLOCK_DEV_STATUS'];

	$queries = 0;
	$cached_queries = 0;
	$block_count = 0;
	$style_download_count = 0;
	$block_status = array();

	$template->assign_vars(array('PORTAL_PROGRESS' => k_progress_bar(75)));

	global $db;

	$sql = "SELECT * FROM ". K_MODULES_TABLE . " WHERE mod_type = 'block' ";
	if (!$result1 = $db->sql_query($sql, 1200))
	{
		trigger_error('Error! Could not query portal status information: ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);

	}

	$portal_status = array();

	while( $row1 = $db->sql_fetchrow($result1) )
	{
		$block_status[] = $row1;

	}
	$block_count = count($block_status);

	for ($i = 0; $i < count($block_status); $i++)
	{
		switch($style_download_count)
		{
			case 0:		$block_status[$i]['mod_download_count'] = sprintf($user->lang['DOWNLOAD_COUNT_NONE'], $block_status[$i]['mod_download_count']); break;
			case 1:		$block_status[$i]['mod_download_count'] = sprintf($user->lang['DOWNLOAD_COUNT'],$block_status[$i]['mod_download_count']); break;
			default:	$block_status[$i]['mod_download_count'] = sprintf($user->lang['DOWNLOAD_COUNTS'], $block_status[$i]['mod_download_count']); break;
		}

		$template->assign_block_vars('block_status_row', array(
			'BLOCK_NAME'		=> $block_status[$i]['mod_name'],
			'BLOCK_UPDATED'		=> $block_status[$i]['mod_last_update'],
			'BLOCK_AUTHOR'		=> $block_status[$i]['mod_author'],
			'BLOCK_AUTHOR_CO'	=> $block_status[$i]['mod_author_co'],
			'BLOCK_DETAILS'		=> htmlspecialchars_decode($block_status[$i]['mod_details']),
			'BLOCK_THIS'			=> $i,
			'BLOCK_DOWNLOAD_COUNT'	=> $block_status[$i]['mod_download_count'],
			'BLOCK_COMPETED'		=> k_progress_bar($block_status[$i]['mod_status']),
			'BLOCK_VERSION'			=> $block_status[$i]['mod_version'],

			'U_BLOCK_LINK'		=> htmlspecialchars_decode($block_status[$i]['mod_link']) . $block_status[$i]['mod_name'],
			'U_BLOCK_SUPPORT'	=> htmlspecialchars_decode($block_status[$i]['mod_support_link']),
		));
	}

	$template->assign_vars( array(
		'BLOCK_COUNT'			=> $block_count,
		'BLOCK_DOWNLOAD_IMG'	=> '<img src="' . $phpbb_root_path . 'images/download.png" alt="" />',
		'S_PORTAL_DEBUG'		=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0'),
	));
?>