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
* @version $Id$
*
* Updated:
*
*/

/**
* @ignore
*/

if (!defined('IN_PHPBB'))
{
	//exit;
	define('IN_PHPBB', true);
}

global $k_config;

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './../';

$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

if (!class_exists('template_compile'))
{
	include($phpbb_root_path . 'includes/functions_template.' . $phpEx);
}

// Start session management
$user->session_begin(false);
$auth->acl($user->data);
$user->setup('portal/portal');

$upload_dir = $k_config['mp3_folder'];
$upload = $user->lang['UPLOAD'];

$template->assign_vars(array(
	'U_UPLOAD_DIR'	=> $upload_dir,
	'L_UPLOAD_FILE'	=> $upload,
	'MP3_POPUP'		=> $user->lang['MP3_POPUP'],
	'PATH'			=> './..',
 ));

page_header('{L_MP3_PLAYER}');
$template->set_filenames(array(
	'body' => 'blocks/block_mp3_popup_player.html',
));
page_footer();
?>