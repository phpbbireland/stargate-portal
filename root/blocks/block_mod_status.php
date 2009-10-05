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
* @version $Id: block_mod_status.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
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

	// Retrieve Styles Status items from database //
	$queries = 0;
	$cached_queries = 0;

	global $db, $k_config; 

	$k_config['mini_mod_mod_count'] = 5;

	$last_style = 0;

	//$sql = "SELECT * FROM " . K_MODULES_TABLE . " WHERE mod_type = 'mod' AND mod_origin = 1 LIMIT " . $k_config['mini_mod_mod_count']; 
	$sql = "SELECT * FROM " . K_MODULES_TABLE . " WHERE mod_type = 'mod' LIMIT " . $k_config['mini_mod_mod_count']; 

	if (!$result1 = $db->sql_query($sql, 600))
	{
		trigger_error('Error! Could not query portal modules information: ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
	}

	$mod_status = array();

	while( $row1 = $db->sql_fetchrow($result1) )
	{
		$mod_status[] = $row1;
	}
	$last_style = count($mod_status);

	for ($i = 0; $i < count($mod_status); $i++)
	{
		switch($mod_status[$i]['mod_download_count'])
		{
			case 0:		$mod_status[$i]['mod_download_count'] = sprintf($user->lang['DOWNLOAD_COUNT_NONE'], $mod_status[$i]['mod_download_count']); break;
			case 1:		$mod_status[$i]['mod_download_count'] = sprintf($user->lang['DOWNLOAD_COUNT'], $mod_status[$i]['mod_download_count']); break;
			default:	$mod_status[$i]['mod_download_count'] = sprintf($user->lang['DOWNLOAD_COUNTS'], $mod_status[$i]['mod_download_count']); break;
		}

		$template->assign_block_vars('mod_status_row', array(
			'MOD_NAME'				=> $mod_status[$i]['mod_name'],
			'MOD_VERSION'			=> $mod_status[$i]['mod_version'],
			'MOD_UPDATED'			=> $mod_status[$i]['mod_last_update'],
			'MOD_AUTHOR'			=> $mod_status[$i]['mod_author'],
			'MOD_AUTHOR_CO'			=> $mod_status[$i]['mod_author_co'],
			'MOD_DETAILS'			=> htmlspecialchars_decode($mod_status[$i]['mod_details']),
			'MOD_LINK'				=> htmlspecialchars_decode($mod_status[$i]['mod_link']) . $mod_status[$i]['mod_name'],
			'MOD_SUPPORT'			=> htmlspecialchars_decode($mod_status[$i]['mod_support_link']),
			'MOD_THIS'				=> $i,
			'MOD_DOWNLOAD_COUNT'	=> $mod_status[$i]['mod_download_count'],
			'MOD_COMPETED'			=> k_progress_bar($mod_status[$i]['mod_status']),
		));
	}

	$template->assign_vars(array(
		'MOD_COUNT'		=> $last_style - 1,
		'LINK_IMG'		=> '<img src="' . $phpbb_root_path . 'images/link.png" alt="" />',
		'MS_PORTAL_DEBUG'	=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0'),
	));

?>