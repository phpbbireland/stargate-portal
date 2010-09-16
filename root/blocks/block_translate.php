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

$phpEx = substr(strrchr(__FILE__, '.'), 1);

$queries = $cached_queries = 0;

global $config, $base_url;

if (!is_array($_SERVER))
{
	$_SERVER = $HTTP_SERVER_VARS;
	$_GET = $HTTP_GET_VARS;
}
$base_url = ($config['cookie_secure'] ? "https://" : "http://").$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);

if (substr($base_url, -1) != "/")
{
	$base_url .= "/";
}

$lang = $config['default_lang'];
$user_lang = $user->lang['USER_LANG'];

if (!$user_lang == $lang)
{
	$lang = $user_lang;
}

$template->assign_block_vars('translate', array(
	'USER_LANG' => $lang,
	'BASE_URL' => $base_url,
));

$template->assign_vars(array(
	'TRANSLATE_DEBUG'	=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0', ($total_queries) ? $total_queries : '0'),
));

?>