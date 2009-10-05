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

define('IN_PHPBB', true);

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);

include($phpbb_root_path . 'common.' . $phpEx);
include_once($phpbb_root_path . 'includes/functions_template.' . $phpEx);

// Start session management
$user->session_begin(false);
$auth->acl($user->data);
$user->setup('portal/portal');

$queries = 0;
$cached_queries = 0;

	if ( !defined('IN_PHPBB') )
	{
		exit;
	}

	global $config, $user;

	$template->assign_vars( array(
		'SITENAME' => $config['sitename'],
		'USERNAME' => $user->data['username'] . '_sgp',
		'OPT_IRC_CHANNELS' => $k_config['opt_irc_channels'],
		'IR_PORTAL_DEBUG' => sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0'),
	));

	page_header('IRC');

	$template->set_filenames(array(
		'body' => 'blocks/block_irc_popup.html',
		)
	);
	page_footer();

?>