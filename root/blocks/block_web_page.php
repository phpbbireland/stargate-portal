<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   Saturday, 23 June 2008
* @copyright (c) 2005-2008 phpbbireland
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_web_page.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* Updated: 23rd August 2008
*
*/

/**
* @ignore
*/

	if ( !defined('IN_PHPBB') )
	{
		exit;
	}
	//$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';


	global $db, $user;
	$pos = 0;
	//$sql = "SELECT * FROM ". K_MODULES_TABLE . " WHERE mod_type LIKE 'welcome_message' LIMIT 1";
	$sql = "SELECT * FROM ". K_MODULES_TABLE . " WHERE mod_type LIKE 'web_page'";


	if (!$result = $db->sql_query($sql))
	{
		trigger_error('Error! Could not query messages (Welcome etc...): ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
	}
	else
	{
		$row   = $db->sql_fetchrow($result);
		$mod_name		= $row['mod_name'];
		$mod_image		= $row['mod_thumb'];
		$mod_details	= $row['mod_details'];
		$mod_link		= $row['mod_download_link'];

		$template->assign_vars( array(
			'TITLE'		=> htmlspecialchars_decode($mod_name),
			'IMAGE'		=> htmlspecialchars_decode($mod_image),
			'LINK'		=> htmlspecialchars_decode($mod_link),
			'MESSAGE'	=> htmlspecialchars_decode($mod_details),
		));
	}
	$db->sql_freeresult($result);
?>