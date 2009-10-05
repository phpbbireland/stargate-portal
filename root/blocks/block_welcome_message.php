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
* @version $Id: block_welcome_message.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* Updated: 22nd August 2008
*
*/

/**
* @ignore
*/

if ( !defined('IN_PHPBB') )
{
	exit;
}

$queries = 0;
$cached_queries = 0;

	global $db, $user;
	$pos = 0;
	//$sql = "SELECT * FROM ". K_MODULES_TABLE . " WHERE mod_type LIKE 'welcome_message' LIMIT 1";
	$sql = "SELECT * FROM ". K_MODULES_TABLE . " WHERE mod_id = 1";

	if (!$result = $db->sql_query($sql, 6000))
	{
		trigger_error('Error! Could not query messages (Welcome etc...): ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
	}
	else
	{
		$row   = $db->sql_fetchrow($result);
		$mod_name		= $row['mod_name'];
		$mod_image		= $row['mod_thumb'];
		$mod_details	= $row['mod_details'];
		$mod_link		= $row['mod_link'];
		$db->sql_freeresult($result);

		$mod_details = process_for_vars($mod_details, true);

		if($user->data['username'] == 'Anonymous')
			$mod_details = str_replace("[you]", $user->lang['GUEST'], $mod_details);
		else
			$mod_details = str_replace("[you]", ('<span style="font-weight:bold; color:#' . $user->data['user_colour'] . ';">' . $user->data['username'] . '</span>'), $mod_details);

		$template->assign_vars( array(
			'W_TITLE'	=> $mod_name,
			'W_IMAGE'	=> $mod_image,
			'W_LINK'	=> $mod_link,
			'W_MESSAGE'	=>  htmlspecialchars_decode($mod_details),
			'W_PORTAL_DEBUG' => sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0'),
		));
	}
?>