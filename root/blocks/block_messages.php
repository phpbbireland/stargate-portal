<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   Saturday, Jan 22, 2005
* @copyright (c) 2005-2008 phpbbireland
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_messages.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* Updated: 25 September 2008
*
*/

/**
* @ignore
*/

if ( !defined('IN_PHPBB') )
{
	exit;
}

global $db, $user;
$pos = 0;

// types: welcome message,  info, style //
$sql = "SELECT * FROM ". K_MODULES_TABLE . " WHERE mod_id = 1";

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

	if($user->data['username'] == 'Anonymous')
		$mod_details = str_replace("[you]" ,$user->lang['GUEST'], $mod_details);
	else
		$mod_details = str_replace("[you]", ('back ' . '<span style="font-weight:bold; color:#' . $user->data['user_colour'] . ';">' . $user->data['username'] . '</span>'), $mod_details);

	$template->assign_vars( array(
		'TITLE'		=> htmlspecialchars_decode($mod_name),
		'IMAGE'		=> htmlspecialchars_decode($mod_image),
		'LINK'		=> htmlspecialchars_decode($mod_link),
		'MESSAGE'	=> htmlspecialchars_decode($mod_details),
		)
	);
}

?>