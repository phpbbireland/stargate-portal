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
* @version $Id: block_mp3s_popup_player.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* Updated:
*
*/

/**
* @ignore
*/

define('IN_PHPBB', true);
if ( !defined('IN_PHPBB') )
{
	exit;
}

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);

include($phpbb_root_path . 'common.' . $phpEx);
include_once($phpbb_root_path . 'includes/functions.' . $phpEx);
include_once($phpbb_root_path . 'includes/functions_template.' . $phpEx);

// Start session management
$user->session_begin(false);
$auth->acl($user->data);
$user->setup('portal/portal');

if ( !defined('IN_PHPBB') )
{
	exit;
}

$upload_dir = 'musix';
$upload = 'Upload';

$template->assign_vars(array(
	'U_UPLOAD_DIR'    => $upload_dir,
	'L_UPLOAD_FILE'   => $upload,
	'MP3_POPUP'		=> $user->lang['MP3_POPUP'],
	'PATH'          => './..',
 ));


page_header('MP3');

$template->set_filenames(array(
	'body' => 'blocks/block_mp3_popup_player.html',
	)
);
page_footer();
?>