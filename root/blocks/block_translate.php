<?php
/**
*
* @package Stargate Portal
* @author  Martin Larsson - aka NeXur
* @begin   Thursday, 29 February, 2008
* @copyright (c) 2008 Martin Larsson - aka NeXur
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_translate.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* Updated: 4 November 2008
*
*/

/**
* @ignore
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

global $config, $user;
$queries = $cached_queries = 0;

$spath = $config['script_path'] . '/';
$lang = $config['default_lang'];
$user_lang = $user->lang['USER_LANG'];

$this_page = explode(".", $user->page['page']);
$page = $this_page[0] . '.' . $this_page[1] ;

$template->assign_block_vars('translate', array(
	'LANG'		=> $lang,
	'USER_LANG'	=> $user_lang,
	'BASE_URL'	=> $config['server_protocol'] . 'www.' . $config['sitename'] . $spath . $page,
));

$template->assign_vars(array(
	'TRANSLATION_PORTAL_DEBUG'	=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0', ($total_queries) ? $total_queries : '0'),
));
?>