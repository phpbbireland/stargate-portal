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
* @version $Id: block_link_to_us.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* Updated:
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

// borrowed from common.php //
// We have to generate a full HTTP/1.1 header here since we can't guarantee to have any of the information

$server_name = (!empty($_SERVER['SERVER_NAME'])) ? $_SERVER['SERVER_NAME'] : getenv('SERVER_NAME');
$server_port = (!empty($_SERVER['SERVER_PORT'])) ? (int) $_SERVER['SERVER_PORT'] : (int) getenv('SERVER_PORT');
$secure = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 1 : 0;

$script_name = (!empty($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : getenv('PHP_SELF');
if (!$script_name)
{
	$script_name = (!empty($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : getenv('REQUEST_URI');
}

// Replace any number of consecutive backslashes and/or slashes with a single slash
// (could happen on some proxy setups and/or Windows servers)
$script_path = trim(dirname($script_name));
$script_path = preg_replace('#[\\\\/]{2,}#', '/', $script_path);

$url = (($secure) ? 'https://' : 'http://') . $server_name;

if ($server_port && (($secure && $server_port <> 443) || (!$secure && $server_port <> 80)))
{
	$url .= ':' . $server_port;
}

$url .= $script_path;

$site_ref_img = $k_config['link_to_us_image'];

// assign template vars
$template->assign_vars(array(
	'SITE_LINK_TXT'				=> sprintf($user->lang['SITE_LINK_TXT'], $config['sitename']),
	'SITE_LINK_TXT_EXPLAIN'		=> sprintf($user->lang['SITE_LINK_TXT_EXPLAIN'], $config['sitename']),
	'SITE_LINK_TXT_EXPLAIN2'	=> $user->lang['SITE_LINK_TXT_EXPLAIN2'],
    'U_SITE_LINK'        		=>  '&lt;a&nbsp;href=&quot;' . $url . '/portal.php' . '&quot;&nbsp;title=&quot;' . $config['site_desc'] . '&quot;&gt;' . ' &lt;'. 'img src=&quot;' . $url . $phpbb_root_path . 'images/links/' . $site_ref_img . '&quot; ' . '&gt;' . '&lt;/a&gt;',
    'U_SITE_LINK_IMG'      		=>  '<a href="' . $url . '/portal.php">' . '<img src="' . $phpbb_root_path . 'images/links/' . $site_ref_img . '" alt="" /></a>',
	'L_PORTAL_DEBUG'			=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0'),
	)
);

?>