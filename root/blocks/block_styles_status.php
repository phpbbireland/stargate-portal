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
* @version $Id: block_styles_status.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
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

	global $db, $k_config, $config; 

	$last_style = 0;
	$select_allow = ($config['override_user_style']) ? false : true;

	//$sql = "SELECT * FROM " . K_MODULES_TABLE . " WHERE mod_type = 'style' AND mod_origin = 1 LIMIT " . $k_config['mini_mod_style_count']; 
	$sql = "SELECT * FROM " . K_MODULES_TABLE . " WHERE mod_type = 'style' LIMIT " . $k_config['mini_mod_style_count']; 

	if (!$result1 = $db->sql_query($sql, 600))
	{
		trigger_error('Error! Could not query portal modules information: ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
	}

	$styles_status = array();

	while( $row1 = $db->sql_fetchrow($result1) )
	{
		$styles_status[] = $row1;
	}
	$last_style = count($styles_status);

	for ($i = 0; $i < count($styles_status); $i++)
	{
		switch($styles_status[$i]['mod_download_count'])
		{
			case 0:		$styles_status[$i]['mod_download_count'] = sprintf($user->lang['DOWNLOAD_COUNT_NONE'], $styles_status[$i]['mod_download_count']); break;
			case 1:		$styles_status[$i]['mod_download_count'] = sprintf($user->lang['DOWNLOAD_COUNT'], $styles_status[$i]['mod_download_count']); break;
			default:	$styles_status[$i]['mod_download_count'] = sprintf($user->lang['DOWNLOAD_COUNTS'], $styles_status[$i]['mod_download_count']); break;
		}

		$template->assign_block_vars('styles_status_row', array(
			'STYLE_NAME'		=> $styles_status[$i]['mod_name'],
			'STYLE_UPDATED'		=> $styles_status[$i]['mod_last_update'],
			'STYLE_AUTHOR'		=> $styles_status[$i]['mod_author'],
			'STYLE_AUTHOR_CO'	=> $styles_status[$i]['mod_author_co'],
			'STYLE_THIS'		=> $i,
			'STYLE_DOWNLOAD_COUNT'	=> $styles_status[$i]['mod_download_count'],
			'STYLE_COMPETED'		=> k_progress_bar($styles_status[$i]['mod_status']),
			'STYLE_VERSION'			=> ($styles_status[$i]['mod_version']) ?$styles_status[$i]['mod_version']  : 'Unknown' ,
			'STYLE_DETAILS'			=> htmlspecialchars_decode($styles_status[$i]['mod_details']),

			'U_STYLE_LINK'			=> htmlspecialchars_decode($styles_status[$i]['mod_link']),
			'U_STYLE_SUPPORT'		=> htmlspecialchars_decode($styles_status[$i]['mod_support_link']),
			'U_STYLE_TEST_IT'		=> ($styles_status[$i]['mod_link_id'] && $select_allow) ? $phpbb_root_path . 'portal.php?style=' . $styles_status[$i]['mod_link_id'] : '',
		));
	}

$template->assign_vars(array(
	'STYLE_COUNT'		=> $last_style - 1,
	'DOWNLOAD_IMG'		=> '<img src="' . $phpbb_root_path . 'images/download.png" alt="" />',
	'TEST_IT_IMG'		=> '<img src="' . $phpbb_root_path . 'images/test_it.png" alt="" />',
	'SS_PORTAL_DEBUG'	=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0'),
));


?>