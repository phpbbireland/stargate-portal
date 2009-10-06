<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   Saturday, Jan 22, 2005
* @copyright (c) 2005-2009 phpbbireland
* @home    http://www.stargate-portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_cloud_captcha.php 336 2009-01-23 02:06:37Z Michealo $
* Updated: 22 September 2009
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

// for bots test //
$page_title = $user->lang['BLOCK_CLOUD'];

global $template;

$captcha_cloud = '';
$captcha_cloud =  '<a href="" class="tag-link" title="" rel="tag" style="font-size: 14pt;" color="0x008000" hicolor="0x008000">Dublin</a>';
$captcha_cloud .= '<a href="" class="tag-link" title="" rel="tag" style="font-size: 15pt;" color="0xFF0000" hicolor="0xFF0000">Galway</a>';
$captcha_cloud .= '<a href="" class="tag-link" title="" rel="tag" style="font-size: 14pt;" color="0x808080" hicolor="0x808080">Change</a>';
$captcha_cloud .= '<a href="" class="tag-link" title="" rel="tag" style="font-size: 15pt;" color="0x808000" hicolor="0x808000">Boston</a>';
$captcha_cloud .= '<a href="" class="tag-link" title="" rel="tag" style="font-size: 15pt;" color="0x800080" hicolor="0x800080">Cardif</a>';
$captcha_cloud .= '<a href="" class="tag-link" title="" rel="tag" style="font-size: 14pt;" color="0x804000" hicolor="0x804000">Keeper</a>';
$captcha_cloud .= '<a href="" class="tag-link" title="" rel="tag" style="font-size: 15pt;" color="0xFF00FF" hicolor="0xFF00FF">Return</a>';
$captcha_cloud .= '<a href="" class="tag-link" title="" rel="tag" style="font-size: 14pt;" color="0x0000FF" hicolor="0x0000FF">Please</a>';
$captcha_cloud .= '<a href="" class="tag-link" title="" rel="tag" style="font-size: 15pt;" color="0x000000" hicolor="0x000000">People</a>';
$captcha_cloud .= '<a href="" class="tag-link" title="" rel="tag" style="font-size: 14pt;" color="0xFF850B" hicolor="0xFF850B">Orange</a>';
$categories = urlencode($captcha_cloud); 

$tmp2 = '"tagcloud", "<tags>';
$tmp2 .= $categories . '</tags>"';

$template->assign_vars(array(
	'CC_FLASHTAG'		=> $tmp2,
	'CC_CUMULUS'		=> $captcha_cloud,
));

?>