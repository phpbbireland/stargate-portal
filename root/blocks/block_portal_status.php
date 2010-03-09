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

	if ( !defined('IN_PHPBB') )
	{
		exit;
	}

	// for bots test //
	$page_title = $user->lang['BLOCK_PORTAL_STATUS'];

	global $config, $k_config;

	$queries = 0;
	$cached_queries = 0;

	$template->assign_vars(array(
		'P_VERSION'			=> $config['portal_version'],
		'PS_PORTAL_DEBUG'	=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0'),
	));

?>