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

$cumuluscontent = '';
$cumuluscontent =  '<a href="" class="tag-link" title="" rel="tag" style="font-size: 14pt;" color="0x008000" hicolor="0x008000">Dublin</a>';
$cumuluscontent .= '<a href="" class="tag-link" title="" rel="tag" style="font-size: 15pt;" color="0xFF0000" hicolor="0xFF0000">Galway</a>';
$cumuluscontent .= '<a href="" class="tag-link" title="" rel="tag" style="font-size: 14pt;" color="0x808080" hicolor="0x808080">Change</a>';
$cumuluscontent .= '<a href="" class="tag-link" title="" rel="tag" style="font-size: 15pt;" color="0x808000" hicolor="0x808000">Boston</a>';
$cumuluscontent .= '<a href="" class="tag-link" title="" rel="tag" style="font-size: 15pt;" color="0x800080" hicolor="0x800080">Cardif</a>';
$cumuluscontent .= '<a href="" class="tag-link" title="" rel="tag" style="font-size: 14pt;" color="0x804000" hicolor="0x804000">Keeper</a>';
$cumuluscontent .= '<a href="" class="tag-link" title="" rel="tag" style="font-size: 15pt;" color="0xFF00FF" hicolor="0xFF00FF">Return</a>';
$cumuluscontent .= '<a href="" class="tag-link" title="" rel="tag" style="font-size: 14pt;" color="0x0000FF" hicolor="0x0000FF">Please</a>';
$cumuluscontent .= '<a href="" class="tag-link" title="" rel="tag" style="font-size: 15pt;" color="0x000000" hicolor="0x000000">People</a>';
$cumuluscontent .= '<a href="" class="tag-link" title="" rel="tag" style="font-size: 14pt;" color="0xFF850B" hicolor="0xFF850B">Orange</a>';
$categories = urlencode($cumuluscontent); 

$tmp2 = '"tagcloud", "<tags>';
$tmp2 .= $categories . '</tags>"';

$template->assign_vars(array(
	'FLASHTAG'			=> $tmp2,
	'CUMULUS'			=> $cumuluscontent,
	'CLOUD_MOVIE'		=> 'tagcloud.swf',
));

?>