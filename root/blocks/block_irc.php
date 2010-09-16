<?php
/**
*
* @package Stargate Portal
* @author  Martin Larsson - aka NeXur
* @begin   Monday, 6th October, 2008
* @copyright (c) 2005-2008 Martin Larsson - aka NeXur
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_irc_popup.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* Updated: 20 October 2008
* We need the session bit as we load the page in a popup
*/

/**
* @ignore
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

global $phpbb_root_path, $phpEx, $config, $k_config, $user;
$sgp_cache_time = $k_config['sgp_cache_time'];
$queries = $cached_queries = 0;

$template->assign_vars( array(
	'SITENAME'			=> $config['sitename'],
	'IRC_USERNAME'		=> ($user->data['user_id'] == ANONYMOUS) ? '' : $user->data['username'] . '_sgp',
	'OPT_IRC_CHANNELS'	=> $k_config['opt_irc_channels'],
	'IRC_DEBUG'			=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0', ($total_queries) ? $total_queries : '0'),
));

?>