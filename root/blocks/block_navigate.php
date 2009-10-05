<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   Saturday, April 1st, 2005
* @copyright (c) 2005-2008 phpbbireland
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_navigate.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* Updated:
*
*/

/**
* @ignore
*/
 
if (!defined('IN_PHPBB'))
{
	exit;
}

$queries = 0;
$cached_queries = 0;

include_once($phpbb_root_path . 'includes/functions.'.$phpEx);

$template->assign_vars(array(
	'U_INDEX' 				=> "{$phpbb_root_path}index.$phpEx$SID",
	'U_PORTAL' 				=> "{$phpbb_root_path}portal.$phpEx$SID",
	'N_SITE_LINK_IMG'		=>  '<a href="' . $url . '/portal.php">' . '<img src="' . $phpbb_root_path . 'images/links/' . $site_ref_img . '" alt"" /></a>',
	'DEBUG_QUERIES'			=> (DEBUG_EXTRA) ? true : false,
);

// END: Rules //
?>